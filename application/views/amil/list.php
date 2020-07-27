 <div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row pt-5">
       <!--  <?php if ($this->session->userdata('level')==3): ?>
        <div class="col-lg-12 col-12">
          <a href="<?=site_url('amil/form')?>" class="btn btn-primary mb-2 float-right"><i class="fa fa-plus"></i> Tambah Amill</a>
        </div>
      <?php endif; ?> -->
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <?php foreach ($datalist as $key => $value): ?>
          <a href="<?=site_url('amil/detail/'.$value->id)?>">
            <div class="card pl-2 mb-2 bg-white">
                <!-- <div class="col-3"><i class="fa fa-home"></i></div> -->
                <h4><?=$value->nama?></h4>
                <p><?= substr($value->alamat, 0,50)?></p>
            </div>
          </a>
          <?php endforeach;?>
        </div>          
        <!-- /.col-md-6 -->
      </div>
      <div class="row pd-5">
        <div class="col-lg-12 col-12">
          <?=$pagination?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <form method="post" action="<?=site_url('ambil/index')?>">
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-home fa-2x"></i><br>Amil terdekat</button>        
          </form>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
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