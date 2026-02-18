<?php

$autok = new autok($db_kapcsolat,$naplo);

		/*$menupont = $_GET['menupont'];
		switch ($menupont) {
				case 'jarmuvek' : include('html/jarmuvek.html');
		 						  break;
		 		case 'ujjarmu' : include('html/jarmufelvetel.html');
		 							   break;
		 		case 'autokment' : if ($autok->automentes() == true)
		 							      {include('html/jarmuvek.html');}
		 							     else {include('html/jarmufelvetel.html');}
		 							     break;
		 		case 'autoszerkeszt' : 		include('html/jarmufelvetel.html');
		 									$autok->autoszerkeszt($_POST['auto_id']);
		 									break;
		 		case 'autokfrissit' : if ($autok->automodosit($_POST['auto_id']) == true)
		 										{include('html/jarmuvek.html');}
		 									else
		 									{
		 										include('html/jarmufelvetel.html');
		 									}
		 									break;
		 		case 'autotorol' :   		include('html/torlesmegerosites.html');
		 									break;
		 		case 'autoktorles' :  		$autok->torles($_POST['auto_id']);
		 									include('html/jarmuvek.html');
		 									break;
			default : 			include('html/jarmuvek.html');
								break;
			}
		else {if (!isset($_POST['auto_id']))
 	    {include('html/jarmuvek.html');}}*/

class autok {

 	private $naplo;
 	private $db_kapcsolat;

 	// Adatbázis mezők adattagjai.
 	public $auto_id;
 	public $marka;
 	public $modell;
 	public $evjarat;
 	public $alvazszam;
 	public $rendszam;
 	public $allapot;
 	public $deleted;
 	public $napi_dij;


 	// Megmondja, hogy milyen műveletet hajtok éppen végre!
 	public $muvelet;

 	// - Üzenet, amit a felhasználónak szánok
 	//   lehet ez hibaüzenet is!
 	public $hibauzenet;
 	
 	public function __construct($db_kapcsolat,$naplo = null) {
 		// - A paraméterben megadott "objektumokat" itt
 		//   adom át a helyi változóknak, ami hatására a 
 		//   változók objektumok lesznek!
 		$this->db_kapcsolat = $db_kapcsolat;
 		$this->naplo = $naplo;
 		$this->naplo->_bejegyez(__CLASS__.' osztály létrejött.');
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'insert';
 	}

 	public function __destruct() {
 		$this->naplo->_bejegyez(__CLASS__.' osztály megsemmisült.');
 	}

 	public function _autok_lista() {

 		// - Kell egy változó, amiben a lista HTML részét tárolom
		$HTMLlines = "";

		// - A termékeket akarom listázni, ezek adatbázisban vannak
		//   ezért elkészítem az SQL lekérdezést!

		$SQLlekerdezes = "SELECT auto_id,
								 marka,
								 modell,
								 evjarat,
								 alvazszam,
								 rendszam,
								 allapot,
								 deleted,
								 napi_dij 
						  FROM   autok
						  WHERE deleted = 0";

		// Példa a naplózásra. Kiírom naplóba a lekérdezést
		$this->naplo->_bejegyez($SQLlekerdezes);

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		// - A futtatást követően van egy központi változóz, ahonnan
		//   kinyerhetem azt, hogy volt-e hibám?
		if (empty($sqlhiba))
		{
			// - Amennyiben az $sqlhiba üres, 
			//   abban az esetben fel kell dolgoznom
			//   az eredményhalmazt!
			while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
			{
                 // - Készítünk egy műveletek parancssort, 
                 //   hogy ne a $HTMLlines legyen megbonolítva
                 $editcommand =  '<form action="index.php?menupont=autoszerkeszt" method="post">';
                 $editcommand .= '<input type="hidden" name="id" value="'.$row['auto_id'].'">';   
                 $editcommand .= '<input type="submit" name="szerkeszt" value="Szerkesztés">';  
                 $editcommand .= '</form>';
                 
                 $deletecommand =  '<form action="index.php?menupont=autotorol" method="post">';
                 $deletecommand .= '<input type="hidden" name="id" value="'.$row['auto_id'].'">';   
                 $deletecommand .= '<input type="submit" name="torol" value="Törlés">';  
                 $deletecommand .= '</form>';  
                 // Itt állítom össze a listám html szakaszát!
                 $HTMLlines .= "<tr><td>".$row['marka']."</td><td>".$row['modell']."</td><td>".$row['evjarat']."</td><td>".$row['alvazszam']."</td><td>".$row['rendszam']."</td><td>".$row['allapot']."</td><td>".$row['napi_dij']."</td><td>".$editcommand.$deletecommand."</td></tr>";   
               }
		}
		else {
			// - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
			$this->naplo->_bejegyez($sqlhiba);
		}
		// Itt adom vissza a HTML sorokat a lapnak.
		return $HTMLlines;
 	}
 	public function automentes() {

		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'insert';

		// - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
		//   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
		//   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
		//   vizsgálatnál majd kibukik, ha nem kaptam adatot!
		if (isset($_POST['marka'])) {
			$this->marka = $_POST['marka'];} else {$this->marka = '';}
		if (isset($_POST['modell'])) {
			$this->modell = $_POST['modell'];} else {$this->modell = '';}
		if (isset($_POST['evjarat'])) {
			$this->evjarat = $_POST['evjarat'];} else {$this->evjarat = '';}
		if (isset($_POST['alvazszam'])) {
			$this->alvazszam = $_POST['alvazszam'];} else {$this->alvazszam = '';}
		if (isset($_POST['rendszam'])) {
			$this->rendszam = $_POST['rendszam'];} else {$this->rendszam = '';}
		if (isset($_POST['napi_dij'])) {
			$this->napi_dij = $_POST['napi_dij'];} else {$this->napi_dij = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;	

		// Kötelező érték vizsgálata
		if (empty($this->marka) || empty($this->modell) || empty($this->evjarat) ||
	 	    empty($this->alvazszam) || empty($this->rendszam) || empty($this->napi_dij)) 
			{$this->hibauzenet = 'Kérem tötlse ki a pirossal jelölt mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "INSERT INTO autok (marka,modell,evjarat,alvazszam,rendszam,napi_dij) 
							  VALUES ('$this->marka','$this->modell','$this->evjarat','$this->alvazszam','$this->rendszam','$this->napi_dij') ";

			// Lefuttatjuk az SQL lekérdezést!
			$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
		 }
		 // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
		 return $sikeresmentes;
	}
	public function autoszerkeszt($auto_id) {

		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'edit';
		$this->auto_id = $auto_id;

		// - A terméket akarom szerkeszteni, ezek adatbázisban vannak
		//   ezért elkészítem az SQL lekérdezést!

		$SQLlekerdezes = "SELECT * FROM autok WHERE auto_id = '$this->auto_id' ";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		// - A futtatást követően van egy központi változóz, ahonnan
		//   kinyerhetem azt, hogy volt-e hibám?
		if (empty($sqlhiba))
		{
			// - Amennyiben az $sqlhiba üres, 
			//   abban az esetben fel kell dolgoznom
			//   az eredményhalmazt!
			while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
			{
				$this->marka = $row['marka'];
				$this->modell = $row['modell'];
				$this->evjarat = $row['evjarat'];
				$this->alvazszam = $row['alvazszam'];
				$this->rendszam = $row['rendszam'];
				$this->napi_dij = $row['napi_dij'];
			}
		}
		else {
			// - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
			$this->naplo->_bejegyez($sqlhiba);
		}
 	}
 	public function automodosit($auto_id) {

		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'update';
		$this->auto_id = $auto_id;

		// - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
		//   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
		//   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
		//   vizsgálatnál majd kibukik, ha nem kaptam adatot!
		if (isset($_POST['marka'])) {
			$this->marka = $_POST['marka'];} else {$this->marka = '';}
		if (isset($_POST['modell'])) {
			$this->modell = $_POST['modell'];} else {$this->modell = '';}
		if (isset($_POST['evjarat'])) {
			$this->evjarat = $_POST['evjarat'];} else {$this->evjarat = '';}
		if (isset($_POST['alvazszam'])) {
			$this->alvazszam = $_POST['alvazszam'];} else {$this->alvazszam = '';}
		if (isset($_POST['rendszam'])) {
			$this->rendszam = $_POST['rendszam'];} else {$this->rendszam = '';}
		if (isset($_POST['napi_dij'])) {
			$this->napi_dij = $_POST['napi_dij'];} else {$this->napi_dij = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;	

		// Kötelező érték vizsgálata
		if (empty($this->marka) || empty($this->modell) || empty($this->evjarat) ||
	 	    empty($this->alvazszam) || empty($this->rendszam) || empty($this->napi_dij)) 
			{$this->hibauzenet = 'Kérem tötlse ki a pirossal jelölt mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "UPDATE autok 
							  SET	 marka = '$this->marka',
							  		 modell = '$this->modell',
							  		 evjarat = '$this->evjarat',
							  		 alvazszam = '$this->alvazszam',
							  		 rendszam = '$this->rendszam',
							  		 napi_dij = '$this->napi_dij'
							  WHERE  auto_id = '$this->auto_id' ";

			// Lefuttatjuk az SQL lekérdezést!
			$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
		 }
		 // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
		 return $sikeresmentes;
	}
	public function torles($auto_id) 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'delete';
		$this->auto_id = $auto_id;

		$SQLlekerdezes = "UPDATE autok
						  SET deleted = 1
						  WHERE auto_id = $auto_id";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		if(isset($sqlhiba))
		{
			$this->naplo->_bejegyez($sqlhiba);
		}
  	}

public function _lista_xml_str() 
	{

 		// - Kell egy változó, amiben a lista xml részét tárolom
		$XMLSorok = "";

		// - A termékeket akarom listázni, ezek adatbázisban vannak
		//   ezért elkészítem az SQL lekérdezést!

		$SQLlekerdezes = "SELECT * FROM termekek";

		// Példa a naplózásra. Kiírom naplóba a lekérdezést
		$this->naplo->_bejegyez($SQLlekerdezes);

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		// - A futtatást követően van egy központi változóz, ahonnan
		//   kinyerhetem azt, hogy volt-e hibám?
		if (empty($sqlhiba))
		{

			// - Amennyiben az $sqlhiba üres, 
			//   abban az esetben fel kell dolgoznom
			//   az eredményhalmazt!
			if(mysqli_num_rows($SQLeredmeny) > 0)
			{

				$XMLSorok="<autok>";

					while ($egysor = mysqli_fetch_assoc($SQLeredmeny)) 
					{
						//Felépítem az xml szerkezetet string formátumban
						//Nem elegáns megoldás
						$XMLSorok.="<auto>";
							$XMLSorok.='<marka>'.$egysor['marka'].'</marka>';
							$XMLSorok.='<modell>'.$egysor['modell'].'</modell>';
							$XMLSorok.='<evjarat>'.$egysor['evjarat'].'</evjarat>';
							$XMLSorok.='<alvazszam>'.$egysor['alvazszam'].'</alvazszam>';
							$XMLSorok.='<rendszam>'.$egysor['rendszam'].'</rendszam>';
							$XMLSorok.='<allapot>'.$egysor['allapot'].'</allapot>';
							$XMLSorok.='<napi_dij>'.$egysor['napi_dij'].'</napi_dij>';
						$XMLSorok.="</auto>";
					}
				$XMLSorok.="</autok>";
			}
		}
		else {
			// - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
			$this->naplo->_bejegyez($sqlhiba);
		}
		// Itt adom vissza a HTML sorokat a lapnak.
		return $XMLSorok;
 	}
 }
?>