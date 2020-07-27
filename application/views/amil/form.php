
    <div class="container">
      <div class="row pt-5">
        <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Form Muzakki</h3>
          </div>
          <form method="post" action="<?=$url?>">
            <input type="hidden" name="id" value= "<?=(!empty($data->id) ? $data->amil_id: '')?>">
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value = "<?=(!empty($data->nama) ? $data->nama: '')?>">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" value = "<?=(!empty($data->nama_barang) ? $data->nama_barang: '')?>">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat"><?=(!empty($data->alamat) ? $data->alamat: '')?></textarea>
            </div>
            <div class="form-group">
              <label>Titik Lokasi</label>
              <div id="map" style="height: 300px;width: 100%"></div>
              <input type="hidden" id="input_lat" name="latlong">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      </div>
      
      <!-- /.row -->
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
          $('#input_lat').val(mapsMouseEvent.latLng.toString())
          // Close the current InfoWindow.
          infoWindow.close();

          // clearMarkers();
          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
          infoWindow.setContent(mapsMouseEvent.latLng.toString());
          // infowindow.setMap(map)
          var marker = new google.maps.Marker({
            position: mapsMouseEvent.latLng,
            map: map,
            title: mapsMouseEvent.latLng.toString()
          });
          markers.push(marker);
          marker.addListener('click', function() {
              infowindow.open(map, marker);

            });
        });
      }
      // initMap();
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&libraries=places&callback=initMap"
      type="text/javascript"></script>