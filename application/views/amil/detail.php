 <div class="content-wrapper">
  <div class="content">
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
              <table class="table table-striped">
                <tr>
                  <th>Nama</th>
                  <td><?=$data->nama?></td>
                </tr>
                <tr>
                  <th>Nama Barang</th>
                  <td><?=$data->nama_barang?></td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td><?=$data->alamat?></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div id="map" style="width: 100%; height: 300px"></div>
                  </td>
                </tr>
                <?php if ($this->session->userdata('level')==3): ?>
                  <tr>
                    <td colspan="2" align="left">
                      <div class="row">
                        <div class="col-6">
                          <a class="btn btn-success btn-block" href="<?=site_url('amil/form/'.$data->id)?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                        </div>
                        <div class="col-6">
                          <a class="btn btn-warning btn-block" href="#" onclick="sweet<?= $data->id; ?>()"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endif ?>
              </table>
            </div>
          </div>
        </div>          
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function sweet<?= $data->id; ?>() {
    swal({
      title: "Anda Yakin Ingin Menghapus Data Ini?",
      text: "Data yang sudah dihapus tidak dapat dikembalikan!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if(willDelete) {
        swal(window.location.assign("<?php echo site_url('amil/delete/'.$data->id); ?>"), {
          icon: "success",
        });
      } else {
        swal("Batal Hapus Data!", {
            icon: "error",
        })
      }
    });;
  }
</script>
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