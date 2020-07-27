<!-- <!DOCTYPE html> -->
<html>
<head>
	<title>test</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>a
</head>
<body>
	<div id="map" style="width: 500px; height: 500px;"></div>

	 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&callback=initMap">
    </script>
<script type="text/javascript">
function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: { lat: -6.536344127907798106, lng: 106.70900502671168 }
  });
  directionsRenderer.setMap(map);
  calculateAndDisplayRoute(directionsService, directionsRenderer);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const waypts = [];
  const checkboxArray = ['-6.222726039488582,106.70900502671168','-6.222726039488582,106.70900502671168',];
  	console.log(checkboxArray)
  for (let i = 0; i < checkboxArray.length; i++) {
      waypts.push({
        location: '-6.222726039488582,106.70900502671168',
        stopover: true
      });
  }
  directionsService.route(
    {
      origin: '-6.536344127907798106,106.70900502671168',
      destination: '-6.223113476221565,106.70900502671168',
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING
    },
    (response, status) => {
      if (status === "OK") {
        directionsRenderer.setDirections(response);
        const route = response.routes[0];
        const summaryPanel = document.getElementById("directions-panel");
        summaryPanel.innerHTML = "";

        // For each route, display summary information.
        for (let i = 0; i < route.legs.length; i++) {
          const routeSegment = i + 1;
          summaryPanel.innerHTML +=
            "<b>Route Segment: " + routeSegment + "</b><br>";
          summaryPanel.innerHTML += route.legs[i].start_address + " to ";
          summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
          summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
        }
      } else {
        window.alert("Directions request failed due to " + status);
      }
    }
  );
}
</script>

</body>
</html>

