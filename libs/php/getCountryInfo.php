<?php

	$executionStartTime = microtime(true) / 1000;

	$apiKey = 'c26ef332f383478c2a2fbbe54d286bc1';
	$url='api.openweathermap.org/data/2.5/weather?q=' . $_REQUEST['city'] . '&units=metric&appid=' . $apiKey;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);

	$result=curl_exec($ch);

	curl_close($ch);

	$decode = json_decode($result,true);	

	$output['data']['status']['code'] = "200";
	$output['data']['status']['name'] = "ok";
	$output['data']['status']['description'] = "mission saved";
	$output['data']['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
	$output['data']['result'] = $decode;  //had to change the logic here as i could not get the array to attach and export as originally defined.
	
	header('Content-Type: application/json; charset=UTF-8');
	
	echo json_encode($output); 

?>
