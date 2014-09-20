<?php

	include_once("classes/cityClass.php");

	if(isset($_GET['city'])) {
		
		$city = new City();
		echo $city->getCityLatLng($_GET['city']);
		
	}

?>
