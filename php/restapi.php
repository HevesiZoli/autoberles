<?php  

$RESTVAGYOK = true;

// ADATBÁZIS ADATOK
$database_host = 'localhost';
$database_user = 'autoberl_db';
$database_password = 'jNQvNZBrY7Jeqrsm75HZ';
$database_db = 'autoberl_db';

// LOG
$log_enabled = true;

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

     if($uzenet_xml->kerestipus=='autoklista')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatlekérdezés');
        echo("<gyoker><valasz>OK</valasz>".$autok->_lista_xml_str()."</gyoker>");
    }

   	if($uzenet_xml->kerestipus=='adatkuld')
    {
        $naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

        $sikeres = false;
        $valasz_uzenet = '';
        $auto_id = '';

    	$naplo->_bejegyez('Rest kérés érkezett, kérés tipusa: adatmódosítás');

    	if (isset($uzenet_xml->jarmu->auto_id)) 
    	{
    		$auto_id = (string)$uzenet_xml->jarmu->auto_id;

    		 // POST feltöltés az XML-ből
		    $_POST['marka']     = (string)$uzenet_xml->jarmu->marka;
		    $_POST['modell']    = (string)$uzenet_xml->jarmu->modell;
		    $_POST['evjarat']   = (string)$uzenet_xml->jarmu->evjarat;
		    $_POST['szallithato_szemelyek']   = (string)$uzenet_xml->jarmu->szallithato_szemelyek;
		    $_POST['uzemanyag']   = (string)$uzenet_xml->jarmu->uzemanyag;
		    $_POST['teljesitmeny']   = (string)$uzenet_xml->jarmu->teljesitmeny;
		    $_POST['sebessegvalto_tipusa']   = (string)$uzenet_xml->jarmu->sebessegvalto_tipusa;
		    $_POST['hengerurtartalom']   = (string)$uzenet_xml->jarmu->hengerurtartalom;
		    $_POST['vegyes_fogyasztastol']   = (string)$uzenet_xml->jarmu->vegyes_fogyasztastol;
		    $_POST['vegyes_fogyasztasig']   = (string)$uzenet_xml->jarmu->vegyes_fogyasztasig;
		    $_POST['alvazszam'] = (string)$uzenet_xml->jarmu->alvazszam;
		    $_POST['rendszam']  = (string)$uzenet_xml->jarmu->rendszam;
		     $_POST['allapot']  = (string)$uzenet_xml->jarmu->allapot;
		    $_POST['napi_dij']  = (string)$uzenet_xml->jarmu->napi_dij;
    	}
    	else
    	{
    		 $valasz_uzenet = 'Hiányzó kulcs!';
    	}

	    if (!empty($auto_id)) 
	    {

        $sikeres = $autok->automodosit($auto_id);

	    } 
	    else 
	    {
	        $sikeres = $autok->automentes();
	    }

	    if ($sikeres) {
	        echo "<gyoker><valasz>OK</valasz></gyoker>";
	    } else {
	        echo "<gyoker><valasz>HIBA</valasz><uzenet>$valasz_uzenet</uzenet></gyoker>";
	    }

    }
}

?>