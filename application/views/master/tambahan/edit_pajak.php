<form method="post" action="<?=base_url('setting/tambahan/edit_pajak/'.base64_encode($pajak['id_pajak']))?>">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label>Persentase</label>
				<input type="number" name="persentase" class="form-control" value="<?=$pajak['persentase']?>">
			</div>
		</div>
		<div class="col-6">
			<div style="margin-top: 35px" class="form-group">
				<b style="font-size: 20px">%</b>
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
