 <div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row pt-5">
        <?php if ($this->session->userdata('level')==3): ?>
        <div class="col-lg-12 col-12">
          <a href="<?=site_url('amil/form')?>" class="btn btn-primary mb-2 float-right"><i class="fa fa-plus"></i> Tambah Amill</a>
        </div>
      <?php endif; ?>
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <?php foreach ($datalist as $key => $value): ?>
          <a href="<?=site_url('amil/detail/'.$value->amil_id)?>">
            <div class="card pl-2 bg-white">
                <!-- <div class="col-3"><i class="fa fa-home"></i></div> -->
                <h4><?=$value->nama_amil?></h4>
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
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>