<div class="container">
  <div class="row pt-5 pb-5">
	 <div id="map" style="width: 100%; height: 500px;"></div>
   <div id="directions-panel" style="display: none;"></div>
   <input type="hidden" id="rute" value="<?=$rute?>">
	 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&callback=initMap">
    </script>
  <script type="text/javascript">
    function initMap() {
      const directionsService = new google.maps.DirectionsService();
      const directionsRenderer = new google.maps.DirectionsRenderer();
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: <?=$lat_origin?>, lng: <?=$lng_origin?> }
      });
      directionsRenderer.setMap(map);
      calculateAndDisplayRoute(directionsService, directionsRenderer);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
      const waypts = [];
      const checkboxArray = $('#rute').val();
      checkboxArray = JSON.parse(`<?=$rute?>`);
      console.log(checkboxArray);
      
      	console.log(checkboxArray)
      for (let i = 0; i < checkboxArray.length; i++) {
          waypts.push({
            location: '',
            stopover: true
          });
      }
      directionsService.route(
        {
          origin: '<?=$lat_origin?>,<?=$lng_origin?>',
          destination: '<?=$lat_origin?>,<?=$lng_origin?>',
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
  </div>
</div>
