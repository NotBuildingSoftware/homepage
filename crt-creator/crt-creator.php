<?php
//Tage �ber irgendein Feld von der Webseite �bertragen
$days = "365";

//Name des Ordners des Users
$dir = "";

//csr werden mit welchem Namen hochgeladen?		(momentan ca.csr)
//selber Name f�r die CRT-Datei?				(momentan WC.crt)

//config-File von quasi root, der vom Server verwenden, wo abgelegt?

//kann ich einfach openssl aufrufen oder muss ich daf�r auch erst auf ein bestimmtes Verzeichnis


//Intermediate:
$command = "\usr\bin\openssl ca -config intermediate.cnf -days ";
$command += $days;
$command += " -in ";
$command += $dir;
$command += "\ca.csr -extensions v3_ca -out ";
$command += $dir;
$command += "\WC.crt";
$output = shell_exec($command);


//WC:
$command = "\usr\bin\openssl ca -config intermediate.cnf -days ";
$command += $days;
$command += " -in "; 
$command += $dir;
$command += "\ca.csr -out ";
$command += $dir;
$command += "\WC.crt";
$output = shell_exec($command);

?>
