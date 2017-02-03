<div class="school-zone">
	<div class="schoolzone_header">
		<h4>School Zone - Find the perfect school for your Kids!</h4>
	</div>
	
	<div class="quick-search">
	
		<div class="quick-search-head">
			Quick search<br>
		</div>
		<div class="location-search">
		
			<script src="http://maps.google.com/maps/api/js?key=AIzaSyD9zYh7vIoqYFg3HvxOKHCvKIMZQZV_MKA&libraries=places&language=en"></script>
			<script type="text/javascript">
				google.maps.event.addDomListener(window, 'load', function () {
					var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
					google.maps.event.addListener(places, 'place_changed', function () {
						var place = places.getPlace();
						var address = place.formatted_address;
						var latitude = place.geometry.location.lat();
						var longitude = place.geometry.location.lng();
						var mesg = "Address: " + address;
						mesg += "\nLatitude: " + latitude;
						mesg += "\nLongitude: " + longitude;
						alert(mesg);
					});
				});
			</script>
			
			<input type="text" id="txtPlaces"  placeholder="Enter a location" />

		</div>
	
		<div class="filters">
		
			<div class = "syllabus-search">
			
			
			</div>
		</div>
	</div>
</div>
		

