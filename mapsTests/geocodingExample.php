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

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      #map-canvas {
        height: 400px;
		width: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
function initialize() {
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
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>