<form method="post" action="<?=base_url('setting/tambahan/edit_diskon/'.base64_encode($diskon['id_diskon']))?>">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label>Persentase</label>
				<input type="text" name="diskon" class="form-control" value="<?=$diskon['diskon']?>">
			</div>
		</div>
		<div class="col-6">
			<div style="margin-top: 35px" class="form-group">
				<b style="font-size: 20px">%</b>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" name="tgl_mulai" class="form-control" value="<?=$diskon['tgl_mulai']?>">
				<?=form_error('tgl_mulai','<small class="text-danger">','</small>')?>
			</div>
		</div>
		<div class="col-6">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" name="tgl_selesai" class="form-control" value="<?=$diskon['tgl_selesai']?>">
				<?=form_error('tgl_selesai','<small class="text-danger">','</small>')?>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-9"></div>
		<div class="col-3">
			<button type="submit" class="btn btn-primary btn-block">Simpan</button>
		</div>
	</div>
</form>
