<?php  

$RESTVAGYOK = true;

include('utvonal.php');     
include('config/config.inc');
include('naplo.php');
include('jarmuvek.php'); // $autok objektum létrehozása

$uzenet= file_get_contents('php://input');

if(isset($uzenet) && !empty($uzenet))
{
	 $naplo->_bejegyez('Rest kérés érkezett:  '.$uzenet);
}

?>