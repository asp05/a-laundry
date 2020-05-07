<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>A-Laundry | Histori</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition ">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Histori Transaksi</h1>
            <?php 
            $timestamp = date('Y-m-d H:i:s');
            echo $timestamp;

             ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Histori</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <?php foreach ($histori as $index => $x): ?>
                <?php 
                $waktu = explode(' ', $x->waktu);
                $warna = array('bg-gray','bg-green','bg-blue','bg-yellow','bg-red');
                 ?>
                <div class="time-label">
                  <span class="bg-red"><?=date_indo($waktu[0])?></span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-user <?=$warna[$index]?>"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i><?=$this->andi->waktu_lalu($x->waktu)?></span>
                    <h3 class="timeline-header no-border"><a href="#"><?=$x->status?></a></h3>
                  </div>
                </div>
              <?php endforeach ?>
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.3-pre
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
</div>
<!-- jQuery -->
<script src="<?=base_url('assets')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>
</body>
</html>
