<?php

$foglalasok = new foglalasok($db_kapcsolat,$naplo);

class foglalasok 
{
	private $naplo;
 	private $db_kapcsolat;

 	// Adatbázis mezők adattagjai.
 	public $foglalas_id;
 	public $nev;
 	public $email;
 	public $jarmu;
 	public $kezdet;
 	public $vege;
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
    $HTMLSorok = "";

    $SQLlekerdezes = "SELECT * FROM foglalas";
    $this->naplo->_bejegyez($SQLlekerdezes);

    $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

    if ($SQLeredmeny)
    {
        while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
        {
            $editcommand  = '<form action="index.php?menupont=foglalasokszerkeszt" method="post">';
            $editcommand .= '<input type="hidden" name="id" value="'.$row['foglalas_id'].'">';
            $editcommand .= '<input type="submit" name="szerkeszt" value="Szerkesztés">';
            $editcommand .= '</form>';
                 
            $deletecommand  = '<form action="index.php?menupont=foglalastorol" method="post">';
            $deletecommand .= '<input type="hidden" name="id" value="'.$row['foglalas_id'].'">';
            $deletecommand .= '<input type="submit" name="torol" value="Törlés">';
            $deletecommand .= '</form>';

            $HTMLSorok .= "<tr>
                <td>".$row['nev']."</td>
                <td>".$row['email']."</td>
                <td>".$row['jarmu']."</td>
                <td>".$row['kezdet']."</td>
                <td>".$row['vege']."</td>
                <td>".$row['letrehozva']."</td>
                <td>".$editcommand.$deletecommand."</td>
            </tr>";
        }
    }
    else 
    {
        $this->naplo->_bejegyez(mysqli_error($this->db_kapcsolat->_kapcsolat()));
    }

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
		if (isset($_POST['email'])) {
			$this->email = $_POST['email'];} else {$this->email = '';}
		if (isset($_POST['jarmu'])) {
			$this->jarmu = $_POST['jarmu'];} else {$this->jarmu = '';}
		if (isset($_POST['kezdet'])) {
			$this->kezdet = $_POST['kezdet'];} else {$this->kezdet = '';}
		if (isset($_POST['vege'])) {
			$this->vege = $_POST['vege'];} else {$this->vege = '';}
		if (isset($_POST['letrehozva'])) {
			$this->letrehozva = $_POST['letrehozva'];} else {$this->letrehozva = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;

		// Kötelező érték vizsgálata
		if (empty($this->nev) || empty($this->email) || empty($this->jarmu) || empty($this->kezdet) ||
	 	    empty($this->vege)|| empty($this->letrehozva)) 
			{$this->uzenet = 'Kérem tötlse ki a kötelező mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "INSERT INTO foglalas (nev,email,jarmu,kezdet,vege,letrehozva) 
							  VALUES ('$this->nev','$this->email','$this->jarmu','$this->kezdet','$this->vege','$this->letrehozva') ";

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
				$this->nev = $egysor['email'];
				$this->jarmu = $egysor['jarmu'];
				$this->kezdet = $egysor['kezdet'];
				$this->vege = $egysor['vege'];
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
		if (isset($_POST['email'])) {
			$this->email = $_POST['email'];} else {$this->email = '';}
		if (isset($_POST['jarmu'])) {
			$this->jarmu = $_POST['jarmu'];} else {$this->jarmu = '';}
		if (isset($_POST['kezdet'])) {
			$this->kezdet = $_POST['kezdet'];} else {$this->kezdet = '';}
		if (isset($_POST['vege'])) {
			$this->vege = $_POST['vege'];} else {$this->vege = '';}
		if (isset($_POST['letrehozva'])) {
			$this->letrehozva = $_POST['letrehozva'];} else {$this->letrehozva = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;

		// Kötelező érték vizsgálata
		if (empty($this->nev) || empty($this->email) || empty($this->jarmu) || empty($this->kezdet) ||
	 	    empty($this->vege)|| empty($this->letrehozva)) 
			{$this->uzenet = 'Kérem tötlse ki a kötelező mezőket!';
			 $sikeresmentes = false;}

		// - Cask akkor kezdek a mentéhez, ha a kötelező érték
		//   vizsgálat már lefutott, és a $sikeresmentes változó
		//   megengedi a mentést!
		if ($sikeresmentes == true)
		 {
			// - A termékeket akarom listázni, ezek adatbázisban vannak
			//   ezért elkészítem az SQL lekérdezést!

			$SQLlekerdezes = "UPDATE foglalas 
							  SET	 nev = '$this->nev',
							  		 email = '$this->email',
							  		 jarmu = '$this->jarmu',
							  		 kezdet = '$this->kezdet',
							  		 vege = '$this->vege',
							  		 letrehozva = '$this->letrehozva'
							  WHERE  foglalas_id = '$this->foglalas_id' ";

			// Lefuttatjuk az SQL lekérdezést!
			$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
		 }
		 // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
		 return $sikeresmentes;	
	}
	public function torles($foglalas_id) 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->muvelet = 'delete';
		$this->foglalas_id = $foglalas_id;

		$SQLlekerdezes = "DELETE FROM foglalas WHERE foglalas_id = $foglalas_id";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		if(isset($sqlhiba))
		{
			$this->naplo->_bejegyez($sqlhiba);
		}
  }
}
?>