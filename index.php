<?php
	// - Minden PHP állomány legelejére kell, csak egyszer!
	//   tehát minden ebben a PHP állományban behívott PHP állomány
	//   megörökli ezt a beállítást!
	header('Content-type: text/html; charset=utf-8');
	date_default_timezone_set("Europe/Budapest");
	//munkamenet inditása
	session_start();
	// Az oldal működéséhez szükséges alapvető konfigurációs beállítások behívása
	include('config/config.inc');
	// Az alternatív útvonal problémáját feloldó utvonal.php állomány behívása.
	include('php/utvonal.php');
	// Behívjuk a hibát naplózó php-t
	include('php/naplo.php');
	
	try{
		include('php/fuggvenyek.php');
		// Minden objektum által elérhető függvényeim
		//include('php/fuggvenyek.php');
		// echo(veletlenkaraktersor("user-").date('Y').date('m').date('d')); <-- Itt egy minta, így teszteltem
		// Adatbázis kapcsolat felépítéséhet szükséges PHP
		include('php/adatbaziskapcsolat.php');
		include('php/munkamenet.php');
		
//-------------------------------------------------------------------//
		//include('php/levelezes.php');
//-------------------------------------------------------------------//		

		include('php/belepes.php');
		// Naplózzuk az oldal betöltődését
		$naplo->_bejegyez("Az oldal újratöltődött.");
	}
	catch (\ERROR $weblaphiba) {$naplo->_bejegyez(basename($weblaphiba->getFile()).', sor: '.$weblaphiba->getLine().', hiba: '.$weblaphiba->getMessage());}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BérAutó24</title>
	<link rel="stylesheet" type="text/css" href="css/stilus.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<script type="text/javascript" src="js/import/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="js/import/jquery/jQuery_3_7_1.js"></script>
	<script type="text/javascript" src="js/mezo_check.js"></script>
</head>
<body>
	<?php
	 if ($belepve == true)
	  { if (isset($_GET['logout']))
		 {}
		else 
		 {
		 	if (isset($_GET['menupont']))
		 	 {$menupont = $_GET['menupont'];}
		 	else 
		 	 {$menupont = '';}	
		 	
		 	include('html/vezerlopult.html');
		 	switch ($menupont) {
		 		case 'felhasznalok' : // Beillesztjük a felhasználók kezeléséért felelelős objektumot!
 									  include('php/felhasznalok.php');
		 							  include('html/felhasznalok.html');
		 							  break;
		 		case 'ujfelhasznalo' : include('php/felhasznalok.php');
		 							   include('html/felhasznalofelvetel.html');
		 							   break;
		 		case 'felhasznaloment' : include('php/felhasznalok.php');
		 							     if ($felhasznalok->felhasznalo_ment() == true)
		 							      {include('html/felhasznalok.html');}
		 							     else {include('html/felhasznalofelvetel.html');}
		 							     break;
		 		case 'szerkesztfelhasznalo' : include('php/felhasznalok.php');
		 									  $felhasznalok->felhasznalo_szerkeszt($_POST['id']);
		 									  include('html/felhasznalofelvetel.html');
		 									  break;
		 		case 'felhasznalofrissit' : include('php/felhasznalok.php');
		 									if ($felhasznalok->felhasznalo_frissit($_POST['id']) == true)
		 										{include('html/felhasznalok.html');}
		 									else
		 									{
		 										include('html/felhasznalofelvetel.html');
		 									}
		 									break;
		 		case 'torolfelhasznalo' :   include('html/felhasznaloktorles.html');
		 									break;
		 		case 'felhasznalotorles' :  include('php/felhasznalok.php');
		 									$felhasznalok->torles($_POST['id']);
		 									include('html/felhasznalok.html');
		 									break;
		 		case 'aktivalfelhasznalo' :	include('php/felhasznalok.php');
		 									$felhasznalok->felhasznalo_aktival($_POST['id']);
		 									include('html/felhasznalok.html');
		 									break;
		 		case 'tartalmak' :			include('php/tartalom.php');
		 									//include('html/tartalmak.html');
		 									break;
		 		case 'jarmuvek' :   include('php/jarmuvek.php');
		 							include('html/jarmuvek.html');
		 						  	break;
		 		case 'ujjarmu' : 	include('php/jarmuvek.php');
		 							include('html/jarmufelvetel.html');
		 							   break;
		 		case 'autokment' :  include('php/jarmuvek.php');
		 							if ($autok->automentes() == true)
		 							      {include('html/jarmuvek.html');}
		 							     else {include('html/jarmufelvetel.html');}
		 							     break;
		 		case 'autoszerkeszt' : 	include('php/jarmuvek.php');
		 								$autok->autoszerkeszt($_POST['id']);	
		 								include('html/jarmufelvetel.html');
		 								break;
		 		case 'autokfrissit' :   include('php/jarmuvek.php');
		 								if ($autok->automodosit($_POST['id']) == true)
		 										{include('html/jarmuvek.html');}
		 									else
		 									{
		 										include('html/jarmufelvetel.html');
		 									}
		 									break;
		 		case 'autotorol' :   		include('php/jarmuvek.php');
		 									include('html/torlesmegerosites.html');
		 									break;
		 		case 'autoktorles' :  		include('php/jarmuvek.php');
		 									$autok->torles($_POST['id']);
		 									include('html/jarmuvek.html');
		 									break;
		 									
		 		case 'foglalasok':			include('php/foglalaskezeles.php');
		 									include('html/foglalasok.html');
		 									break;

		 		case 'ujfoglalas':			include('php/foglalaskezeles.php');
		 									include('html/foglalasfelvetel.html');
		 									break;

		 		case 'foglalasokment' :  include('php/foglalaskezeles.php');
		 								 if ($foglalasok->ment() == true)
		 							     {include('html/foglalasok.html');}
		 							     else {include('html/foglalasfelvetel.html');}
		 							     break;

		 	 	case 'foglalasokszerkeszt' :include('php/foglalaskezeles.php');
		 									$foglalasok->szerkeszt($_POST['id']);	
		 									include('html/foglalasfelvetel.html');
		 									break;

		 		case 'foglalasokfrissit' :   include('php/foglalaskezeles.php');
		 									 if ($foglalasok->modosit($_POST['id']) == true)
		 									 {include('html/foglalasok.html');}
		 									 else
		 									 {
		 										include('html/foglalasfelvetel.html');
		 									 }
		 									 break;

		 		case 'foglalastorol' :   	include('php/foglalaskezeles.php');
		 									include('html/foglalas_torlesmegerosito.html');
		 									break;

		 		case 'foglalastorles' :  		include('php/foglalaskezeles.php');
		 									$foglalasok->torles($_POST['id']);
		 									include('html/foglalasok.html');
		 									break;
		 		default : 				break;
		 	}
		 }
	  }
	 else 
	{
		//ha nincs belépve akkor is vizsgálom a menupont meglétté mert a regisztrációhoz szükséges
		if (isset($_GET['menupont']))
		 	{$menupont = $_GET['menupont'];}
		 	else 
		 	{$menupont = '';}	

		switch ($menupont) 
		{	
		 	case 'regisztracio' :include('php/felhasznalok.php');
		 						 include('html/felhasznalofelvetel.html');
		 						 echo '<a href="index.php">Vissza</a>';			
		 						 break;

		 	case 'felhasznaloment' : include('php/felhasznalok.php');
		 							     if ($felhasznalok->felhasznalo_ment() == true)
		 							      {include('html/regisztraciovege.html');}
		 							     else {include('html/felhasznalofelvetel.html');}
		 							     break;

		 	case 'aktivalas' : include('php/felhasznalok.php');
		 							     if ($felhasznalok->felhasznalo_aktivalas_linkbol() == true)
		 							      {include('html/regisztracioaktiv.html');}
		 							     else {include('html/regisztracionemaktiv.html');}
		 							     break;
		 	case 'belepes' :	include('html/belep.html');
		 						break;
		 	case 'kezdolap' :
		 	default : 	include('php/tartalom.php');
		 				include('html/oldal.html');			    
		 				break;
		}
	}
?>
</body>
</html>