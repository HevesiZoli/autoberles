<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  require_once __DIR__ . '/utvonal.php';
	//behivjuk a PHPMailer csomagot
	require_once gyoker().'/import/phpmailer/src/Exception.php';
	require_once gyoker().'/import/phpmailer/src/PHPMailer.php';
	require_once gyoker().'/import/phpmailer/src/SMTP.php';

//Mi az az alkamazas jelszó?
//-Kulso applikacio, csak ezzel a jelszoval ferhet hozza a google fiokhoz
//-csak ketfaktoros azonositas eseten mukodik
//-nincs kiteve elerhto menukent a google beallitasokban

class levelkuld{

	private $naplo;
	//levelkuldo objektum
	private $postas;

	public function __construct($naplo,$mail_host,$mail_user,$mail_password)
  {
      $this->naplo = $naplo;
      //$this->naplo->_bejegyez(__CLASS__.' osztály létrejött');
      //letrehozom a levelkuldo objektumot
      $this->postas=new PHPMailer(true);
      //nyelv beallitasa
      $this->postas->CharSet= "UTF-8";
      // $this->postas->SMTPDebug = 3;
      //ahhoz h levelet tudjunkkuldeni, kell egy smtp kiszolgalo, ami kapcsolodni tud a kulonbozo kiszolgalokhoz pl.:Google
      $this->postas->isSMTP();
      //szuksegunk lesz a megfelel kiszolgalo beallitasokra
      $this->postas->Host=$mail_host;
      $this->postas->Username=$mail_user;
      $this->postas->Password=$mail_password;
      //hitelesites beallitasa
      $this->postas->SMTPAuth=true;
      $this->postas->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
      $this->postas->Port=587;

      // Teszteléshez kell
      $this->postas->SMTPDebug = 2;         // részletes SMTP log
      $this->postas->Debugoutput = 'html';  // böngészőben olvasható formátum
  }
  // Destruktor
    public function __destruct()
    {
      //$this->naplo->_bejegyez(__CLASS__.' osztály megsemmisült');
    }

    public function levelkuldes($cimzett, $targy, $uzenet)
    {
      try {
          $ERRORStop = false;

          if(empty($cimzett) || empty($uzenet)) {
              $this->naplo->_bejegyez("Helytelen címzett vagy üres üzenet!");
              $ERRORStop = true;
          }

          if (!filter_var($cimzett, FILTER_VALIDATE_EMAIL)) {
              $this->naplo->_bejegyez("Helytelen címzett!");
              $ERRORStop = true;
          }

          if (!filter_var($this->postas->Username, FILTER_VALIDATE_EMAIL)) {
              $this->naplo->_bejegyez("Helytelen feladó!");
              $ERRORStop = true;
          }

          if(!$ERRORStop) {
              $this->postas->clearAddresses(); // mindig frissítjük
              $this->postas->setFrom($this->postas->Username, "BérAuto24");
              $this->postas->addAddress($cimzett);
              $this->postas->addReplyTo($this->postas->Username,"BérAuto24");
              $this->postas->isHTML(true);
              $this->postas->Subject = $targy;
              $this->postas->Body = $uzenet;

              $this->postas->send();
              $this->naplo->_bejegyez("Email elküldve: $cimzett");
          }
      } catch (Exception $e) {
          $this->naplo->_bejegyez("PHPMailer hiba: " . $this->postas->ErrorInfo);
      }
    }
  }
?>