<?php

/*****************************************************
 * Voorbeeld van ABS API:							 *
 * Nieuws adres toevoegen.							 *
 *****************************************************/

header('Content-Type: text/html; charset=utf-8');

include("includes/base.inc.php");

//Voeg meneer Jansen toe
$adres = absApiCall('POST', 'nieuw_adres',
			array(	'voornaam'=>'Jan',
					'achternaam'=>'Jansen',
					'straatnaam'=>'Dorpstraat',
					'huisnr'=>'10',
					'postcode'=>'1000HA',
					'plaats'=>'Hoofddorp',
					'email'=>'jan.jansen@interexperts.nl',
					'initialen'=>'',
					'aanhef'=>'',
					'tussenvoegsel'=>'',
					'huisnr_toevoeging'=>'',
					'categorieen'=>'',
					'land'=>'',
					'website'=>''
			),
			$apiClientName, $apiSecret, $apiEndpoint);

if (isset($adres->errorCode)) {
	echo $adres->errorMessage;
} else {
	echo 'Adres met id '. $adres->resultData->id. ' toegevoegd!';
	
}