<?php  

$ertekelesek = new ertekelesek($db_kapcsolat,$naplo);


class ertekelesek
{
    private $naplo;
    private $db_kapcsolat;

    // Adatbázis mezők adattagjai.
    public $ertekeles_id;
    public $csillag;
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

    public function uj_ertekeles()
    {

        // - Beállítom a müveletet, azért, mert a termek.html FORM elemének
        //   az action url-jét ez alapján fogom változtatani 
        $this->muvelet = 'insert';

        $SQLlekerdezes = "INSERT INTO ertekelesek (csillag, velemeny, letrehozva)
                          VALUES ('$this->csillag', '$this->velemeny', $this->letrehozva)";

        // Lefuttatjuk az SQL lekérdezést!
        $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(),$SQLlekerdezes);
    }

} 

?>