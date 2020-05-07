<!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Kode Invoice</p>
      	<?php if ($this->session->flashdata('eror')): ?>
      		<div class="alert alert-danger alert-dismissible">
	          <?=$this->session->flashdata('eror'); ?>
	    	</div>
      	<?php endif ?>
      <form action="<?=base_url('member/cekHistori')?>" method="post">
        <div class="form-group">
	          <input type="text" class="form-control" name="invoice" placeholder="masukan invoice..">
	        <?=form_error('invoice','<small class="text-danger">','</small>')?>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <input type="submit" name="cek" value="Cek Histori" class="btn btn-primary btn-block" id="m">
          </div>
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
  <script>
$(function() {
    notifikasi();
});

var notifikasi = (e) => {
  var alertNya = $('.alert');
    setTimeout(function() {
        alertNya.slideUp('slow');
    }, 2000);
}
</script>
