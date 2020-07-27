<div class="container">
	<div class="row pt-5 pb-5">
		<div class="col-4 mb-3">
			<a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
				<i class="fa fa-home fa-3x"></i><br>Amil
			</a>
		</div>
		<div class="col-4 mb-3">
			<form method="post" action="<?=site_url('ambil/index')?>">
				<input type="hidden" name="lat" id="lat">
				<input type="hidden" name="lng" id="lng">
				<button type="submit" class="btn btn-success btn-block"><i class="fa fa-home fa-3x"></i><br>Amil terdekat</button>				
			</form>
		</div>
		<div class="col-4 mb-3">
			<a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
				<i class="fa fa-home fa-3x"></i><br>Amil
			</a>
		</div>
		<div class="col-4 mb-3">
			<a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
				<i class="fa fa-home fa-3x"></i><br>Amil
			</a>
		</div>

	</div>
	<!-- <input type="text" id="location" name="location"> -->
	<div style="height: 300px;width: 100%; display: none;"  id="map"></div>
</div>

    <script>
      var map, infoWindow;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 20
  });
  infoWindow = new google.maps.InfoWindow();

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        // alert(pos);
        console.log(pos)
        $('#lat').val(pos.lat)
        $('#lng').val(pos.lng)

        infoWindow.setPosition(pos);
        infoWindow.setContent("Location found.");
        infoWindow.open(map);
        map.setCenter(pos);
      },
      function() {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&callback=initMap">
    </script>