
<?php
require_once 'header.php';
echo "<div class=\"container\">";
$timestamp = time ();
$datum = date ( "Ymd", $timestamp );
$uhrzeit = date ( "Hi", $timestamp );



if ($_FILES != Null) {
	session_start ();
	
	/*
	  echo "<pre>";
	  echo "FILES:<br />";
	  print_r ($_FILES );
	  echo "</pre>";
	  var_dump($_FILES);
	  var_dump($_SESSION);
	  var_dump($_POST);
	 
	var_dump ( $_SESSION );*/
	if ($_FILES ['csruploadfile'] ['name'] != Null) {
		
		$zugelassenedateitypen = array (
				"application/x-x509-ca-cert" || "application/octet-stream" || "application/pkcs10" 
		);
		
		if (! in_array ( $_FILES ['csruploadfile'] ['type'], $zugelassenedateitypen )) {
			echo "<p>Dateitype ist NICHT zugelassen</p>";
		} else {
			
			
			
					
			move_uploaded_file ( $_FILES ['csruploadfile'] ['tmp_name'], 'users/' . $_SESSION ['username'] ."/". $_SESSION ['certtype'] . $datum . $uhrzeit . /*$_FILES ['csruploadfile'] ['name']*/".csr" );
			$filepath = 'users/' . $_SESSION ['username'] ."/". $_SESSION ['certtype'] . $datum . $uhrzeit . /*$_FILES ['csruploadfile'] ['name']*/".csr";
			$username = $_SESSION ['username'];
			$db_timestamp = $datum.$uhrzeit;
			
			// Mail Adresse muss noch im Webserver in der init hinterlegt werden
			$empfaenger = "projektca@gmx.de";
			$absendername = "CSR Anfrage Formular";
			$absendermail = "projektca@gmx.de";
			$betreff = "Eine neue Zertifikatsanfrage ist eingetroffen";
			// Auf Nennung des Users wird aus Sicherheitsgründen verzichtet, da die Information direkt im Adminpanel bereitsteht
			$text = "Eine neue CSR wurde hochgeladen.";
			mail ( $empfaenger, $betreff, $text, "From: $absendername <$absendermail>" );
			
			
			//Übertragen der Zertifikatsdaten in die DB
			include 'dbconnect.php';
			$laufzeit = $_SESSION['dauer'];
			$laufzeit= mysqli_real_escape_string ($db, $laufzeit);
			$eintrag = "INSERT INTO cert (user, csr_pfad, laufzeit, status, csr_timestamp) VALUES ('$username', '$filepath', '$laufzeit' , 0, '$db_timestamp')";
			$eintragen = mysqli_query($db, $eintrag);
			
			
			echo "<p>Der Upload Ihrer CSR Datei war erfolgreich!</p>";
			echo "<p>Als nächstes werden wir Ihre Anfrage prüfen. Sollte Ihre Anfrage sowie die CSR Datei korrekt sein werden wir Ihr signiertes Zertifikat erstellen.</p>";
			echo "<p>Dieses, sowie den aktuellen Bearbeitungsstand können Sie Ihrem Kundenprofil entnehmen.<br>Zu diesem <a href=\"supercert.php\">gelangen Sie hier.</a></p>";
			
			
		
			
			// echo '<a href="'.$_SESSION['username'].'/'. $_FILES['csruploadfile']['name'] .'">';
			// echo $_SESSION['username']. $_FILES['csruploadfile']['name'];
			// echo '</a>';
		}
		if($_SESSION ['certtype'] == "san")
		{
						//CNF-Dateigerüst kopieren
			$from = "/var/www/html/sanconfig/grund.cnf";
			$to = "/var/www/html/users/{$username}/grund.cnf";
			copy($from, $to);
			
			//Datei umbennen in cnf
			rename("/var/www/html/users/{$username}/grund.cnf", "/var/www/html/users/{$username}/{$username}.cnf");
			
			//SAN eingaben in variable packen
			$saninput = "\n[ alt_names ]
DNS.1 = {$_POST["dns"]}
DNS.2 = {$_POST["dns2"]}
DNS.3 = {$_POST["dns3"]}"
;
			
			//CNF-Datei mit den Usereingaben füllen
			$inhalt = file_get_contents("/var/www/html/users/{$username}/{$username}.cnf");
			file_put_contents("/var/www/html/users/{$username}/{$username}.cnf", $inhalt .= "{$saninput}");
			
			
		}
		
	}
} 

else {
	// echo "<pre>";
	// echo "FILES:<br />";
	// print_r ($_FILES );
	// echo "</pre>";
	// var_dump($_SESSION);
	// var_dump($_POST);
	echo "<html>";
	echo "<div class=\"form-group\">";
    echo "<label for=\"exampleInputFile\">Bitte laden Sie Ihre CSR auf unseren Server:</label>";
	echo "<form name=\"uploadformular\" enctype=\"multipart/form-data\" action=\"csrupload.php\" method=\"post\">";
	echo "<p><input type=\"file\" name=\"csruploadfile\" id=\"exampleInputFile\">";
	
	
	//Zusatzeingaben bei dem SAN-Zertifikat
	if ($_SESSION ['certtype'] == "san")	
	{
		echo "<p>DNS: <input type=\"text\" name=\"dns\" /></p>";
		echo "<p>DNS2: <input type=\"text\" name=\"dns2\" /></p>";
		echo "<p>DNS3: <input type=\"text\" name=\"dns3\" /></p>";
	
	}
	echo "<p><br><input type=\"Submit\" name=\"csrupload\" value=\"Datei hochladen\" class=\"btn btn-primary\">";
	echo "</form>";
	
	echo "<form name=\"cancel\" action=\"supercert.php\" method=\"post\">";
	echo "<br><input type=\"Submit\" name=\"cancel\" value=\"Abbrechen\" class=\"btn btn-primary\"></p>";
	echo "</form>";
	echo "</div>";
	echo "</html>";
}

// foreach ($_FILES["csr"]["error"] as $key => $error) {
// if ($error == UPLOAD_ERR_OK) {
// $tmp_name = $_FILES["csr"]["tmp_name"][$key];
// $name = $_FILES["csr"]["name"][$key];
// move_uploaded_file($tmp_name, "data/$name");
// }
// }
echo "</div>";
?>


