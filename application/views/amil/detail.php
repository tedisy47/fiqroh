 <div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row pt-5">
        <div class="col-12">
          <!-- small box -->
          <table class="table table-striped">
            <tr>
              <td>Nama</td>
              <td><b><?=$data->nama?></b></td>
            </tr>
            <tr>
              <td>Nama Barang</td>
              <td><b><?=$data->nama_barang?></b></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td><b><?=$data->alamat?></b></td>
            </tr>
            <tr>
              <td colspan="2">
                <div id="map" style="width: 100%; height: 300px"></div>
               </iframe>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="left">
                <?php if ($this->session->userdata('level')==3): ?>s
                <a class="btn btn-danger" href="<?=site_url('amil/delete/'.$data->id)?>">Hapus</a>
                <a class="btn btn-warning" href="<?=site_url('amil/form/'.$data->id)?>">Edit</a>
                <?php endif ?>
              </td>
            </tr>
          </table>
        </div>          
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: <?=$data->langtitude?>, lng: <?=$data->longtitiud?>};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&callback=initMap">
    </script>