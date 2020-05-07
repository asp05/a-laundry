<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>A-Laundry | <?=$judul?> </title>
  <link rel="icon" href="<?=base_url('assets/a.png')?>">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins')?>/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins')?>/Ionicons/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/daterangepicker/daterangepicker.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/toastr/toastr.min.css">


  <!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url('assets/')?>plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url('assets/')?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets/')?>plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('assets/')?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url('assets/')?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('assets/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
  <script src="<?=base_url('assets/')?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
<script src="<?=base_url('assets/')?>plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.js"></script>
<!-- InputMask -->
<script src="<?=base_url('assets/')?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?=base_url('assets/')?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?=base_url('assets/')?>dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?=base_url('assets/')?>dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown user user-menu">
          <a href="#" class="nav-link" data-toggle="dropdown">
            <img src="<?=base_url('assets/dist/img/'.$user['gambar'])?>" class="user-image" alt="User Image">
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url('assets/dist/img/'.$user['gambar'])?>" class="img-circle" alt="User Image">

                <p>
                  <?=$user['nama_user']?> - <?=$user['role']?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="<?=base_url('auth/logout')?>" class="btn btn-primary btn-block keluar">Keluar</a>
                </div>
              </li>
            </ul>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->
<?=$sidebar?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$judul;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('master/home')?>">Home</a></li>
              <li class="breadcrumb-item active"><?=$judul;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?=$content;?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.3-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $(".keluar").on('click',function(e) {
    e.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
      title : 'Apakah anda yakin keluar?',
      type  : 'warning',
      showCancelButton : true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Keluar',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
  })
  $(".hapus").on('click',function(e) {
    e.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
      title : 'Apakah anda yakin hapus?',
      type  : 'warning',
      showCancelButton : true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
  })
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

</body>
</html>
