<!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login</p>
      	<?php if ($this->session->flashdata('eror')): ?>
      		<div class="alert alert-danger alert-dismissible">
	          <?=$this->session->flashdata('eror'); ?>
	    	</div>
      	<?php endif ?>
      <form action="<?=base_url('auth')?>" method="post">
        <div class="form-group">
        	<div class="input-group">
	          <input type="text" class="form-control" name="username" placeholder="username..">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-envelope"></span>
	            </div>
	          </div>
	        </div>
	        <?=form_error('username','<small class="text-danger">','</small>')?>
        </div>
        <div class="form-group">
        	<div class="input-group">
	          <input type="password" class="form-control" name="password" placeholder="password..">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-lock"></span>
	            </div>
	          </div>
	        </div>
	        <?=form_error('password','<small class="text-danger">','</small>')?>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <input type="submit" name="masuk" value="Masuk" class="btn btn-primary btn-block" id="m">
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
