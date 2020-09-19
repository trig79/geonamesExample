<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	include('../openCage/AbstractGeocoder.php');
	include('../openCage/Geocoder.php');
	

	$geocoder = new \OpenCage\Geocoder\Geocoder('567b937e90104649a9c04ed4005e9f40');

	$result = $geocoder->geocode( '51.952659, 7.632473' ); 
	//$result = $geocoder->geocode( $_POST['lat'] . ', ' . $_POST['lon']);

	$searchResult = [];
	$searchResult['results'] = [];

	$temp = [];

	foreach ($result['results'] as $entry) {

		$temp['source'] = 'opencage';
		$temp['formatted'] = $entry['formatted'];
		$temp['geometry']['lat'] = $entry['geometry']['lat'];
		$temp['geometry']['lng'] = $entry['geometry']['lng'];
		$temp['countryCode'] = strtoupper($entry['components']['country_code']);
		$temp['timezone'] = $entry['annotations']['timezone']['name'];
		$temp['roadinfo']['sideOfRoad'] = $entry['annotations']['roadinfo']['drive_on'];
		$temp['roadinfo']['speed'] = $entry['annotations']['roadinfo']['speed_in'];
		$temp['currency']['name'] = $entry['annotations']['currency']['name'];
		$temp['currency']['symbol'] = $entry['annotations']['currency']['symbol'];

		array_push($searchResult['results'], $temp);
	}

	header('Content-Type: application/json; charset=UTF-8');
	echo json_encode($searchResult, JSON_UNESCAPED_UNICODE);
	
	//return full json.....
	//echo json_encode ( $result [ 'results' ], JSON_UNESCAPED_UNICODE);

?>
