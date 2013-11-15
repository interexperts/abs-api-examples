<?php

/*****************************************************
 * Voorbeeld van ABS API:							 *
 * Opvragen categorieën.							 *
 *****************************************************/

header('Content-Type: text/html; charset=utf-8');

include("includes/base.inc.php");

$categorieen = absApiCall('GET', 'geef_categorieen', array(), $apiClientName, $apiSecret, $apiEndpoint);
echo "<p>Gevonden: <strong>" . $categorieen->resultData->aantal . "</strong> categorieën!</p>";

if (isset($categorieen->errorCode)) {
	echo $categorieen->errorMessage;
} else {
	// Itereer over resultaten:
	
	print_r($categorieen);
	
	foreach ($categorieen->resultData->categorieen as $cat) {
		echo '<p>' . $cat->afkorting . ' - ' . $cat->naam . '</p>';
	}
}