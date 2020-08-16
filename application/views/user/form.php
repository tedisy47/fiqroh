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
            <div class="col-12">
                <h5 class="my-0 py-0 text-center"><?= $title; ?></h5>
            </div>
          </div>
        </div>
        <form method="post" action="<?= $url; ?>">
          <input type="hidden" name="user_id" value= "<?=(!empty($data->user_id) ? $data->user_id : '')?>">
          <div class="card-body">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" value = "<?=(!empty($data->email) ? $data->email : '')?>">
            </div>
            <div class="form-group">
              <label>Password</label>
              <?=(!empty($data->password) ? '<p class="my-0" style="font-size: 11px;">(Kosongkan jika tidak ingin diubah!)</p>' : '')?>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="hak_akses">
                    <option value="0" <?=(!empty($data->hak_akses) && $data->hak_akses == 0 ? 'selected' : '')?>>Admin</option>
                    <option value="1" <?=(!empty($data->hak_akses) && $data->hak_akses == 1 ? 'selected' : '')?>>Amil</option>
                </select>
            </div>
          </div>
          <div class="card-footer pb-5">
            <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.row -->
</div>