$(document).ready(function() {
	$(".feature-buttons.img-button").hover(function() {
		$(this).toggleClass(".opacityDecrease")
	});
	
	$("#searchCityBtn").click(function() {
		if($("#searchCityInput").val().length > 0) {
			var city = $("#searchCityInput").val();
			$.get("getTime.php", {
				city: city
			}).done(function(data) {
				$("#time").html(data);
			});
			
			$.get("getWeather.php", {
				weather: weather
			}).done(function(data) {
				$().html(data);
			});
		}
		
	});
	
});