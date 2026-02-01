<?php

function veletlenkaraktersor($prefix = "")
{
	// Nagybetűk A–Z
	$nagyBetuk = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

	// Kisbetűk a–z
	$kisBetuk = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

	// Számok 0–9
	$szamok = ['0','1','2','3','4','5','6','7','8','9'];
	$spec_karakterek = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')','-', '_', '=', '+', '[', ']', '{', '}', ';', ':',
    '"', '|', ',', '.', '<', '>', '?','`', '~', '€', '£', '¥', '¢', '§', '©', '®', '™','°', '±', '¶', '×', '÷', '¿', '¡', '•', '√', '∞'];
	// Ez egy tömb lesz, amibe egy véletlen láncolatot generálok a nagybetűkből.
	for ($szamlalo = 0; $szamlalo < count($nagyBetuk)-1; $szamlalo++)
	{
		$kivalogatottkarakter[] = $nagyBetuk[array_rand($nagyBetuk)];
	}
	for ($szamlalo = 0; $szamlalo < count($kisBetuk)-1; $szamlalo++)
	{
		$kivalogatottkarakter[] = $kisBetuk[array_rand($kisBetuk)];
	}
	for ($szamlalo = 0; $szamlalo < count($szamok)-1; $szamlalo++)
	{
		$kivalogatottkarakter[] = $szamok[array_rand($szamok)];
	}
	for ($szamlalo = 0; $szamlalo < count($spec_karakterek)-1; $szamlalo++)
	{
		$kivalogatottkarakter[] = $spec_karakterek[array_rand($spec_karakterek)];
	}
	for ($szamlalo = 0; $szamlalo < count($kivalogatottkarakter)-1; $szamlalo++)
	{
		$veletlen_karaktersor[] = $kivalogatottkarakter[array_rand($kivalogatottkarakter)];
	}
	// A kapott veletlen_karaktersort tartalmazó tömböt string formátummá konvertáljuk.
	return $prefix.implode("", $veletlen_karaktersor);
}

?>