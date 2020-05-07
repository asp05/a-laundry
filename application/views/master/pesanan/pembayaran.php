<style type="text/css">
  .garis{
    width: 100%;
    height: 0.5px;
    background: grey;
    margin-bottom: 19px;
  }
</style>
<div class="container-fluid ">
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				Nama : <?=ucwords($identitas['nama_member'])?>
			</div>
			<div class="form-group" style="margin-top: -15px">
				<?php $tgl = explode(' ', $identitas['tgl_mulai']) ?>
				Tanggal Pesan : <?=date_indo($tgl[0])?>
			</div>
		</div>
		<div class="col-6">
			<div class="form-group">
				Kode Invoice : <?=$identitas['kode_invoice']?>
			</div>	
		</div>
	</div>
	<div class="row table-responsive">
		<div class="col-12">
			<table class="table">
	          <thead>
	          <tr>
	            <th>Qty</th>
	            <th>Paket</th>
	            <th>Nama Paket</th>
	            <th>Harga Satuan</th>
	            <th>Keterangan</th>
	            <th>Total</th>
	          </tr>
	          </thead>
	          <tbody>
	          <?php $total=0;foreach ($struk as $x): ?>
	          	<tr>
	          		<td><?=$x->qty?></td>	
	          		<td><?=$x->nama_jenis?></td>	
	          		<td><?=$x->nama_paket?></td>	
	          		<td><?=$x->satuan?></td>	
	          		<td><?=$x->keterangan?></td>	
	          		<td>Rp.<?=number_format($x->qty * $x->satuan,2)?></td>	
	          	</tr>
	          <?php $total+=$x->qty*$x->satuan;endforeach ?>
	          </tbody>
	        </table>
	        <?php 
	      		$diskon = $total*$identitas['diskon']/100;
	      		$pajak = $total*$identitas['pajak']/100;
	      	 ?>
		</div>
	</div>
	<div class="row">
		<div class="col-6"></div>
		<div class="col-3">
			<div class="form-group" style="margin-top: -15px">
				Subtotal : 
			</div>
			<div class="form-group" style="margin-top: -15px">
				Bayar Awal : 
			</div>
			<div class="form-group" style="margin-top: -15px">
				Diskon : 
			</div>
			<div class="form-group" style="margin-top: -15px">
				Pajak : 
			</div>
		</div>
		<div class="col-3">
			<div class="form-group" style="margin-top: -15px">
				Rp.<?=number_format($total,2)?> 
			</div>
			<div class="form-group" style="margin-top: -15px">
				Rp.<?=number_format($identitas['bayar_awal'],2)?> 
			</div>			
			<div class="form-group" style="margin-top: -15px">
				Rp.<?=number_format($diskon,2)?> 
			</div>
			<div class="form-group" style="margin-top: -15px">
				Rp.<?=number_format($pajak,2)?> 
			</div>
			<div class="garis"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-6"></div>
		<div class="col-3">
			<div class="form-group" style="margin-top: -15px">
				<strong>Total</strong>  
			</div>
		</div>
		<div class="col-3">
			<div class="form-group" style="margin-top: -15px">
				<?php $Total = $total-$identitas['bayar_awal']-$diskon+$pajak  ?>
				<strong>Rp.<?=number_format($Total,2)?></strong>  
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6"></div>
		<div class="col-3">
			Bayar
		</div>
		<div class="col-3">
			<input type="number" name="bayar" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-6"></div>
		<div class="col-3">
			<div id="kembali"></div>
		</div>
		<div class="col-3">
			<div id="kembalian"></div>
		</div>
	</div>
	<div class="row mt-3 mb-3">
		<div class="col-6"></div>
		<div class="col-3"></div>
		<div class="col-3">
			<form method="post" action="<?=base_url('master/transaksi/updateStatusBayar/'.$identitas['id_transaksi'])?>">
				<input type="submit" name="pembayaran" id="b" disabled="disabled" value="Bayar" class="btn btn-primary btn-block">
			</form>
		</div>
	</div>	
</div>
<script>
	$('[name="bayar"]').on('change keyup',function() {
		var bayar = $('[name="bayar"]').val();
		var kembali,total,button;
		total = '<?=$Total?>'
		kembali = bayar-total
		button = document.getElementById('b')
		if (kembali >= 0) {
			$('#kembali').text('kembalian anda')
			$('#kembalian').text(convertToRupiah(kembali))
			button.disabled = false
		}else{
			$('#kembali').text('kekurangan anda')
			$('#kembalian').text(convertToRupiah(kembali))
			button.disabled = true
		}
	})
	function convertToRupiah(angka) {
	 	var rupiah = '';
	    var angkarev = angka.toString().split('').reverse().join('');
	    for (var i = 0; i < angkarev.length; i++)
	        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    	return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
  	}
</script>