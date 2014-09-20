<?php
/*
require_once('googlePlaces.php');

$apiKey       = 'AIzaSyDO2ZlMqcFNGz9tESNlI3KPzi2nZ_05udY';
$googlePlaces = new googlePlaces($apiKey);

// Set the longitude and the latitude of the location you want to search near for places
$latitude   = '-33.8804166';
$longitude = '151.2107662';
$googlePlaces->setLocation($latitude . ',' . $longitude);

$googlePlaces->setRadius(5000);
$results = $googlePlaces->Search();

print_r($results);
*/


$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/xml?location=48.859294,2.347589&radius=500&types=food&sensor=false&key=AIzaSyA2OZnqvdOJDIT-EFvb6C2drQWrbSvbcD0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
print_r($response);
?>