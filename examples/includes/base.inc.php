<?php

/*  */

/*
 * Dit bestand bevat een voorbeeldfunctie om de API aan te roepen en daaronder
 * ook een voorbeeld hoe deze functie gebruikt kan worden. Deze code is verder
 * zonder beperkingen aan te passen of te verspreiden. 
 */

/**
 * Basismethode om ABS API function calls te maken
 * @param	$httpMethode 	'POST' of 'GET'
 * @param	$actie			Uit te voeren actie op de API
 * @param	$data			Array met mee te geven data voor API, afhankelijk van actie
 * @param	$apiClientName	Client name voor API authenticatie
 * @param	$apiSecret		Private secret voor API authenticatie
 * @param	$apiEndpoint	URL endpoitn voor API
 *
 * @example	absApiCall('GET', 'versie', array(), $apiClientName, $apiSecret, $apiEndpoint);
 * 			geeft de versieinformatie van ABS terug
 */
function absApiCall ($httpMethode, $actie, $data, $apiClientName, $apiSecret, $apiEndpoint) {
	$ch = curl_init();

	// Neem meegestuurde data over:
	$requestData = $data;

	// Voeg de volgende velden toe:
	$requestData['v'] = 1;
	$requestData['client'] = $apiClientName;
	$requestData['actie'] = $actie;
	$requestData['time'] = strftime('%Y-%m-%dT%H:%M:%S');

	// Sorteer op naam veld:
	ksort($requestData);

	// Start hashberekening:
	$hashInput = $apiSecret;

	// Voeg nu (op alfabetische volgorde van variabelenaam) de rest van de get/post-
	// parameters toe aan $hashInput. $hashInput dient als inputstring voor de hash
	foreach ($requestData as $key => $value) {
		$hashInput .= ';';
		$hashInput .= $key . '=';
		$hashInput .= $value;
	}

	// Gebruik hash als $requestData veld:
	$requestData['hash'] = sha1($hashInput);

	// Bepaal URL:
	if ($httpMethode == 'POST') {
		curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	} else {
		$url = $apiEndpoint . '?' . http_build_query($requestData);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	}

	// Voer request uit en vertaal terug naar JSON:
	$result = curl_exec($ch);

#	$info = curl_getinfo($ch);
#	echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];	
#	die();
	
	// Geef uit JSON vertaald object terug:
	return json_decode($result);
}

// Settings:
$apiClientName = '';
$apiSecret = '';
$apiEndpoint = 'http://abs.localhost/plugins/api/endpoint.php';
