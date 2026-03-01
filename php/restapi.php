<?php  

$RESTVAGYOK = true;

// ADATBÁZIS ADATOK
$database_host = 'localhost';
$database_user = 'root';
$database_password = '';
$database_db = 'autokolcsonzo';

// LOG
$log_enabled = true;

// Szükséges fájlok betöltése
include('utvonal.php');  
include('naplo.php');   
include('adatbaziskapcsolat.php');
include('jarmuvek.php'); // auto objektum behívása

// A REST kérés törzsének beolvasása
$uzenet= file_get_contents('php://input');

// Ellenőrizzük, hogy érkezett-e adat
if(isset($uzenet) && !empty($uzenet))
{
    // Naplózzuk a teljes beérkezett REST üzenetet
	 $naplo->_bejegyez('Rest kérés érkezett:  '.$uzenet);

     // XML feldolgozás
	  $uzenet_xml = simplexml_load_string($uzenet);

    // Kapcsolat teszt
    if($uzenet_xml->kerestipus=='kapcsolat')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: kapcsolatfelvétel');

         // Egyszerű válasz küldése
        echo("<gyoker><valasz>OK</valasz></gyoker>");
    }

     // Autók listájának lekérése
     if($uzenet_xml->kerestipus=='autoklista')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatlekérdezés');

        // Az autók XML listáját visszaadjuk
        echo("<gyoker><valasz>OK</valasz>".$autok->_autok_lista_xml_str()."</gyoker>");
    }


    if($uzenet_xml->kerestipus=='adatkuld')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

        $sikeres = false;
        $valasz_uzenet = '';

        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

         // POST feltöltés az XML-ből
        $_POST['marka']     = (string)$uzenet_xml->jarmu->marka;
        $_POST['modell']    = (string)$uzenet_xml->jarmu->modell;
        $_POST['evjarat']   = (string)$uzenet_xml->jarmu->evjarat;
        $_POST['alvazszam'] = (string)$uzenet_xml->jarmu->alvazszam;
        $_POST['rendszam']  = (string)$uzenet_xml->jarmu->rendszam;
        $_POST['allapot']   = (string)$uzenet_xml->jarmu->allapot;
        $_POST['napi_dij']  = (string)$uzenet_xml->jarmu->napi_dij;

       // Autó mentése az adatbázisba
        $sikeres = $autok->automentes();

          // Válasz küldése a dekstopnak
        if ($sikeres) {
            echo "<gyoker><valasz>OK</valasz></gyoker>";
        } else {
            echo "<gyoker><valasz>HIBA</valasz><uzenet>Adatmódosítás sikertelen</uzenet></gyoker>";
        }

    }
}

?>