<!DOCTYPE html>
<!-- test -->
<html>
<div>
<body>
<h1>Bitte f�llen Sie f�r eine erfolgreiche Registration alle Felder aus :</h1>
<form>
<tr>
<td>Benutzername</td>
<td>Passwort</td>
</tr>
<tr>
<td>
<input type="text">
</td>
<td>
<input type="text">
</td>
</tr>
<tr>
<td colspan="2">
<input type"submit" value"Anmelden">
</td>
</tr>
</form>
</div>
</html>
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

$login = 2;
//nicht angemeldet

if ($login == 1){
include ("logintemplate.html");

//direkte Einbindung
 include ("anmeldung.html");
 include ("registrierung.html");
 }
 
else {
	echo "Ein Fehler ist w�hrend Ihrer Anmeldung aufgetreten";
	exit;
}

//bereits angemeldet
if ($login == 2){
	include ("Homepage.html");
}
else {
	
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