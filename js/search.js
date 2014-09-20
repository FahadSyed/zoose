function initialize() {
  //Define input field where search is done
  var input = document.getElementById('searchCityInput');
  
  //Limit options to just cities with no restrictions on countries
  var options = {
	types: ['(cities)']
  };
  
  //Enable it for our form
  var autocomplete = new google.maps.places.Autocomplete(input, options);
}
google.maps.event.addDomListener(window, 'load', initialize);