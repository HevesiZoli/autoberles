<?php  

$RESTVAGYOK = true;

include('naplo.php');
include('adatbaziskapcsolat.php'); 
include('jarmuvek.php'); // $autok objektum létrehozása

$uzenet= file_get_contents('php://input');

if(isset($uzenet) && !empty($uzenet))
{
	 $naplo->_bejegyez('Rest kérés érkezett:  '.$uzenet);
}

?>