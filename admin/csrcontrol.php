<?php

//$command = "openssl req -in C:\Vera\Programme\Openssl\openssl\intermediateTest2.csr (-noout) -text";
//$out = shell_exec($command);

//Test
$out = "bla bla bla awqgnri�vn a�kd,fome�p�m Subject: C=DE, ST=Bayern, L=HDH, O=DHBW, fewnIFP��Subject Public Key Info:rsaEncryption 2058 bit Modulus:CEJF wepfc jnpEOWMJFMCEWOPVMJ�Exponent:ncvadieognaro�n Signature Algorithm: sha256WithRSAEncryption";

echo "<br>";
echo "Hier die komplette CSR ungeparst:";
echo "<br>";
echo $out;
echo "<br>";
echo "<br>";


include ("CSR_read.html");

?>