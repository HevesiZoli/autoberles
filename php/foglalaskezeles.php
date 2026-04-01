<?php

$foglalasok = new foglalasok($db_kapcsolat,$naplo);

class foglalasok 
{
	private $naplo;
 	private $db_kapcsolat;

 	// Adatbázis mezők adattagjai.
 	public $foglalas_id;
 	public $auto_id;
 	public $nev;
 	public $email;
 	public $telefonszam;
 	public $jogositvanyszam;
 	public $jarmu;
 	public $kezdet;
 	public $vege;
 	public $letrehozva;
 	public $deleted;

 	// Megmondja, hogy milyen műveletet hajtok éppen végre!
 	public $muvelet;

 	// - Üzenet, amit a felhasználónak szánok
 	//   lehet ez hibaüzenet is!
 	public $hibauzenet;
 	public $date;

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
		$this->date = date("Y-m-d H:i:s");
 	}

 	public function __destruct() {
 		$this->naplo->_bejegyez(__CLASS__.' osztály megsemmisült.');
 	}

 	public function _foglalasok_lista() 
{
    $HTMLSorok = "";

    $SQLlekerdezes = "SELECT foglalas_id,
						 	 nev,
						 	 email,
						 	 telefonszam,
						 	 jogositvanyszam,
						 	 jarmu,
						 	 kezdet,
						 	 vege,
						 	 letrehozva,
						 	 deleted
 					  FROM foglalas WHERE deleted = 0";
    $this->naplo->_bejegyez($SQLlekerdezes);

    $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

    if ($SQLeredmeny)
    {
        while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
        {
        	$most = date("Y-m-d H:i:s");

			if ($row['kezdet'] <= $most && $row['vege'] >= $most) {
			    $aktivStatusz = '<span style="color: green;">Aktív</span>';
			} else {
			    $aktivStatusz = '<span style="color: red;">Nem aktív</span>';
			}

			$deletecommand =  '<div class="muveletek2">';
			$deletecommand .= '<form action="index.php?menupont=foglalastorol" method="post">';
			$deletecommand .= '<input type="hidden" name="id" value="'.$row['foglalas_id'].'">';   
			$deletecommand .= '<input type="submit" name="torol" value="🗑️">';  
			$deletecommand .= '</form>';
			$deletecommand .= '</div>';

            $HTMLSorok .= "<tr>
                <td>".$row['nev']."</td>
                <td>".$row['email']."</td>
                <td>".$row['telefonszam']."</td>
                <td>".$row['jogositvanyszam']."</td>
                <td>".$row['jarmu']."</td>
                <td>".$row['kezdet']."</td>
                <td>".$row['vege']."</td>
                <td>".$row['letrehozva']."</td>
                <td>".$aktivStatusz."</td>
                <td>".$deletecommand."</td>
            </tr>";
        }
    }
    else 
    {
        $this->naplo->_bejegyez(mysqli_error($this->db_kapcsolat->_kapcsolat()));
    }

    return $HTMLSorok;
}

	public function autoberles() 
    {
        $this->muvelet = 'insert';
        $sikeresmentes = true;

        // Adatok begyűjtése sima if-el, kérdőjelek nélkül
        if (isset($_POST['nev'])) { $this->nev = $_POST['nev']; } else { $this->nev = ''; }
        if (isset($_POST['email'])) { $this->email = $_POST['email']; } else { $this->email = ''; }
        if (isset($_POST['telefonszam'])) { $this->telefonszam = $_POST['telefonszam']; } else { $this->telefonszam = ''; }
        if (isset($_POST['jogositvanyszam'])) { $this->jogositvanyszam = $_POST['jogositvanyszam']; } else { $this->jogositvanyszam = ''; }
        if (isset($_POST['kezdet'])) { $this->kezdet = $_POST['kezdet']; } else { $this->kezdet = ''; }
        if (isset($_POST['vege'])) { $this->vege = $_POST['vege']; } else { $this->vege = ''; }

        // Kötelező mezők ellenőrzése
        if (empty($this->nev) || empty($this->email) || empty($this->telefonszam) || empty($this->jogositvanyszam) || empty($this->kezdet) || empty($this->vege)) {
            $this->hibauzenet = 'Hiba: minden mezo kotelezo';
            $sikeresmentes = false;
        }

        if ($sikeresmentes == true)
        {
            if (isset($_POST['auto_id'])) { $auto_id = intval($_POST['auto_id']); } else { $auto_id = 0; }
            
            $leker = "SELECT marka, modell, evjarat, rendszam FROM autok WHERE auto_id = '$auto_id'";
            $eredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $leker);
            $jarmuAdatok = mysqli_fetch_assoc($eredmeny);
            
            $jarmuNev = $jarmuAdatok['marka'].' '.$jarmuAdatok['modell'].' '.$jarmuAdatok['evjarat'];

            // INSERT - Itt voltak korábban idézőjel hibák, most javítva:
            $SQLlekerdezes = "INSERT INTO foglalas (auto_id, nev, email, telefonszam, jogositvanyszam, jarmu, kezdet, vege, letrehozva)
                              VALUES ('$auto_id', '$this->nev', '$this->email', '$this->telefonszam', '$this->jogositvanyszam', '$jarmuNev', '$this->kezdet', '$this->vege', '$this->date')";

            $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

            if ($SQLeredmeny) 
            {
                // Állapot frissítése
                $update = "UPDATE autok SET state = 1, allapot = 'Nem elerheto' WHERE auto_id = '$auto_id'";
                mysqli_query($this->db_kapcsolat->_kapcsolat(), $update);

                // Levélküldés
                require_once __DIR__ . '/levelezes.php';
                $mailer = new levelkuld($this->naplo, $GLOBALS['mail_host'], $GLOBALS['mail_user'], $GLOBALS['mail_password']);
                
                $uzenet = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        .box {
            background: #f9fafb;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background: #4CAF50;
            color: #ffffff !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Foglalás visszaigazolása</h1>

    <p>Tisztelt '.$this->nev.'!</p>

    <p>Örömmel értesítjük, hogy autóbérlési foglalását sikeresen rögzítettük.</p>

    <div class="box">
        <p><strong>Jármű:</strong> '.$jarmuNev.'</p>
        <p><strong>Bérlés kezdete:</strong> '.$this->kezdet.'</p>
        <p><strong>Bérlés vége:</strong> '.$this->vege.'</p>
    </div>

    <div style="text-align:center;">
        <a href="http://autoberlo24.hu/index.php?menupont=foglalasmegtekintes&auto_id='.$auto_id.'" class="button">
            Foglalás megtekintése
        </a>
    </div>

    <p>Kérjük, hogy a bérlés napján hozza magával érvényes okmányait.</p>

    <div class="footer">
        <p>Üdvözlettel,<br><strong>BérAutó24 csapata</strong></p>
    </div>
</div>

</body>
</html>
';
                $mailer->levelkuldes($this->email, "Foglalas visszaigazolas", $uzenet);
                
                $sikeresmentes = true;
            } 
            else 
            {
                $sikeresmentes = false;
            }
        }
        return $sikeresmentes;
    }
	public function foglalasmegtekintes() 
	{
    $HTMLSorok = "";
    $this->auto_id = $_GET['auto_id'];

    $SQLlekerdezes = "SELECT foglalas_id,
    						 auto_id,
						 	 nev,
						 	 email,
						 	 telefonszam,
						 	 jogositvanyszam,
						 	 jarmu,
						 	 kezdet,
						 	 vege,
						 	 letrehozva,
						 	 deleted
 					  FROM foglalas WHERE auto_id = '$this->auto_id' AND deleted = 0
 					  LIMIT 1";
    $this->naplo->_bejegyez($SQLlekerdezes);

    $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

    if ($SQLeredmeny)
    {
    	if (mysqli_num_rows($SQLeredmeny) > 0) 
   		{
	        while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
	        {
	        	$deletecommand =  '<div class="muveletek2">';
				$deletecommand .= '<form action="index.php?menupont=foglalaslemondasa" method="post">';
				$deletecommand .= '<input type="hidden" name="id" value="'.$row['foglalas_id'].'">';   
				$deletecommand .= '<input type="submit" name="torol" value="Foglalás lemondása">';  
				$deletecommand .= '</form>';
				$deletecommand .= '</div>';
				$HTMLSorok .= '<html>
	                                    <head>
		                                    <style>
												body {font-family: Arial, sans-serif; background-color: #f5f5f5; color: #333; margin:0; padding:0;}
												.container { max-width: 600px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; }
												h1 { color: #6b9c6f; text-align:center;}
												.booking-box { background:#f8fafc; border:1px solid #e6e9ed; border-radius:6px; padding:15px; margin:20px 0; }
												.booking-box p { margin:6px 0; }
												a.button { background: #6b9c6f;  color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display:inline-block; margin-top:15px;}
												a.button:hover { background: #5a885c; }
												.footer { margin-top:25px; font-size:14px; color:#666; text-align:center;}
												</style>
												</head>
												<body>
												<div class="container">
												    <h1>Foglalás megtekintés</h1>
												    <br>
												    <p>Tisztelt Ügyfelünk!</p>
												    <br>
												    <p>A foglalás részletei: </p>

												    <div class="booking-box">
												        <p><strong>Név: </strong>'.$row['nev'].'</p>
												        <p><strong>E-mail cím: </strong>'.$row['email'].'</p>
												        <p><strong>Telefonszám: </strong>'.$row['telefonszam'].'</p>
												        <p><strong>Jogosítvány száma: </strong>'.$row['jogositvanyszam'].'</p>
												        <p><strong>Jármű: </strong>'.$row['jarmu'].'</p>
												        <p><strong>Bérlés kezdete: </strong>'.$row['kezdet'].'</p>
												        <p><strong>Bérlés vége: </strong>'.$row['vege'].'</p>
												        <p><strong>Bérlés generálva: </strong>'.$row['letrehozva'].'</p>
												    </div>
												    '.$deletecommand.'
												    <p>Kérjük, hogy a bérlés kezdetének napján érvényes személyazonosító okmánnyal és jogosítvánnyal jelenjen meg az átvétel helyszínén.</p>
												    <br>
												    <p>További kérdés esetén vegye fel velünk a kapcsolatot.</p>
												    <div class="footer">
											        <p>Üdvözlettel,<br>BérAutó24 csapata</p>
											    	</div>
												</div>
												</body>
	                                    </html>';
	        }
	    }
	    else
	    {
	    	$HTMLSorok .= '<html>
	                                    <head>
		                                    <style>
												body {font-family: Arial, sans-serif; background-color: #f5f5f5; color: #333; margin:0; padding:0;}
												.container { max-width: 600px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; }
												h1 { color: #6b9c6f; text-align:center;}
												.booking-box { background:#f8fafc; border:1px solid #e6e9ed; border-radius:6px; padding:15px; margin:20px 0; }
												.booking-box p { margin:6px 0; }
												a.button { background: #6b9c6f;  color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display:inline-block; margin-top:15px;}
												a.button:hover { background: #5a885c; }
												.footer { margin-top:25px; font-size:14px; color:#666; text-align:center;}
												</style>
												</head>
												<body>
												<div class="container">
												    <h1>Foglalás megtekintés</h1>
												    <br>
												    <p>Tisztelt Ügyfelünk!</p>
												    <br>
												    <p><strong>A kiválasztott foglalás már lemondásra került</strong></p>
												    <br>
												    <p>Probléma esetén vegye fel velünk a kapcsolatot.</p>
												    <div style="text-align:center;">
											            <a href="http://127.0.0.1/backend/autoberles/index.php?menupont=autokmegtekintese" class="button">Újra foglalás</a>
											        </div>
											        <div class="footer">
											        <p>Üdvözlettel,<br>BérAutó24 csapata</p>
											    	</div>
												</div>
												</body>
	                                    </html>';
	    }
    }
    else 
    {
        $this->naplo->_bejegyez(mysqli_error($this->db_kapcsolat->_kapcsolat()));
    }
    return $HTMLSorok;
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
				$this->email = $egysor['email'];
				$this->telefonszam = $egysor['telefonszam'];
				$this->jogositvanyszam = $egysor['jogositvanyszam'];
				$this->jarmu = $egysor['jarmu'];
				$this->kezdet = $egysor['kezdet'];
				$this->vege = $egysor['vege'];
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
		if (isset($_POST['telefonszam'])) {
			$this->telefonszam = $_POST['telefonszam'];} else {$this->telefonszam = '';}
		if (isset($_POST['jogositvanyszam'])) {
			$this->jogositvanyszam = $_POST['jogositvanyszam'];} else {$this->jogositvanyszam = '';}
		if (isset($_POST['jarmu'])) {
			$this->jarmu = $_POST['jarmu'];} else {$this->jarmu = '';}
		if (isset($_POST['kezdet'])) {
			$this->kezdet = $_POST['kezdet'];} else {$this->kezdet = '';}
		if (isset($_POST['vege'])) {
			$this->vege = $_POST['vege'];} else {$this->vege = '';}

		// Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
		$sikeresmentes = true;

		// Kötelező érték vizsgálata
		if (empty($this->nev) || empty($this->email) || empty($this->telefonszam) || empty($this->jogositvanyszam) || empty($this->jarmu) || empty($this->kezdet) ||
	 	    empty($this->vege)) 
			{$this->hibauzenet = 'Kérem tötlse ki a kötelező mezőket!';
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
							  		 telefonszam = '$this->telefonszam',
							  		 jogositvanyszam = '$this->jogositvanyszam',
							  		 jarmu = '$this->jarmu',
							  		 kezdet = '$this->kezdet',
							  		 vege = '$this->vege',
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

		$email_lekerdezes = "SELECT auto_id,nev,email,telefonszam,jogositvanyszam,jarmu,kezdet,vege FROM foglalas WHERE foglalas_id = $foglalas_id";
		$email_eredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $email_lekerdezes);

		if ($email_eredmeny && mysqli_num_rows($email_eredmeny) > 0) {
		    $sor = mysqli_fetch_assoc($email_eredmeny);
		    $this->email = $sor['email'];
		} else {
		    $this->naplo->_bejegyez("Nem található email ehhez a foglaláshoz.");
		    return;
		}

		$auto_id = $sor['auto_id'];

		$SQLlekerdezes = "UPDATE foglalas
						  SET deleted = 1
						  WHERE foglalas_id = $foglalas_id";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
		require_once __DIR__ . '/levelezes.php';

        $this->naplo->_bejegyez("felkészülés az aktiváló levél elküldésére.");

        $mailer = new levelkuld(
        $this->naplo,
        $GLOBALS['mail_host'],
        $GLOBALS['mail_user'],
        $GLOBALS['mail_password']);

                  $uzenet = '<html>
								<head>
								    <style>
								        body {font-family: Arial, sans-serif; background-color: #f5f5f5; color: #333; margin:0; padding:0;}
								        .container { max-width: 600px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; }
								        h1 { color: #6b9c6f; text-align:center;}
								        .booking-box { background:#f8fafc; border:1px solid #e6e9ed; border-radius:6px; padding:15px; margin:20px 0; }
								        .booking-box p { margin:6px 0; }
								        a.button { background: #6b9c6f;  color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display:inline-block; margin-top:15px;}
								        a.button:hover { background: #5a885c; }
								        .footer { margin-top:25px; font-size:14px; color:#666; text-align:center;}
								    </style>
								</head>
								<body>
								    <div class="container">
								        <h1>Foglalását törölték</h1>
								        <div>
								            <p>Tisztelt Ügyfelünk!</p>
								            <p>Ezúton értesítjük, hogy az Ön foglalása <strong>lemondásra került</strong>.</p>
								            <p>Foglalás részletei:</p>
								            <div class="booking-box">
											        <p><strong>Név: </strong>'.$sor['nev'].'</p>
											        <p><strong>Telefonszám: </strong>'.$sor['telefonszam'].'</p>
											        <p><strong>Jármű: </strong>'.$sor['jarmu'].'</p>
											        <p><strong>Bérlés kezdete: </strong>'.$sor['kezdet'].'</p>
											        <p><strong>Bérlés vége: </strong>'.$sor['vege'].'</p>
											    </div>
								            <p>Amennyiben kérdése merülne fel a törléssel kapcsolatban, kérjük vegye fel velünk a kapcsolatot.</p>
								        </div>
								        <div style="text-align:center;">
								            <a href="http://127.0.0.1/backend/autoberles/index.php?menupont=autokmegtekintese" class="button">Újra foglalás</a>
								        </div>
								        <div class="footer">
								            <p>Köszönjük megértését!</p>
								            <p><strong>BérAutó24 csapata</strong></p>
								        </div>
								    </div>
								</body>
								</html>
                                    ';

                  $mailer->levelkuldes(
                      $this->email,
                      "Foglalását törölték. – BérAutó24",
                      $uzenet
                  );
        if ($SQLeredmeny) 
			{
			    $update = "UPDATE autok SET state = 0,
			    							allapot = 'Elérhető' WHERE auto_id = '$auto_id'";
			    mysqli_query($this->db_kapcsolat->_kapcsolat(), $update);
			}

		if(isset($sqlhiba))
		{
			$this->naplo->_bejegyez($sqlhiba);
		}
  	}
}
?>