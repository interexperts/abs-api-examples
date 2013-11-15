<?php

/*****************************************************
 * Voorbeeld van ABS API:							 *
 * Opvragen adressen op basis van filter.			 *
 *****************************************************/

header('Content-Type: text/html; charset=utf-8');

include("includes/base.inc.php");

//zoek alle adressen waarbij in de achternaam 'er' voorkomt.
$adressen = absApiCall('GET', 'geef_adressen', array('achternaam'=>'er'), $apiClientName, $apiSecret, $apiEndpoint);

if (isset($adressen->errorCode)) {
	echo $adressen->errorMessage;
} else {
	echo "<p>Gevonden: <strong>" . $adressen->resultData->aantal . "</strong> adres(sen)!</p>";

	// Itereer over resultaten:
	foreach ($adressen->resultData->adressen as $adres) {
		echo '	<p>
					Voornaam: ' . $adres->voornaam. '<br />
					Achternaam: ' . $adres->achternaam.'<br />
			 ';
		
			 if(isset($adres->bedrijf->bedrijfsnaam)) {
				 echo 'Bedrijfsnaam: ' . $adres->bedrijf->bedrijfsnaam;
			 }
			 
		echo '</p>';
	}
}