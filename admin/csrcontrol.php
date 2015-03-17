<?php


session_start();
require_once '../header.php';
$_SESSION['backend']=True;
if(!isset($_SESSION["admin"]))
{
	echo "Bitte erst <a href=\"anmeldung.html\">einloggen</a>";
	exit;
}

$user ="peterle";
echo "Daten der CSR von Nutzer \"".$user."\":";
//user + filename noch hartcodiert m�ssen aus der datenbank ausgelesen werden oder vom vorherigen file mit session �bertragen werden

$filename ="wildcard6.csr";

$csrlocation="../users/".$user."/".$filename;


$csr = shell_exec('openssl req -noout -text -in '.$csrlocation);

//echo $csr;

//echo $csrlocation;

$subjectpart = explode('Subject:', $csr);
$subject=$subjectpart[1];
//$subjectstring = implode('', $subjectpart[1]);
$parts= explode (', ', $subject);

echo "<p>&nbsp;</p>";
echo "<table class=\"table table-striped\">";
$countryextend= $parts[0];
$country=str_replace("C=","",$countryextend);
//echo "<p>&nbsp;</p>";
echo "<tr><td>Land:</td><td> ".$country."</td></tr>";
//echo "<p>&nbsp;</p>";

$stateextend=$parts['1'];
$state=str_replace("ST=","",$stateextend);
echo "<tr><td>Bundesland:</td><td> ".$state."</td></tr>";
//echo "<p>&nbsp;</p>";

$locationextend=$parts['2'];
$location=str_replace("L=","",$locationextend);
echo "<tr><td>Ort:</td><td>".$location."</td></tr>";
//echo "<p>&nbsp;</p>";

$Oextend=$parts['3'];
$O=str_replace("O=","",$Oextend);
echo "<tr><td>Name des Unternehmens:</td><td> ".$O."</td></tr>";
//echo "<p>&nbsp;</p>";

$OUextend=$parts['4'];
$OU=str_replace("OU=","",$OUextend);
echo "<tr><td>Organisationseinheit:</td><td> ".$OU."</td></tr>";
//echo "<p>&nbsp;</p>";

$commonnameextended= $parts['5'];
$commonnamepart=explode(" ",$commonnameextended);
$commonnameextend=$commonnamepart[0];
$commonname=str_replace("CN=","",$commonnameextend);
echo "<tr><td>Commonname:</td><td> ".$commonname."</td></tr>";


echo "</table>";
//Sonderaufteilung wegen Commonname & Verschl�sselung
$keyinformation=implode(" ",$commonnamepart);
$modulusextract= explode("Modulus:", $keyinformation);
$publickeypart=$modulusextract[1];
$publickeyextend=explode(" Exponent", $publickeypart);
$publickey=str_replace(" Exponent","", $publickeyextend[0]);
$bitpart =$modulusextract[0];
$bitencrypt=explode("Public-Key:",$bitpart);

echo "<p>&ouml;ffentlicher Schl&uuml;essel:</p><p><table class=\"table table-striped\"><tr><td>"."Verschl�sselt mit ".$bitencrypt[1].":"."</td><td>".$publickey."</td></tr></table></p>";


/*var_dump($modulusextract);
 echo "<p>&nbsp;</p>";
 var_dump($publickey);
 echo "<p>&nbsp;</p>";
 var_dump($csr);*/

//include ("parse.php");
?>



<p>
	<form action="signieren.php" method="post"> 
		<input type="submit" value="Signieren"> 
	</form>
</p>

<p>
	<h3>Bitte geben Sie einen Grund ein, warum die vorliegende CSR-Datei fehlerhaft ist:</h3>	
	
<?php 
$cancelmailcontent="<p>Sehr geehrte Damen und Herren,</p>Leider m�ssen wir Ihre CSR ablehnen, der Grund lautet wie folgt:<p>&nbsp;</p>";

echo "<p>Die Antwort beginnt mit:</p>".$cancelmailcontent;

?>
	<form action="canceled.php" method="post"> 
		<textarea name="cancel" cols="50" rows="10"></textarea>
		<br>
		<input type="submit" value="Nicht signieren"> 
	</form>
</p>
