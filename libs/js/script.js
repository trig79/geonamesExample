$('#btnRun').click(function() {

	$.ajax({
		url: "libs/php/getCountryInfo.php",
		type: 'POST',
		dataType: 'json',
		data: {
			city: $('#whatCity').val(),
		},

		success: function(result) {

			console.log(result);

			if (result.data.status.name == "ok") {

				$('#txtCity').html(result['data']['result']['name']);
		 		$('#txtDescription').html(result['data']['result']['weather'][0]['description']);
		 		$('#txtTemp').html(result['data']['result']['main']['temp']);
				$('#txtCountry').html(result['data']['result']['sys']['country']);
				$('#txtLat').html(result['data']['result']['coord']['lat']);
				$('#txtLon').html(result['data']['result']['coord']['lon']);
		 	}
		}
	}); 

$('#btnRun2').click(function() {
	$lat = $('#txtLat').text();
	$lon = $('#txtLon').text();
			
		$.ajax({
			url: "libs/php/geolocate.php",
			type: 'POST',
			dataType: 'json',
			data: {
				lat: $lat,
				lon: $lon,
			},
			
			success: function(result) {
		
				//console.log(result);
					
				$('#txtSide').html(result['results'][0]['roadinfo']['sideOfRoad']);
				$('#txtSpeed').html(result['results'][0]['roadinfo']['speed']);
				$('#txtCurrency').html(result['results'][0]['currency']['name']);
				$('#txtSymbol').html(result['results'][0]['currency']['symbol']);
			}
		}); 
	})
});
