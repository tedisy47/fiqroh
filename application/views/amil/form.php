 <div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row pt-5">
        <div class="card col-12">
          <div class="card-header">
            <h3>Form Amil</h3>
          </div>
          <form method="post" action="<?=$url?>">
          <div class="card-body">
            <div class="form-group">
              <label>Nama Lembaga Amil</label>
              <input type="text" name="nama_amil" class="form-control" value = "<?=(!empty($data->nama_amil) ? $data->nama_ami: '')?>">
            </div>
            <div class="form-group">
              <label>Penanggung jawab</label>
              <input type="text" name="penanggung_jawab" class="form-control" value = "<?=(!empty($data->penanggung_jawab) ? $data->penanggung_jawab: '')?>">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat"><?=(!empty($data->alamat) ? $data->alamat: '')?></textarea>
            </div>
            <div class="form-group">
              <label>Titik Lokasi</label>
              <div id="map" style="height: 300px;width: 100%"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<!--<script src="--><!--assets/js/main.js"></script>-->
  
  <script>
      function initMap() {
        var myLatlng = {lat: -6.247272395078129, lng: 106.8564086594595};

        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 8, center: myLatlng});

        // Create the initial InfoWindow.
        var infoWindow = new google.maps.InfoWindow(
            {content: 'Click the map to get Lat/Lng!', position: myLatlng});
        infoWindow.open(map);

        // Configure the click listener.
        map.addListener('click', function(mapsMouseEvent) {
          // Close the current InfoWindow.
          infoWindow.close();

          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
          infoWindow.setContent(mapsMouseEvent.latLng.toString());
          var marker = new google.maps.Marker({
            position: mapsMouseEvent.latLng,
            map: map,
            title: mapsMouseEvent.latLng
          });
          marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
        });
      }
      // initMap();
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&libraries=places&callback=initMap"
      type="text/javascript"></script>