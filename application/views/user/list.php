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
            <div class="col-12 col-md-6 order-2 order-md-1">
              <h5 class="float-md-left my-0 py-0 text-center mt-3 mt-md-2"><?= $title; ?></h5>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
              <a href="<?=site_url('user/form')?>" class="btn btn-success btn-block float-md-right align-middle">
                <i class="fas fa-plus"></i> Tambah User
              </a>
            </div>
          </div>
        </div>
        <div class="card-body pb-0">
            <div class="row mb-4">
              <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 10px !important;">
                        <?php foreach ($datalist as $key => $value): ?>
                            <tr>
                                <?php
                                    if($value->hak_akses == 0) {
                                        $level = 'Admin';
                                    } elseif($value->hak_akses == 1) {
                                        $level = 'Amil';
                                    }
                                ?>
                                <td><?= $value->email ?></td>
                                <td><?= $level ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="<?=site_url('user/form/'.$value->user_id)?>"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-warning btn-sm" href="#" onclick="sweet<?= $value->user_id; ?>()"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
              </div>
            </div>
          <div class="row">
            <div class="col-12">
              <?=$pagination?>
            </div>
          </div>
        </div>
      </div>
    </div>          
  </div>
</div>
<?php foreach ($datalist as $key => $value) { ?>
  <script type="text/javascript">
    function sweet<?= $value->user_id; ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?php echo site_url('user/delete/'.$value->user_id); ?>"), {
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
<?php } ?>