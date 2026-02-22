<?php

$ertekelesek = new ertekelesek($db_kapcsolat,$naplo);


class ertekelesek
{
    private $naplo;
    private $db_kapcsolat;

    // Adatbázis mezők adattagjai.
    public $ertekeles_id;
    public $csillag;
    public $email;
    public $velemeny;
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

    public function _velemenyek_lista() 
    {
        $HTMLSorok = "";

        $SQLlekerdezes = "SELECT * FROM ertekelesek WHERE deleted = 0";
        $this->naplo->_bejegyez($SQLlekerdezes);

        $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

        if ($SQLeredmeny)
        {
            while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
            {
                    $HTMLSorok .= "<tr>
                    <td>".$row['csillag']."</td>
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
        if (isset($_POST['email'])) {
            $this->email = $_POST['email'];} else {$this->email = '';}
        if (isset($_POST['velemeny'])) {
            $this->velemeny = $_POST['velemeny'];} else {$this->velemeny = '';}
        if (isset($_POST['letrehozva'])) {
            $this->letrehozva = $_POST['letrehozva'];} else {$this->letrehozva = '';}

        // Feltételezem, hogy minden adat megvan ezért a mentés sikeres lesz!
        $sikeresmentes = true;

        // Kötelező érték vizsgálata
        if (empty($this->csillag) || empty($this->email) || empty($this->velemeny) || empty($this->letrehozva))
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

            $SQLlekerdezes = "INSERT INTO ertekelesek (csillag, email, velemeny, letrehozva)
                              VALUES ('$this->csillag', '$this->email', '$this->velemeny', $this->letrehozva)";

            // Lefuttatjuk az SQL lekérdezést!
            $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);

        }
        // Eláruljuk a hívónak, hogy sikeres volt-e a mentés!
        return $sikeresmentes; 
    }

} 

?>