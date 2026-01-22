<?php

 // Egyszerű naplózás CLASS nélkül Nemes Dávid kérésére!

 $errorlog = gyoker().'/log'; // <- Az elérési útban szereplő könyvtárnak léteznie kell!

 // Ellenőrízni kell, hogy tudunk-e a könyvtárba írni?
 if (is_writable(dirname($errorlog)))
 	{
 		ini_set('log_errors', 1);
 		ini_set('error_log',$errorlog.'/errors.log');
 		
 		// Paraméterezve így tudom a log-ban megjelenő tartalmat szabályozni
 		// error_reporting(E_ERROR | E_WARNING | E_PARSE);

 		// Telejes lsita
 		error_reporting(E_ALL);
 	}

 $naplo = new naplo($log_enabled);

 $naplo->_bejegyez("Böngészőben betöltődött az oldal.");

 class naplo {

 	/* - Ebben a változóban tárolom ideiglenesen a hibaüzenetet.
 	     Nem lenne így kötelező viszont, ha a tertelmát szeretném
 	     mósosítani kiírás előtt, ebben legalább meg lesz az eredeti
 	     üzenet szövege! */
 	private $errorLine;
 	
 	/* Napló állomány könyvtára */
 	private $logPath;

 	/* Napló állomány */
 	private $logFile;

   // Naplózás ki vagy éppen bekapcsolása
   private $logEnabled;

 	/* - Konstruktor - a $this szóval utalunk a saját 
 		 fentebb létrehozott változóra! */
 	public function __construct($lena = true)
 	{
 		// Beállítom, hogy be van-e kapcsolva
      $this->logEnabled = $lena;

      // - Ha nagyon biztosra akarok menni, akkor ide teszek
 		//   egy nagyon felesleges lépést :)
 		$this->errorLine = "";

 		// Beállítom a LOG állomány helyét és nevét!
 		$this->logPath = gyoker().'/log/';
 		$this->logFile = date("Y-m-d").'-naplo.txt';
 	}

 	// Destruktor
   	public function __destruct() 
   	{
   	}

   	public function _bejegyez($uzenet) {
   		
         if($this->logEnabled == true)
         {
            /* - Összeállítom a hibaüzenetet, az üzenet elé
      		     beillesztem a dátumot, majd az időpontot! 
      		     A teljes karakterláncot .-al fűzöm össze! */
      		$this->errorLine = date("Y-m-d").' - '.date("h:i:sa").' - '.$uzenet;

      		if (!file_exists($this->logPath.$this->logFile))
      		{
      			/* Nem létezett, ezért létrehozom */
      			$logFile_handle = fopen($this->logPath.$this->logFile,"w");
      			/* Bezárom a frissen létrehozott állományomat! */
      			fclose($logFile_handle);
      		}
      		// Új bejegyzést fűzök a naplóhoz!
      		file_put_contents($this->logPath.$this->logFile,$this->errorLine.PHP_EOL,FILE_APPEND);
         }
   	}

 }	
?>