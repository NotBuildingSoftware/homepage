
<?php

//Testseite f�r index-Startseite
//loginvariable, muss z. B. mit Session verbunden und mit einem weiteren if case abgefragt bzw. ge�ndert werden - eingeloggt, ausgeloggt
//�ffnet eine Session um den Status der Anmeldung zu speichern/abzufragen

session_start();
//Beispielcode f�r Anmelde�berpr�fung
//if (!isset($_SESSION['username']))
//	{
//		echo "Bitte erst <a href=\"supercert.php\">einloggen</a>";
//		exit;
//	}

$login = 1;
//nicht angemeldet

if ($login == 1){
include ("logintemplate.html");

//direkte Einbindung
 include ("anmeldung.html");
 include ("registrierung.html");
 }
 
else {
	

//bereits angemeldet
if ($login == 2){
	//statt $login==2 Sessionwerte abfragen ob der Kunde von csrupload.php kommt - dann csr weiterverarbeitung
	
	//include ("xy");
	if ($login == 2){
	include ("Homepage.html");
}
else {
	echo "Ein Fehler ist w�hrend Ihrer Anmeldung aufgetreten";
	exit;
	
}
}



}


//wird evtl. sp�ter gebraucht um Seite von dieser Seite aufzubauen
/*
$homepage = get_homepage_parts('./homepage.html');
//Template Tags ersetzen
foreach ($template as &$part) {
	switch ($part) {
		case 'title';
		$part = title();
		break;
		
	}
}


echo implode($homepage)*/
?>