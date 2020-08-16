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
        <div class="card-body">
          <div class="form-group">
            <label>Penghasilan Dalam Setahun</label>
            <input type="number" class="form-control" id="penghasilan">
          </div>
        </div>
        <div class="card-footer">
          <div class="form-group">
            <button id="hasil" type="button" class="btn btn-success btn-block"><i class="fas fa-calculator"></i> Hitung</button>
          </div>
          <div id="hasil1"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#hasil').on('click', function(){
   penghasilan =  $('#penghasilan').val();
   nisab = 85 *1000000;

   if (penghasilan>=nisab) {
      hasil = penghasilan * 0.025;
      hasil = hasil.toString();
      hasil = formatRupiah(hasil, 'Rp ');
   } else {
    hasil = 'Penghasilan Belum Sampe Nisab';
   }

   nisab = nisab.toString();
   
   html =  `<table class="table table-sm table-striped">
              <tr>
                <td>Penghasilan</td>
                <td>`+formatRupiah(penghasilan, 'Rp ')+`</td>
              </tr>
              <tr>
               <td>Nisab</td>
                <td> Emas 85 gram (`+formatRupiah(nisab, 'Rp ')+`)</td>
              </tr>
              <tr>
                <td>Jumlah Yang Harus Dibayar</td>
                <td>`+hasil+`</td>
              </tr>
            </table>`;
    console.log(html);
   $('#hasil1').html(html);

    /* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
		}
  });
</script>