<?php

//Datenbankabfrage ob bereits Zertifikate gekauft wurden + Auflistung
//certcount soll die Anzahl der Zertifikate darstellen, im Mom. noch fest codiert
$certcount = 5;

//Pr�fung ob Zertifikate gekauft werden
		if ($certcount !== Null){
			
			//Darstellung als Liste/Tabelle
			echo "<table>";
			while ($certcount !== Null){
				//in den jeweiligen tds m�ssen dann die jeweiligen pendants der datenbank eingef�gt werden
				echo "<tr>";
				echo "<td>";
				echo "$certcount";
				echo "<td>";
				echo "<td>";
				echo "Zertifikatsart";
				echo "<td>";
				echo "<td>";
				echo "Zertifikatsdownload";
				echo "<td>";
				echo "</tr>";
				
				$certcount=$certcount-1;
			}
						
			echo "</table>";
			
}	

		else {
			echo "Bislang haben Sie noch kein Zertifikat erworben";
		}
?>