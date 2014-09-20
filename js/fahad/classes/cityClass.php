<?php

class City {

	public $pattern, $timeVal, $data, $cityRefactored;
	public $latLng, $lat, $lng;

	public function getCityTime($city) {
		
		//Make input readable by Google
		$this->cityRefactored = str_replace(", ", "+", $city);
		$this->cityRefactored = str_replace(" ", "+", $this->cityRefactored);
		
		//Get raw Google search data
		$this->data = file_get_contents("https://www.google.ca/search?q=time+in+" . $this->cityRefactored);
		
		//Define the pattern to find the time of the location
		$this->pattern = "/<div class\=\"_rkc _Peb\">(.*?)<\/div>/";
		
		//Find a match and store it
		preg_match($this->pattern, $this->data, $this->timeVal);
		
		//Strip out random junk and display the time
		$this->timeVal = $this->timeVal[0];
		$this->timeVal = str_replace("<div class=\"_rkc _Peb\">", "", $this->timeVal);
		$this->timeVal = str_replace("</div>", "", $this->timeVal);
		
		//Return the time in the city
		return $this->timeVal;
		
	}
	
	public function getCityLatLng($city) {
		
		//Get raw data from Google
		$this->data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/xml?address={$_GET['city']}");
		
		//Find the latitude and longitude and strip all the junk
		preg_match("/<location>(.*)<\/location>/s", $this->data, $this->latLng);
		$this->latLng = $this->latLng[0];	
		$this->latLng = explode(" ", $this->latLng);
		
		//Strips tags from longitude
		$this->lat = $this->latLng[4];
		$this->lat = explode("<lat>", $this->lat);
		$this->lat = explode("</lat>", $this->lat[1]);
		
		//Define the latitude
		$this->lat = $this->lat[0];
		
		//Strip tags from longitude
		$this->lng = $this->latLng[8];
		$this->lng = explode("<lng>", $this->lng);
		$this->lng = explode("</lng>", $this->lng[1]);
		
		//Define the longitude
		$this->lng = $this->lng[0];
		
		//Return the latitude and longitude values
		return $this->lat . "," . $this->lng;
				
		
	}
	
	public function getCityWeather($city) {
		//Do your code here.
	}
	public function getCityTime2($city) {
		//Do your code here.
	}
	
}