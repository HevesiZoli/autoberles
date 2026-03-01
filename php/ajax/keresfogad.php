<?php
  // - Minden PHP állomány legelejére kell, csak egyszer!
  //   tehát minden ebben a PHP állományban behívott PHP állomány
  //   megörökli ezt a beállítást!
  header('Content-type: text/html; charset=utf-8');

  // Munkamenet inditása
  session_start();

  // Az alternatív útvonal problémáját feloldó utvonal.php állomány behívása.
  include('../utvonal.php');

  // Az oldal működéséhez szükséges alapvető konfigurációs beállítások behívása
  include(gyoker().'/config/config.inc');

  // Behívjuk a hibát naplózó php-t
  include(gyoker().'/php/naplo.php');

  $naplo->_bejegyez("Ajax kérés érkezett.");

  try{
    // Minden objektum által elérhető függvényeim
    include(gyoker().'/php/fuggvenyek.php');
    // echo(veletlenkaraktersor("user-").date('Y').date('m').date('d')); <-- Itt egy minta, így teszteltem
    // Adatbázis kapcsolat felépítéséhet szükséges PHP
    include(gyoker().'/php/adatbaziskapcsolat.php');
    // Naplózzuk az oldal betöltődését
    $naplo->_bejegyez("Az oldal újratöltődött.");
    // A munkamenet tárolóból tudjuk, hogy belépett-e a felhasználó
    include(gyoker().'/php/munkamenet.php');
    // Beillesztjük a belépésért felelős objektumot.
    include(gyoker().'/php/belepes.php');
    // tartalom.php behívása
    include(gyoker().'/php/tartalom.php');
  }
  catch (\ERROR $weblaphiba) {$naplo->_bejegyez(basename($weblaphiba->getFile()).', sor: '.$weblaphiba->getLine().', hiba: '.$weblaphiba->getMessage());}
  
?>