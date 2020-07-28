<?php
require_once('../configurationHandler.php');

$configurationHandler = new ConfigurationHandler();

$locationLattitude = $configurationHandler->getGlobalConfiguration("locationLattitude");
$locationLongitude =  $configurationHandler->getGlobalConfiguration("locationLongitude");
$apiKey =  $configurationHandler->getGlobalConfiguration("weatherApiKey");
$weatherMapURL = "http://api.openweathermap.org/data/2.5/weather?units=metric&lat=" . $locationLattitude . "&lon=" . $locationLongitude . "&APPID=" . $apiKey;

$curl = curl_init();
$options = array(
	CURLOPT_URL => $weatherMapURL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true
);

if (!curl_setopt_array($curl, $options)) {
    throw new Exception('Failed to setup cURL options');
}

$response = curl_exec($curl);
$error = curl_error($curl);
curl_close($curl);
$data = json_decode($response);

if ($error) {
	echo "cURL Error #:" . $err;
}
