<?php

$fogalasok = new foglalas($db_kapcsolat,$naplo);

class foglalasok 
{
	private $naplo;
 	private $db_kapcsolat;

 	// Adatbázis mezők adattagjai.
 	public $foglalas_id;
 	public $nev ;
 	public $jarmu;
 	public $kezdet;
 	public $vege;
 	public $allapot;
 	public $megjegyzes;
 	public $letrehozva;

 	// Megmondja, hogy milyen műveletet hajtok éppen végre!
 	public $muvelet;

 	// - Üzenet, amit a felhasználónak szánok
 	//   lehet ez hibaüzenet is!
 	public $uzenet;

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

 	public function _foglalasok_lista() 
 	{

 		// - Kell egy változó, amiben a lista HTML részét tárolom
		$HTMLSorok = "";

		// - A termékeket akarom listázni, ezek adatbázisban vannak
		//   ezért elkészítem az SQL lekérdezést!

		$SQLlekerdezes = "SELECT * FROM foglalas";

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
			while ($egysor = mysqli_fetch_assoc($SQLeredmeny)) 
			{
				$editcommand = "index.php?menupont=foglalasok&foglalas=szerkeszt&foglalas_id=".$egysor['foglalas_id'];
				$delcommand = "index.php?menupont=foglalasok&foglalas=torol&foglalas_id=".$egysor['foglalas_id'];

				$HTMLSorok .= "<tr>";
				$HTMLSorok .= "<td>".$egysor['nev']."</td>";
				$HTMLSorok .= "<td>".$egysor['jarmu']."</td>";
				$HTMLSorok .= "<td>".$egysor['kezdet']."</td>";
				$HTMLSorok .= "<td>".$egysor['vege']."</td>";
				$HTMLSorok .= "<td>".$egysor['allapot']."</td>";
				$HTMLSorok .= "<td>".$egysor['megjegyzes']."</td>";
				$HTMLSorok .= "<td>".$egysor['letrehozva']."</td>";
				$HTMLSorok .= ' <td><a href="'.$editcommand.'">Szerkesztés </a><a href="'.$delcommand.'"> Törlés</a></td>';
				$HTMLSorok .= "</tr>";
			}
		}

		else {
			// - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
			$this->naplo->_bejegyez($sqlhiba);
		}
		// Itt adom vissza a HTML sorokat a lapnak.
		return $HTMLSorok;
	}

	public function ment() 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'insert';

		// - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
		//   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
		//   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
		//   vizsgálatnál majd kibukik, ha nem kaptam adatot!
		if (isset($_POST['nev'])) {
			$this->nev = $_POST['nev'];} else {$this->nev = '';}
		if (isset($_POST['jarmu'])) {
			$this->jarmu = $_POST['jarmu'];} else {$this->jarmu = '';}
		if (isset($_POST['kezdet'])) {
			$this->kezdet = $_POST['kezdet'];} else {$this->kezdet = '';}
		if (isset($_POST['vege'])) {
			$this->vege = $_POST['vege'];} else {$this->vege = '';}
		if (isset($_POST['allapot'])) {
			$this->allapot = $_POST['allapot'];} else {$this->allapot = '';}
		if (isset($_POST['megjegyzes'])) {
			$this->megjegyzes = $_POST['megjegyzes'];} else {$this->megjegyzes = '';}
		if (isset($_POST['letrehozva'])) {
			$this->letrehozva = $_POST['letrehozva'];} else {$this->letrehozva = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;

		// Kötelező érték vizsgálata
		if (empty($this->nev) || empty($this->jarmu) || empty($this->kezdet) ||
	 	    empty($this->vege) || empty($this->allapot) || empty($this->megjegyzes) || empty($this->letrehozva)) 
			{$this->uzenet = 'Kérem tötlse ki a pirossal jelölt mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "INSERT INTO foglalas (nev,jarmu,kezdet,vege,allapot,megjegyzes,letrehozva) 
							  VALUES ('$this->nev','$this->jarmu','$this->kezdet','$this->vege','$this->allapot','$this->megjegyzes','$this->letrehozva') ";

			// Lefuttatjuk az SQL lekérdezést!
			$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
		 }
		 // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
		 return $sikeresmentes;	
	}

	public function szerkeszt($foglalas_id) 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'edit';
		$this->foglalas_id = $foglalas_id;

		// - A terméket akarom szerkeszteni, ezek adatbázisban vannak
		//   ezért elkészítem az SQL lekérdezést!

		$SQLlekerdezes = "SELECT * FROM foglalas WHERE foglalas_id = '$this->foglalas_id' ";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		// - A futtatást követően van egy központi változóz, ahonnan
		//   kinyerhetem azt, hogy volt-e hibám?
		if (empty($sqlhiba))
		{
			// - Amennyiben az $sqlhiba üres, 
			//   abban az esetben fel kell dolgoznom
			//   az eredményhalmazt!
			while ($egysor = mysqli_fetch_assoc($SQLeredmeny)) 
			{
				$this->nev = $egysor['nev'];
				$this->jarmu = $egysor['jarmu'];
				$this->kezdet = $egysor['kezdet'];
				$this->vege = $egysor['vege'];
				$this->allapot = $egysor['allapot'];
				$this->megjegyzes = $egysor['megjegyzes'];
				$this->letrehozva = $egysor['letrehozva'];
			}
		}
		else {
			// - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
			$this->naplo->_bejegyez($sqlhiba);
		}
	}

	public function modosit($foglalas_id) 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'update';
		$this->foglalas_id = $foglalas_id;

		// - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
		//   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
		//   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
		//   vizsgálatnál majd kibukik, ha nem kaptam adatot!
		if (isset($_POST['nev'])) {
			$this->nev = $_POST['nev'];} else {$this->nev = '';}
		if (isset($_POST['jarmu'])) {
			$this->jarmu = $_POST['jarmu'];} else {$this->jarmu = '';}
		if (isset($_POST['kezdet'])) {
			$this->kezdet = $_POST['kezdet'];} else {$this->kezdet = '';}
		if (isset($_POST['vege'])) {
			$this->vege = $_POST['vege'];} else {$this->vege = '';}
		if (isset($_POST['allapot'])) {
			$this->allapot = $_POST['allapot'];} else {$this->allapot = '';}
		if (isset($_POST['megjegyzes'])) {
			$this->megjegyzes = $_POST['megjegyzes'];} else {$this->megjegyzes = '';}
		if (isset($_POST['letrehozva'])) {
			$this->letrehozva = $_POST['letrehozva'];} else {$this->letrehozva = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;

		// Kötelező érték vizsgálata
		if (empty($this->nev) || empty($this->jarmu) || empty($this->kezdet) ||
	 	    empty($this->vege) || empty($this->allapot) || empty($this->megjegyzess) || empty($this->letrehozva)) 
			{$this->uzenet = 'Kérem tötlse ki a pirossal jelölt mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "UPDATE foglalas 
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
}
?>