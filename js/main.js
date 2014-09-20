$(function() {
	$(".feature-buttons").hover(function() {
		$(this).toggleClass(".opacityDecrease")
	});
	var companyList = $("#searchCityInput").autocomplete({ 
      change: function() {
          alert('changed');
      }
   });
   companyList.autocomplete('option','change').call(companyList);
});