<?php
$felhasznalok = new felhasznalok($db_kapcsolat,$naplo);

class felhasznalok {
	private $naplo;
 	private $db_kapcsolat;

 	// Adatbázis mezők adattagjai.
 	public $id;
 	public $name;
 	public $loginname;
 	public $email;
 	public $regisztracioideje;
 	public $fingerprint;
 	public $password1;
 	public $password2;
 	public $state;
    public $admin;
    public $deleted;
 	public $reminder;

 	// Megmondja, hogy milyen műveletet hajtok éppen végre!
 	private $sqlCommand;
 	public $muvelet;
 	// - Üzenet, amit a felhasználónak szánok
 	//   lehet ez hibaüzenet is!
 	public $hibauzenet;
 	public $date;
 	public function __construct($db_kapcsolat,$naplo = null) {
 		$this->naplo = $naplo;
      	$this->db_kapcsolat = $db_kapcsolat;
      	// - Ha nagyon biztosra akarok menni, akkor ide teszek
      	//   egy nagyon felesleges lépést :)
      	$this->sqlCommand = "";
      	$this->muvelet = 'insert';
      	$this->date = date("Y-m-d H:i:s");
 	}

 	public function __destruct() {
 	}

 	public function felhasznalo_lista() {
         // Ez a változó tárolja a függvény kimenetét!
         $HTMLlines = "";
         // - Mivel SELECT COUNT a parancs, ha nincs a feltételnek megfelelő
         //   sor az adatbázisban, akkor is lesz egy visszatérési sor -> tatlalat 0 lesz!   
         $this->sqlCommand = "SELECT   id,
                                       name,
                                       loginname,
                                       email,
                                       regisztracioideje,
                                       fingerprint
                                       password,
                                       state,
                                       admin,
                                       deleted,
                                       reminder
                              FROM     user
                              WHERE deleted = 0
                              ORDER BY name";

         // Végrehajtom a lekérdezést úgy, hogy a connection segítségével elküldöm a szervernek!
         // - A mysqli_query függvény által összeszedett eredmény halmazt (adatbázis sorai)
         //   az $SQLResult változóba tesszük! 
        try {
            $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(),$this->sqlCommand);
            if (!isset($SQLResult))
            {
              $sqlerror = mysql_error($this->db_kapcsolat->_kapcsolat());
            }
        }
        catch (\ERROR $sqlhiba) {$sqlerror = basename($sqlhiba->getFile()).', sor: '.$sqlhiba->getLine().', hiba: '.$sqlhiba->getMessage();}

      if (empty($sqlerror))
          {
           // Nem volt hibám, így legyártom a listát!
          // - Az $SQLResult változóban található listát lépésről lépésre feldolgozom!
            if (mysqli_num_rows($SQLResult) > 0)
            {
            // Ez a ciklus járja be az eredmény halmazt!
            while ($row = mysqli_fetch_assoc($SQLResult))
               {
                 // - Készítünk egy műveletek parancssort, 
                 //   hogy ne a $HTMLlines legyen megbonolítva
                 $editcommand =  '<form action="index.php?menupont=szerkesztfelhasznalo" method="post">';
                 $editcommand .= '<input type="hidden" name="id" value="'.$row['id'].'">';   
                 $editcommand .= '<input type="submit" name="szerkeszt" value="Szerkesztés">';  
                 $editcommand .= '</form>';

                 if($row['state']==0)
                 {
                  $activatecommand =  '<form action="index.php?menupont=aktivalfelhasznalo" method="post">';
                 $activatecommand .= '<input type="hidden" name="id" value="'.$row['id'].'">';   
                 $activatecommand .= '<input type="submit" name="aktival" value="Aktivál">';  
                 $activatecommand .= '</form>';  
                  }
                  else{$activatecommand="";}
                 
                 $deletecommand =  '<form action="index.php?menupont=torolfelhasznalo" method="post">';
                 $deletecommand .= '<input type="hidden" name="id" value="'.$row['id'].'">';   
                 $deletecommand .= '<input type="submit" name="torol" value="Törlés">';  
                 $deletecommand .= '</form>';  
                 // Itt állítom össze a listám html szakaszát!
                 $HTMLlines .= "<tr><td>".$row['name']."</td><td>".$row['loginname']."</td><td>".$row['email']."</td><td>".$row['regisztracioideje']."</td><td>".$editcommand.$deletecommand.$activatecommand."</td></tr>";   
               }
            }      
          }
      else {// Mivel volt hibám, ezért naplózom!
           $naplo->_bejegyez($sqlerror);} 

       return $HTMLlines;   
    }

    public function felhasznalo_ment() {

      $this->muvelet = 'insert';

      if (isset($_POST['name'])) {
          $this->name = $_POST['name'];
      } else {
          $this->name = '';
      }
      if (isset($_POST['loginname'])) {
          $this->loginname = $_POST['loginname'];
      } else {
          $this->loginname = '';
      }
      if (isset($_POST['email'])) {
          $this->email = $_POST['email'];
      } else {
          $this->email = '';
      }
      if (isset($_POST['password1'])) {
          $this->password1 = $_POST['password1'];
      } else {
          $this->password1 = '';
      }
      if (isset($_POST['password2'])) {
          $this->password2 = $_POST['password2'];
      } else {
          $this->password2 = '';
      }
      if (isset($_POST['reminder'])) {
          $this->reminder = $_POST['reminder'];
      } else {
          $this->reminder = '';
      }
      $ujdatarendben = true;

      if (empty($this->name)) {
          $ujdatarendben = false;
          $this->hibauzenet = "Nincs megadva a felhasználó neve!";
      }
      if (empty($this->loginname)) {
          $ujdatarendben = false;
          $this->hibauzenet = "Nincs megadva a belépési azonosítója!";
      }
      if (empty($this->email)) {
          $ujdatarendben = false;
          $this->hibauzenet = "Nincs megadva az email cím!";
      }
      if (empty($this->password1) || empty($this->password2)) {
          $ujdatarendben = false;
          $this->hibauzenet = "Nincs megadva mindkét jelszó!";
      }
      if ($ujdatarendben == true) {
          if ($this->password1 != $this->password2) {
              $ujdatarendben = false;
              $this->hibauzenet = "Nem egyformák a jelszavak!";
          }
      }
      $this->fingerprint = veletlenkaraktersor();
      $_password = MD5($this->password2);

      if ($ujdatarendben == true) {

          $this->sqlCommand = "INSERT INTO user (name, loginname, email, regisztracioideje, password, fingerprint, reminder)
                               VALUES ('$this->name',
                                       '$this->loginname',
                                       '$this->email',
                                       '$this->date',
                                       '$_password',
                                       '$this->fingerprint',
                                       '$this->reminder'
                                      )";

          $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(), $this->sqlCommand);
          $this->naplo->_bejegyez($this->sqlCommand);
          $sqlerror = mysqli_error($this->db_kapcsolat->_kapcsolat());

          if (!empty($sqlerror)) {

              $this->naplo->_bejegyez($sqlerror);
              $ujdatarendben = false;
              $this->hibauzenet = "A felhasználónév foglalt";

          } else {

              $aktivalokod = str_replace(["+","/"], ["",""], base64_encode(veletlenkaraktersor("activate-")));

              $this->sqlCommand = "INSERT INTO activation (fingerprint, code, datetime)
                                   VALUES ('$this->fingerprint','$aktivalokod', NOW())";

              $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(), $this->sqlCommand);
              $sqlerror = mysqli_error($this->db_kapcsolat->_kapcsolat());

              if (!empty($sqlerror)) {

                  $this->naplo->_bejegyez($sqlerror);
                  $ujdatarendben = false;
                  $this->hibauzenet = "Hiba az aktiváló link létrehozásakor";

              } else {

                  require_once __DIR__ . '/levelezes.php';

                  $this->naplo->_bejegyez("felkészülés az aktiváló levél elküldésére.");

                  $mailer = new levelkuld(
                      $this->naplo,
                      $GLOBALS['mail_host'],
                      $GLOBALS['mail_user'],
                      $GLOBALS['mail_password']
                  );
                  $felhasznalonev = $this->name;
                  $aktivaciosLink = "http://127.0.0.1/backend/autoberles/index.php?menupont=aktivalas&kod=$aktivalokod";

                  $uzenet = '<html>
                                    <head>
                                      <style>
                                        body { font-family: Arial, sans-serif; background-color: #f5f5f5; color: #333; }
                                        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
                                        h1 { color: #6b9c6f; }
                                        a.button { background: #6b9c6f; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display:inline-block; }
                                        a.button:hover { background: #0056b3; }
                                      </style>
                                    </head>
                                    <body>
                                      <div class="container">
                                        <h1>Üdvözlünk a BérAutó24-nél, '.$felhasznalonev.'!</h1>
                                        <p>Köszönjük, hogy regisztráltál a <b>BérAutó24</b> oldalra. Kattints az alábbi gombra a fiókod aktiválásához:</p>
                                        <p><a href="'.$aktivaciosLink.'" class="button">Fiók aktiválása</a></p>
                                        <p>Ha bármilyen kérdésed van, fordulj hozzánk bizalommal!</p>
                                        <p>Üdvözlettel,<br>BérAutó24 csapata</p>
                                      </div>
                                    </body>
                                    </html>
                                    ';

                  $mailer->levelkuldes(
                      $this->email,
                      "Sikeres regisztráció! – BérAutó24",
                      $uzenet
                  );

                  $this->naplo->_bejegyez("Levél elküldése befejezve.");
                  // =================================

              }
          }
      }

      return $ujdatarendben;
}
   
   public function felhasznalo_szerkeszt($id) {
   	  $this->muvelet = 'edit';
      // - Mivel SELECT COUNT a parancs, ha nincs a feltételnek megfelelő
      //   sor az adatbázisban, akkor is lesz egy visszatérési sor -> tatlalat 0 lesz!   
      $this->sqlCommand = "SELECT id,
                                  name,
                                  loginname,
                                  password,
                                  reminder,
                                  email
                           FROM   user
                           WHERE  id = '$id'";

      // Végrehajtom a lekérdezést úgy, hogy a connection segítségével elküldöm a szervernek!
      
      // - A mysqli_query függvény által összeszedett eredmény halmazt (adatbázis sorai)
      //   az $SQLResult változóba tesszük! 
      $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(),$this->sqlCommand);

    if (empty($sqlerror))
        {
         // Nem volt hibám, így legyártom a listát!
       // - Az $SQLResult változóban található listát lépésről lépésre feldolgozom!
           if (mysqli_num_rows($SQLResult) > 0)
           {
           // Ez a ciklus járja be az eredmény halmazt!
           while ($row = mysqli_fetch_assoc($SQLResult))
            {
              $this->id = $row['id'];
              $this->name = $row['name'];
              $this->loginname = $row['loginname'];
              $password1 = $row['password'];
              $password2 = $row['password'];
              $this->email= $row['email'];
              $this->reminder = $row['reminder'];
            }
           } 
        }
    else {// Mivel volt hibám, ezért naplózom!
        $this->naplo->_bejegyez($sqlerror);} 

   }
   public function felhasznalo_frissit($id)
   {
    $modositottadatrendben = true;
      $this->muvelet = 'update';
      // Jöhet az ellenörzés
      // if ($name == '') = if (empty($name))

      if (isset($_POST['name'])) {
      // Kaptam POST-ot ezért az ideiglenes változóba mentem
      $this->name = $_POST['name']; } 
      else {// - Nem volt megfelelő mező a POST-ban ezért a 
           //   változó tartalmát üresre állítom! Így fogja 
           //   a kötelező mező vizsgálat megállítani a folyamatot.  
           $this->name = '';}
      
      if (isset($_POST['loginname'])) {
      $this->loginname = $_POST['loginname']; } else {$this->loginname = '';}
      if (isset($_POST['email'])) {
      $this->email = $_POST['email']; } else {$this->email = '';}
      if (isset($_POST['password1'])) {
      $this->password1 = $_POST['password1']; } else {$this->password1 = '';}
      if (isset($_POST['password2'])) {
      $this->password2 = $_POST['password2']; } else {$this->password2 = '';}
      
      if (empty($this->name)) 
       {$modositottadatrendben = false;
        $this->hibauzenet = "Nincs megadva a felhasználó neve!";}

      if (empty($this->loginname)) 
       {$modositottadatrendben = false;
        $this->hibauzenet = "Nincs megadva a belépési azonosítója!";}

      if (empty($this->password1) || empty($this->password2)) 
       {$modositottadatrendben = false;
        $this->hibauzenet = "Nincs megadva mindkét jelszó!";}

       if ($modositottadatrendben == true) 
       {
         if ($this->password1 != $this->password2)
            {$modositottadatrendben = false;
             $this->hibauzenet = "Nem egyformák a jelszavak!";}
       }
      /*if (empty($this->password1) || empty($this->password2)) 
       {$ujdatarendben = false;
        $this->hibauzenet = "Nincs megadva mindkét jelszó!";}*/
        $_password = MD5($this->password2);
       if ($modositottadatrendben == true) 
       {
         // - Mivel SELECT COUNT a parancs, ha nincs a feltételnek megfelelő
         //   sor az adatbázisban, akkor is lesz egy visszatérési sor -> tatlalat 0 lesz!   

         $this->sqlCommand = "UPDATE user
                              SET    name = '$this->name',
                                     loginname = '$this->loginname',
                                     email=' $this->email',
                                     password='$_password'
                              WHERE  id = '$id'";
      // global $naplo;
      // $naplo->_bejegyez($this->sqlCommand);
      $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(),$this->sqlCommand); 

       $sqlerror = mysqli_error($this->db_kapcsolat->_kapcsolat());
             if(!empty($sqlerror))
             {
              $this->naplo->_bejegyez($sqlerror);
              $modositottadatrendben=false;
              $this->hibauzenet = "A felhasználónév foglalt";
             }
      }
      // $naplo->_bejegyez($SQLResult);
      return $modositottadatrendben;
   }
   public function torles($id) 
	{
		// - Beállítom a müveletet, azért, mert a termek.html FORM elemének
		//   az action url-jét ez alapján fogom változtatani 
		$this->id = $id;

		$SQLlekerdezes = "UPDATE user
                      SET deleted = 1,
                          state = 0
                      WHERE id = $id";

		// Lefuttatjuk az SQL lekérdezést!
		$SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

		if(isset($sqlhiba))
		{
			$this->naplo->_bejegyez($sqlhiba);
		}
  }
  public function felhasznalo_aktival($id)
   {
     $this->sqlCommand = "UPDATE user
                          SET    state = 1
                          WHERE  id = '$id'";
       $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(),$this->sqlCommand); 
        
   }
 public function felhasznalo_aktivalas_linkbol()
{
    $aktivalva = false;

    // Kód ellenőrzése
    $kod = isset($_GET['kod']) ? $_GET['kod'] : 'EMPTY!';
    $kod = mysqli_real_escape_string($this->db_kapcsolat->_kapcsolat(), $kod);

    // Lekérdezés: a kód létezik és max 24 órás
    $this->sqlCommand = "SELECT u.id as uid, a.id as aid
                         FROM user as u
                         INNER JOIN activation as a ON u.fingerprint = a.fingerprint
                         WHERE a.code = '$kod'
                           AND a.datetime >= DATE_SUB(NOW(), INTERVAL 1 DAY)
                         LIMIT 1";

    $this->naplo->_bejegyez("Aktivációs lekérdezés: " . $this->sqlCommand);

    $SQLResult = mysqli_query($this->db_kapcsolat->_kapcsolat(), $this->sqlCommand);
    $sqlerror = mysqli_error($this->db_kapcsolat->_kapcsolat());

    if (!empty($sqlerror)) {
        $this->naplo->_bejegyez("SQL hiba: " . $sqlerror);
        return false;
    }

    // Ha talált sor
    if ($row = mysqli_fetch_assoc($SQLResult)) {
        $userID = $row['uid'];
        $activationID = $row['aid'];

        // Állapot frissítése 1-re
        $updateSQL = "UPDATE user SET state = 1 WHERE id = '$userID'";
        mysqli_query($this->db_kapcsolat->_kapcsolat(), $updateSQL);
        $updateError = mysqli_error($this->db_kapcsolat->_kapcsolat());
        if (!empty($updateError)) {
            $this->naplo->_bejegyez("Hiba a state frissítésénél: " . $updateError);
            return false;
        }

        // Aktivációs sor törlése
        $deleteSQL = "DELETE FROM activation WHERE id = '$activationID'";
        mysqli_query($this->db_kapcsolat->_kapcsolat(), $deleteSQL);
        $deleteError = mysqli_error($this->db_kapcsolat->_kapcsolat());
        if (!empty($deleteError)) {
            $this->naplo->_bejegyez("Hiba az activation törlésénél: " . $deleteError);
            return false;
        }

        $aktivalva = true;
        $this->naplo->_bejegyez("Felhasználó $userID aktiválva. State = 1.");
    }

    return $aktivalva;
}
}
?>