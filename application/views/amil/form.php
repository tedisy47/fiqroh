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
              <h5 class="float-md-left my-0 py-0 text-center mt-3 mt-md-2">Form <?= $title; ?></h5>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
              <button type="button" class="btn btn-success btn-block float-md-right align-middle" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-share-square"></i> Bayar Dengan Transfer
              </button>
            </div>
          </div>
        </div>
        <form method="post" action="<?=$url?>">
          <input type="hidden" name="jenis" value="<?=$jenis?>">
          <input type="hidden" name="id" value= "<?=(!empty($data->id) ? $data->id: '')?>">
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input required="true" type="text" name="nama" class="form-control" value = "<?=(!empty($data->nama) ? $data->nama_amil: '')?>">
            </div>
              <label>Email</label>
              <input required="true" type="email" name="email" class="form-control" value = "<?=(!empty($data->email) ? $data->email: '')?>">
            </div>
            <?php if ($jenis=='zakat'): ?>
              <div class="form-group">
                <label>Jenis Zakat</label>
                <select class="form-control">
                  <option>zakat Mall</option>
                  <option>zakat Penghasilan</option>
                  <option>zakat Fitrah</option>
                </select>
              </div>
            <?php endif; ?>
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
            <div class="form-group">
              <img src="https://4.bp.blogspot.com/-1Ofc03hXL88/UfvX86fjETI/AAAAAAAABXM/mIl43c5wgE4/s1600/Image+(12).jpg" style="width: 100%; height:100%">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- /.row -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bayar Dengan Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=site_url('amil/midtrans')?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="jenis" value="<?=$jenis?>">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
          </div>
          <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat"></textarea>
          </div>
          <div class="form-group">
            <img src="https://4.bp.blogspot.com/-1Ofc03hXL88/UfvX86fjETI/AAAAAAAABXM/mIl43c5wgE4/s1600/Image+(12).jpg" style="width: 100%; height:100%">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-handshake"></i> Bayar</button>
        </div>
      </form>
    </div>
  </div>
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