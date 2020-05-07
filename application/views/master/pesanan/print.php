<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>A-Laundry | Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> A-Laundry.
          <?php if ($identitas['status_bayar'] == 'dibayar'): ?>
            <strong style="margin-left: 500px">Lunas</strong>
          <?php endif ?>
          <small class="float-right"><?=date_indo(date('Y-m-d'))?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong><?=$identitas['nama_user']?></strong><br>
          <?=$identitas['alamat']?><br>
          Telepon : <?=$identitas['tlp']?><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Pemesan
        <address>
          <strong><?=$identitas['nama_member']?></strong><br>
          <?=$identitas['alamat_member']?><br>
          <?=$identitas['tlp_member']?><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice :  <?=$identitas['kode_invoice']?></b><br>
        <br>
        <b>Tanggal Mulai:</b> <?=$identitas['tgl_mulai']?><br>
        <b>Tanggal selesai:</b> <?=$identitas['batas_waktu']?><br>
        <?php if ($identitas['status_bayar'] == 'belum bayar'): ?>
        	<b>Tanggal Bayar:</b> -<br>
        <?php else: ?>
        	<b>Tanggal Bayar:</b> <?=$identitas['tgl_bayar']?><br>
        <?php endif ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Paket</th>
            <th>Nama Paket</th>
            <th>Harga Satuan</th>
            <th>Keterangan</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <?php $total=0;foreach ($struk as $x): ?>
          	<tr>
          		<td><?=$x->qty?></td>	
          		<td><?=$x->nama_jenis?></td>	
              <td><?=$x->nama_paket?></td>  
          		<td>Rp.<?=number_format($x->satuan,2)?></td>	
          		<td><?=$x->keterangan?></td>	
          		<td>Rp.<?=number_format($x->qty * $x->satuan,2)?></td>	
          	</tr>
          <?php $total+=$x->qty*$x->satuan;endforeach ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          untuk mengecek histori pemesanan anda silahkan kunjungi link berikut : <br>
          <a style="color: black" title="">http://localhost/A-laundry/member/cekHistori</a> <br>
          dan masukan kode invoice anda 
        </p>
      	<img src="<?=base_url('assets/logo.png')?>" style="margin-top: 50px" >
      </div>
      <!-- /.col -->
      <div class="col-6">
      	<?php 
      		$diskon = $total*$identitas['diskon']/100;
      		$pajak = $total*$identitas['pajak']/100;
      	 ?>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>Rp.<?=number_format($total,2)?></td>
            </tr>
            <tr>
              <th>Tambahan</th>
              <td>-</td>
            </tr>
            <tr>
              <th>Diskon:</th>
              <td><?=$identitas['diskon']?></td>
            </tr>
            <tr>
              <th>Pajak:</th>
              <td><?=$identitas['pajak']?></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>Rp.<?=number_format($total-$diskon+$pajak,2)?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  	window.print()
</script>
</body>
</html>
