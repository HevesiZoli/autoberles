<?php  

$RESTVAGYOK = true;

// ADATBÁZIS ADATOK
$database_host = 'localhost';
$database_user = 'root';
$database_password = '';
$database_db = 'autokolcsonzo';

// LOG
$log_enabled = true;


include('utvonal.php');  
include('naplo.php');   
include('adatbaziskapcsolat.php');
include('jarmuvek.php');


$uzenet= file_get_contents('php://input');

if(isset($uzenet) && !empty($uzenet))
{
	 $naplo->_bejegyez('Rest kérés érkezett:  '.$uzenet);

	  $uzenet_xml = simplexml_load_string($uzenet);

    if($uzenet_xml->kerestipus=='kapcsolat')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: kapcsolatfelvétel');
        echo("<gyoker><valasz>OK</valasz></gyoker>");
    }

     if($uzenet_xml->kerestipus=='autoklista')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatlekérdezés');
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

       
        $sikeres = $autok->automentes();

        if ($sikeres) {
            echo "<gyoker><valasz>OK</valasz></gyoker>";
        } else {
            echo "<gyoker><valasz>HIBA</valasz><uzenet>Adatmódosítás sikertelen</uzenet></gyoker>";
        }

    }
}

?>