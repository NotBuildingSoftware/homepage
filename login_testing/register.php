<?php
$verbindung = mysqli_connect("localhost", "root" , "", "dhbw_ca") 
or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

$username = $_POST["username"];
$passwort = $_POST["passwort"];
$passwort2 = $_POST["passwort2"];

if($passwort != $passwort2 OR $username == "" OR $passwort == "")
{
	echo "Eingabefehler. Bitte alle Felder korekt ausf�llen. <a href=\"register.html\">Zur�ck</a>";
	exit;
}
$passwort = md5($passwort);

$result = mysqli_query($verbindung, "SELECT id FROM login WHERE username LIKE '$username'");
$menge = mysqli_num_rows($result);

if($menge == 0)
{
	$eintrag = "INSERT INTO login (username, passwort) VALUES ('$username', '$passwort')";
	$eintragen = mysqli_query($verbindung, $eintrag);

	if($eintragen == true)
	{
	echo "Benutzername <b>$username</b> wurde erstellt. <a href=\"login.html\">Login</a>";
	}
	else
	{
		echo "Fehler beim Speichern des Benutzernames. <a href=\"register.html\">Zur�ck</a>";
        }


    }

else
    {
				echo "Benutzername schon vorhanden. <a href=\"register.html\">Zur�ck</a>";
    }
    ?>