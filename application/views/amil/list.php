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
      <div class="card card-list">
        <div class="card-header">
          <div class="row">
            <div class="col-12">
              <h5 class="my-0 py-0 text-center"><?= $title; ?></h5>
            </div>
          </div>
        </div>
        <div class="card-body pb-0">
          <?php foreach ($datalist as $key => $value): ?>
            <div class="row mb-4">
              <div class="col-12">
                <a href="<?=site_url('amil/detail/'.$value->id)?>" class="item">
                  <div class="card card-list-item pl-3 py-3 bg-white">
                    <h6><?=$value->nama?></h6>
                    <p class="pb-0 mb-0"><?= substr($value->alamat, 0,50)?></p>
                  </div>
                </a>
              </div>
            </div>
          <?php endforeach;?>
          <div class="row">
            <div class="col-12">
              <?=$pagination?>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-12">
              <form method="post" action="<?=site_url('ambil/index')?>">
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-truck"></i> Ambil Zakat</button>        
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>          
  </div>
</div>
<div id="map" style="display:none;">
 <script>
      var map, infoWindow;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 20
  });
  infoWindow = new google.maps.InfoWindow();

  // if(navigator.geolocation==undefined)
  //   swal("Titik Tidak Ditemukan")

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        if(pos.lat==undefined)
          pos.lat??swal("Titik Tidak Ditemukan")
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
  browserHasGeolocation
    ? swal("Error: The Geolocation service failed.")
    : swal("Error: Your browser doesn't support geolocation.")
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
