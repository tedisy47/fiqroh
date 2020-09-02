<div class="container my-5">
  <div class="row align-middle pt-5">
      <div class="col-12">
        <button onclick="window.history.back()" class="btn btn-warning mb-3 mt-1 float-left"><i class="fa fa-arrow-left"></i> Back</button>
        <nav aria-label="breadcrumb" class="float-right">
            <ol class="breadcrumb px-0 button_breadcrumb">
                <li class="breadcrumb-item breadcrumb-home"><a href="<?= site_url('/'); ?>"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
      </div>
  </div>
  <div class="row pt-3">
    <div class="col-12">
      <div class="card card-form">
        <div class="card-header">
          <div class="row">
            <div class="col-12 col-md-6 order-2 order-md-1">
              <h5 class="float-md-left my-0 py-0 text-center mt-3 mt-md-2"><?= $title; ?></h5>
            </div>
          </div>
        </div>
          <div class="card-body">
            <div id="map" style="width: 100%; height: 500px;"></div>
          </div>
      </div>
    </div>
  </div>
  
  <!-- /.row -->
</div>






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
      const checkboxArray = <?=$rute?>;
      console.log(checkboxArray);
      for (let i = 0; i < checkboxArray.length; i++) {
        // console.log(checkboxArray)
          waypts.push({
            location: checkboxArray[i].lat+','+checkboxArray[i].long,
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
