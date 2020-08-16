
<div class="container my-5">
	<div class="row pt-5 pb-5" style="font-size: 10px;">
    <?php if ($this->session->userdata('login_id')):?>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-users fa-2x"></i><br>Muzakki
      </a>
    </div>
    <?php elseif (!$this->session->userdata('login_id')): ?>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('amil/form')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-coins fa-2x"></i><br>Bayar Zakat Mal
      </a>
    </div>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('amil/form/0/infaq')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-coins fa-2x"></i><br>Bayar Infaq
      </a>
    </div>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('amil/form/0/sodaqoh')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-coins fa-2x"></i><br>Bayar Shodaqoh
      </a>
    </div>
    <?php endif ?>
    <?php if ($this->session->userdata('login_id') >0): ?>
    <?php if ($this->session->userdata('level')==0):?>
		<div class="col-6 col-md-4 mb-4">
			<a href="<?=site_url('User/list')?>" class="btn btn-success btn-block py-3 card-menu">
				<i class="fa fa-user fa-2x"></i><br>User
			</a>
		</div>
    <?php endif ?>
    <?php endif ?>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('menu/kalkulator')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-calculator fa-2x"></i><br>Kalkulator Zakat
      </a>
    </div>
    <div class="col-6 col-md-4 mb-4">
      <a href="<?=site_url('menu/tentang_zakat')?>" class="btn btn-success btn-block py-3 card-menu">
        <i class="fa fa-info-circle fa-2x"></i><br>Tentang Zakat
      </a>
    </div>

	</div>
	<!-- <input type="text" id="location" name="location"> -->
	<div style="height: 300px;width: 100%; display: none;"  id="map"></div>
</div>

   