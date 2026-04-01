<?php

$ertekeles = new ertekelesek($db_kapcsolat,$naplo);


class ertekelesek
{
    private $naplo;
    private $db_kapcsolat;

    // Adatbázis mezők adattagjai.
    public $ertekeles_id;
    public $csillag;
    public $nev;
    public $email;
    public $velemeny;
    public $letrehozva;
    public $deleted;
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
        $this->letrehozva = date("Y-m-d H:i:s");
    }

    public function __destruct() {
        $this->naplo->_bejegyez(__CLASS__.' osztály megsemmisült.');
    }

    public function _velemenyek_lista() 
    {
        $HTMLSorok = "";

        $SQLlekerdezes = "  SELECT  ertekeles_id,
                                    csillag,
                                    nev,
                                    email,
                                    velemeny,
                                    letrehozva,
                                    deleted
                            FROM ertekelesek WHERE deleted = 0";
        $this->naplo->_bejegyez($SQLlekerdezes);

        $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

        if ($SQLeredmeny)
        {
            while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
            {
                    $HTMLSorok .= "<tr>
                    <td>".$row['csillag']."</td>
                    <td>".$row['nev']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['velemeny']."</td>
                    <td>".$row['letrehozva']."</td>

                    </tr>";
            }
        }
        else 
        {
            $this->naplo->_bejegyez(mysqli_error($this->db_kapcsolat->_kapcsolat()));
        }

        return $HTMLSorok;
    }

    public function uj_ertekeles()
    {

        // - Beállítom a müveletet, azért, mert a termek.html FORM elemének
        //   az action url-jét ez alapján fogom változtatani 
        $this->muvelet = 'insert';

        // - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
        //   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
        //   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
        //   vizsgálatnál majd kibukik, ha nem kaptam adatot!
        if (isset($_POST['csillag'])) {
            $this->csillag = $_POST['csillag'];} else {$this->csillag = '';}

        if (isset($_POST['nev'])) {
            $this->nev = $_POST['nev'];} else {$this->nev = '';}

        if (isset($_POST['email'])) {
            $this->email = $_POST['email'];} else {$this->email = '';}

        if (isset($_POST['velemeny'])) {
            $this->velemeny = $_POST['velemeny'];} else {$this->velemeny = '';}

        // Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
        $sikeresmentes = true;

        // Kötelező érték vizsgálata
        if (empty($this->csillag) || empty($this->email) || empty($this->velemeny))
            {
                $this->uzenet = 'Kérem tötlse ki a kötelező mezőket!';
                $sikeresmentes = false;}

        // - Cask akkor kezdek a mentéhez, ha a kötelező érték
        //   vizsgálat már lefutott, és a $sikeresmentes változó
        //   megengedi a mentést!
        if ($sikeresmentes == true)
        {
            // - A termékeket akarom listázni, ezek adatbázisban vannak
            //   ezért elkészítem az SQL lekérdezést!

            $SQLlekerdezes = "INSERT INTO ertekelesek (csillag, nev, email, velemeny,letrehozva)
                  VALUES ('$this->csillag', '$this->nev', '$this->email', '$this->velemeny','$this->letrehozva')";

            // Lefuttatjuk az SQL lekérdezést!
            $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

        }
        // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
        return $sikeresmentes; 
    }

    public function szerkeszt($ertekeles_id) 
    {
        // - Beállítom a müveletet, azért, mert a termek.html FORM elemének
        //   az action url-jét ez alapján fogom változtatani 
        $this->muvelet = 'edit';
        $this->ertekeles_id = $ertekeles_id;

        // - A terméket akarom szerkeszteni, ezek adatbázisban vannak
        //   ezért elkészítem az SQL lekérdezést!

        $SQLlekerdezes = "SELECT * FROM ertekelesek WHERE ertekeles_id = '$this->ertekeles_id' ";

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
                $this->csillag = $egysor['csillag'];
                $this->nev = $egysor['nev'];
                $this->email = $egysor['email'];
                $this->velemeny = $egysor['velemeny'];
            }
        }
        else {
            // - Nem volt üres az sqlhiba, ezért elküldöm a naplóba ahibát!
            $this->naplo->_bejegyez($sqlhiba);
        }
    }

    public function modosit($ertekeles_id) 
    {
        // - Beállítom a müveletet, azért, mert a termek.html FORM elemének
        //   az action url-jét ez alapján fogom változtatani 
        $this->muvelet = 'update';
        $this->ertekeles_id = $ertekeles_id;
        // - Be kell gyűjtenem a POST-olt adatokat, de figyelnem kell
        //   arra, hogy létezik-e a POST! Abban az esetben, ha nem létezik
        //   (else ág) a változó értékét feltöltöm semmivel! A kötelző érték
        //   vizsgálatnál majd kibukik, ha nem kaptam adatot!
        if (isset($_POST['csillag'])) {
            $this->csillag = $_POST['csillag'];} else {$this->csillag = '';}
        if (isset($_POST['nev'])) {
            $this->nev = $_POST['nev'];} else {$this->nev = '';}
        if (isset($_POST['email'])) {
            $this->email = $_POST['email'];} else {$this->email = '';}
        if (isset($_POST['velemeny'])) {
            $this->velemeny = $_POST['velemeny'];} else {$this->velemeny = '';}
        // Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
        $sikeresmentes = true;

        // Kötelező érték vizsgálata
        if (empty($this->csillag) || empty($this->nev) || empty($this->email) || empty($this->velemeny)) 
            {$this->hibauzenet = 'Kérem tötlse ki a kötelező mezőket!';
             $sikeresmentes = false;}

        // - Cask akkor kezdek a mentéhez, ha a kötelező érték
        //   vizsgálat már lefutott, és a $sikeresmentes változó
        //   megengedi a mentést!
        if ($sikeresmentes == true)
         {
            // - A termékeket akarom listázni, ezek adatbázisban vannak
            //   ezért elkészítem az SQL lekérdezést!

            $SQLlekerdezes = "UPDATE ertekelesek 
                              SET    csillag = '$this->csillag',
                                     nev = '$this->nev',
                                     email = '$this->email',
                                     velemeny = '$this->velemeny'
                              WHERE  ertekeles_id = '$this->ertekeles_id' ";

            // Lefuttatjuk az SQL lekérdezést!
            $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
         }
         // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
         return $sikeresmentes; 
    }

    public function torles($ertekeles_id) 
    {
        // - Beállítom a müveletet, azért, mert a termek.html FORM elemének
        //   az action url-jét ez alapján fogom változtatani 
        $this->muvelet = 'delete';
        $this->ertekeles_id = $ertekeles_id;

        $SQLlekerdezes = "UPDATE ertekelesek
                          SET deleted = 1
                          WHERE ertekeles_id = $ertekeles_id";

        // Lefuttatjuk az SQL lekérdezést!
        $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

        if(isset($sqlhiba))
        {
            $this->naplo->_bejegyez($sqlhiba);
        }
    }

    public function _velemenyek_csuszka() 
    {
    $HTMLlines = "";
    $SQLlekerdezes = "  SELECT  nev, 
                                velemeny, 
                                csillag 
                        FROM ertekelesek 
                        WHERE deleted = 0 
                        ORDER BY letrehozva DESC";
    
    $this->naplo->_bejegyez($SQLlekerdezes);
    $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

    if ($SQLeredmeny) {
        $counter = 0;
        $all_rows = mysqli_fetch_all($SQLeredmeny, MYSQLI_ASSOC);
        
        // Hármasával daraboljuk a tömböt
        $chunks = array_chunk($all_rows, 3);

        foreach ($chunks as $index => $group) {
            // Az első csoport kapja meg az 'active' osztályt
            $activeClass = ($index === 0) ? "active" : "";
            
            $HTMLlines .= '<div class="doboz-csoport ' . $activeClass . '">';
            
            foreach ($group as $row) {
                $HTMLlines .= ' <div class="doboz">
                                    <strong>'.$row['nev'].'</strong>
                                    <p>'.$row['velemeny'].'</p>
                                    <span>'.str_repeat('★', $row['csillag']).'</span>
                                </div>';
            }
            $HTMLlines .= '</div>';
        }
    }
    return '<div class="csuszo-kontener">' . $HTMLlines . '</div>';
    }


} 
?>