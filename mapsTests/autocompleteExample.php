<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]

    </script>
	
	<?php
	if(isset($_GET['city'])) {
		$data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/xml?address={$_GET['city']}");
		//$phpArray = json_decode($data);
		//print_r($phpArray);
		
		preg_match("/<location>(.*)<\/location>/s", $data, $converted);
		$new = $converted[0];	
		$new = explode(" ", $new);
		$lat = $new[4];
		$lat = explode("<lat>", $lat);
		$lat = explode("</lat>", $lat[1]);
		$lat = $lat[0];
		
		$lng = $new[8];
		$lng = explode("<lng>", $lng);
		$lng = explode("</lng>", $lng[1]);
		$lng = $lng[0];
	}
	?>

  </head>
  <script>
	function initialize2() {
	  var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lng; ?>);
	  var mapOptions = {
		zoom: 10,
		center: myLatlng
	  }
	  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Hello World!'
	  });
	}

	google.maps.event.addDomListener(window, 'load', initialize);

    </script>

  <body onload="initialize2()">

    <div id="locationField">
	  <form action="" method="GET">
		<input id="autocomplete" name="city" placeholder="Enter your address" onFocus="geolocate()" type="text" value="" />
		<input type="submit" id="submit" value="submit" />
	  </form>
    </div>
	
	<div id="map-canvas"></div>
  </body>
  <script>
	/*$(function() {
		$("#submit").click(function() {
			if($("#autocomplete").val().length > 0) {
				$.get("geocodingExample.php", {
					city: $("#autocomplete").val()
				}).done(function(date) {
					$("#map-canvas").html(data);
				});
			}
		});
	});*/
  </script>
</html>