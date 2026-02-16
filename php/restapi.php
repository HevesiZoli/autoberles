<?php  

$RESTVAGYOK = true;

include('utvonal.php');  
include('naplo.php');   
include('adatbaziskapcsolat.php');
include('jarmuvek.php'); // $autok objektum létrehozása

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

     if($uzenet_xml->kerestipus=='adatoklista')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatlekérdezés');
        echo("<gyoker><valasz>OK</valasz>".$autok->_lista_xml_str()."</gyoker>");
    }

   	if($uzenet_xml->kerestipus=='adatkuld')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

        $sikeres = false;
        $valasz_uzenet = '';

    	$naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

    	 // POST feltöltés az XML-ből
	    $_POST['marka']     = (string)$uzenet_xml->auto->marka;
	    $_POST['modell']    = (string)$uzenet_xml->auto->modell;
	    $_POST['evjarat']   = (string)$uzenet_xml->auto->evjarat;
	    $_POST['alvazszam'] = (string)$uzenet_xml->auto->alvazszam;
	    $_POST['rendszam']  = (string)$uzenet_xml->auto->rendszam;
	    $_POST['allapot']   = (string)$uzenet_xml->auto->allapot;
	    $_POST['napi_dij']  = (string)$uzenet_xml->auto->napi_dij;

	   
	    $sikeres = $autok->modosit();

	    if ($sikeres) {
	        echo "<gyoker><valasz>OK</valasz></gyoker>";
	    } else {
	        echo "<gyoker><valasz>HIBA</valasz><uzenet>Adatmódosítás sikertelen</uzenet></gyoker>";
	    }

    }
}

?>