<div class="container">
	<div class="row pt-5 pb-5">
    <?php if ($this->session->userdata('level')==1 or $this->session->userdata('level')==3):?>
    <div class="col-4 mb-3">
      <a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
        <i class="fa fa-users fa-3x"></i><br>Muzzaki
      </a>
    </div>
    <?php elseif ($this->session->userdata('level')==0): ?>
    <div class="col-4 mb-3">
      <a href="<?=site_url('amil/form')?>" class="btn btn-success btn-block">
        <i class="fa fa-home fa-2x"></i><br>Bayar Zakat
      </a>
    </div>
    <?php endif ?>

    <?php if ($this->session->userdata('level')==3):?>
		<div class="col-4 mb-3">
			<a href="<?=site_url('User/list')?>" class="btn btn-warning btn-block">
				<i class="fa fa-user fa-3x"></i><br>User
			</a>
		</div>
    <?php endif ?>
    <?php if ($this->session->userdata('level')==0):?>
    <div class="col-4 mb-3">
      <a href="<?=site_url('kalkulator')?>" class="btn btn-success btn-block">
        <i class="fa fa-home fa-2x"></i><br>Kalkulator Zakat
      </a>
    </div>
    <div class="col-4 mb-3">
      <a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
        <i class="fa fa-home fa-2x"></i><br>Tentang Zakat
      </a>
    </div>
    <div class="col-4 mb-3">
      <a href="<?=site_url('amil/list')?>" class="btn btn-success btn-block">
        <i class="fa fa-home fa-3x"></i><br>Amil
      </a>
    </div>
    <?php endif ?>

	</div>
	<!-- <input type="text" id="location" name="location"> -->
	<div style="height: 300px;width: 100%; display: none;"  id="map"></div>
</div>

   