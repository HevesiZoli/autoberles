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
		include('php/levelezes.php');
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="js/jQuery_3_7_1.js"></script>
	<script type="text/javascript" src="js/mezo_check.js"></script>
	<script type="text/javascript" src="js/sajat.js"></script>
</head>
<body>
	 <div class="ribbon">DEMO</div>
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
		 	//include('html/vezerlopult.html');
		 	switch ($menupont) {
		 		case 'felhasznalok' : // Beillesztjük a felhasználók kezeléséért felelelős objektumot!
 									  include('php/felhasznalok.php');
 									  include('html/vezerlopult.html');
		 							  include('html/felhasznalok.html');
		 							  break;
		 		case 'ujfelhasznalo' : include('php/felhasznalok.php');
		 							   include('html/felhasznalofelvetel.html');
		 							   break;
			 	case 'felhasznaloment': 	include('php/felhasznalok.php');
										    if ($felhasznalok->felhasznalo_ment() == true) {
										        include('html/regisztraciovege.html');
										    } else {
										        include('html/felhasznalofelvetel.html');
										    }
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
		 		case 'torolfelhasznalo' :   include('html/vezerlopult.html');
		 									include('html/felhasznaloktorles.html');
		 									break;
		 		case 'felhasznalotorles' :  include('html/vezerlopult.html');
		 									include('php/felhasznalok.php');
		 									$felhasznalok->torles($_POST['id']);
		 									include('html/felhasznalok.html');
		 									break;
		 		case 'aktivalfelhasznalo' :	include('php/felhasznalok.php');
		 									$felhasznalok->felhasznalo_aktival($_POST['id']);
		 									include('html/vezerlopult.html');
		 									include('html/felhasznalok.html');
		 									break;
		 		case 'tartalmak' :			include('php/tartalom.php');
		 									//include('html/tartalmak.html');
		 									break;
		 		case 'jarmuvek' :   include('php/jarmuvek.php');
		 							include('html/vezerlopult.html');
		 							include('html/jarmuvek.html');
		 						  	break;
		 		//case 'dashboard' :  include('php/dashboard.php');
		 							break;
		 		case 'ujjarmu' : 	include('php/jarmuvek.php');
		 							include('html/jarmufelvetel.html');
		 							   break;
		 		case 'autokment' :  include('php/jarmuvek.php');
		 							if ($autok->automentes() == true)
		 							      {include('html/jarmuvek.html');
		 									include('html/vezerlopult.html');}
		 							     else {include('html/jarmufelvetel.html');}
		 							     break;
		 		case 'autoszerkeszt' : 	include('php/jarmuvek.php');
		 								$autok->autoszerkeszt($_POST['id']);	
		 								include('html/jarmufelvetel.html');
		 								break;
		 		case 'autokfrissit' :   include('php/jarmuvek.php');
		 								if ($autok->automodosit($_POST['id']) == true)
		 										{	include('html/vezerlopult.html');
		 											include('html/jarmuvek.html');}
		 									else
		 									{
		 										include('html/jarmufelvetel.html');
		 									}
		 									break;
		 		case 'autotorol' :   		include('php/jarmuvek.php');
		 									include('html/vezerlopult.html');
		 									include('html/torlesmegerosites.html');
		 									break;
		 		case 'autoktorles' :  		include('php/jarmuvek.php');
		 									$autok->torles($_POST['id']);
		 									include('html/vezerlopult.html');
		 									include('html/jarmuvek.html');
		 									break;
		 		case 'autoallapot' : 		include('php/jarmuvek.php');
		 									$autok->autoallapot($_POST['id']);
		 									include('html/vezerlopult.html');
		 									include('html/jarmuvek.html');
		 									break;
		 		case 'foglalasok':			include('php/foglalaskezeles.php');
		 									include('html/vezerlopult.html');
		 									include('html/foglalasok.html');
		 									break;

		 		case 'ujfoglalas':			include('php/foglalaskezeles.php');
		 									include('php/foglalasfelvetel.php');
		 									break;
		 	 	case 'foglalasokszerkeszt' :include('php/foglalaskezeles.php');
		 									$foglalasok->szerkeszt($_POST['id']);	
		 									include('php/foglalasfelvetel.php');
		 									break;

		 		case 'foglalasokfrissit' :   include('php/foglalaskezeles.php');
		 									 if ($foglalasok->modosit($_POST['id']) == true)
		 									 {include('html/foglalasok.html');}
		 									 else
		 									 {
		 										include('php/foglalasfelvetel.php');
		 									 }
		 									 break;

		 		case 'foglalastorol' :   	include('php/foglalaskezeles.php');
		 									include('html/vezerlopult.html');
		 									include('html/foglalas_torlesmegerosito.html');
		 									break;
		 		case 'foglalastorles' :  	include('php/foglalaskezeles.php');
		 									$foglalasok->torles($_POST['id']);
		 									include('html/vezerlopult.html');
		 									include('html/foglalasok.html');
		 									break;
		 		case 'foglalaslemondasa' :  include('php/foglalaskezeles.php');
		 									$foglalasok->torles($_POST['id']);
		 									include('html/sikeresfoglalaslemondas.html');
		 									break;
		 		case 'adminpanel' :         include('html/vezerlopult.html');
		 									break;
		 		case 'berlesifeltetel': include('html/berlesifeltetelek.html');
		 								break;
		 		case 'autokmegtekintese' :  include('php/jarmuvek.php');
		 									include('html/autoklista.html');
		 								    break;
		 		case 'dashboard'	  : include('php/dashboard.php');
		 								include('html/vezerlopult.html');
		 								include('html/dashboard.html');
		 								break;
		 		case 'ujvelemeny':			include('php/dashboard.php');
		 									include('html/velemeny.html');
		 									break;
				case 'velemenyekszerkeszt' :
										    include('php/dashboard.php');
										    $ertekeles->szerkeszt($_POST['id']);
										    include('html/velemeny.html');
										    break;

				case 'velemenyekfrissit' :
										    include('php/dashboard.php');
										    if ($ertekeles->modosit($_POST['id']) == true)
										    {
										        include('html/dashboard.html');
										    }
										    else
										    {
										        include('html/velemeny.html');
										    }
										    break;

				case 'velemenytorles' :	include('php/dashboard.php');
										include('html/velemeny_torlesmegerosito.html');
										break;

				case 'velemenyektorles' :	include('php/dashboard.php');
										    $ertekeles->torles($_POST['id']);
										    include('html/oldal.html');
										    break;

		 		case 'automegjelnitesnagyban' : include('php/jarmuvek.php');
		 										include('php/foglalaskezeles.php');
		 										include('html/autokmegjelenitesnagyban.html');
		 										break;
		 		case 'velemenyekment' :	include('php/dashboard.php');
									    if ($ertekeles->uj_ertekeles() == true)
									    {
									        include('html/vezerlopult2.html');
									        include('html/oldal.html');
									    }
									    else
									    {
									        include('html/vezerlopult2.html');
									        include('html/oldal.html');
									    }
									    break;
		 		case 'jarmufoglalas' :	include('php/dashboard.php');
		 								include('php/foglalaskezeles.php');
									    if ($foglalasok->autoberles() == true)
									    {
									        include('html/sikeresfoglalas.html');
									    }
									    else
									    {
									        include('html/vezerlopult2.html');
									        include('html/oldal.html');
									    }
									    break;
				case 'foglalasmegtekintes' : 	include('php/foglalaskezeles.php');
												include('html/foglalasmegtekintes.html');
											 	break;
		 		default : 				include('php/dashboard.php');
		 								include('html/vezerlopult2.html');
		 								include('html/oldal.html');
		 								break;
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
		 	case 'berlesifeltetel': include('html/berlesifeltetelek.html');
		 							break;
		 	case 'autokmegtekintese' :  include('php/jarmuvek.php');
		 								include('html/autoklista.html');
		 								break;
		 	case 'belepes' :	include('html/belep.html');
		 						break; 
		 	case 'berlesifeltetel': include('html/berlesifeltetelek.html');
		 							break;
		 	case 'automegjelnitesnagyban' : include('php/jarmuvek.php');
		 									include('php/foglalaskezeles.php');
		 									include('html/autokmegjelenitesnagyban.html');
		 									break;
		 	case 'foglalasmegtekintes' : 	include('php/foglalaskezeles.php');
		 									include('html/foglalasmegtekintes.html');
										 	break;
		 	case 'kezdolap' : 
		 	default : 	include('php/dashboard.php');
		 				include('html/vezerlopult2.html');
		 				include('html/oldal.html');	    
		 				break;
		}
	}
?>
<div class="regitelo">
		<h2>Készüléke elavult</h2>
	</div>
</body>
</html>