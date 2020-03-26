<div class="flash-data" data-flashdata="<?=$this->session->flashdata('paket')?>"></div>
<div class="flash-error" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Filter Data</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <select class="form-control" id="outlet">
                  <option value="">Pilih Outlet</option>
                  <?php foreach ($outlet as $x): ?>
                    <option value="<?=$x->nama?>"><?=$x->nama?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="nama">
                  <option value="">Nama Paket</option>
                  <option value="kiloan">kiloan</option>
                  <option value="satuan">satuan</option>
                </select>
              </div>
              <div class="form-group">
                <select id="jenis" class="form-control select2bs4">
                  <option value="">Pilih Jenis</option>
                  <?php foreach ($jenis as $x): ?>
                    <option value="<?=$x->nama_jenis?>"><?=$x->nama_jenis?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a onclick="reload()" href="javascript:void(0)" class="btn btn-tool"><i class="fas fa-refresh"></i></a>
                <a href="<?=base_url('master/paket/tambah')?>" class="btn btn-tool"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Outlet</th>
                  <th>Jenis Paket</th>
                  <th>Nama Paket</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<script>
  var table;
  $(document).ready(function(){
    const flashdata = $(".flash-data").data('flashdata');
    if (flashdata) {
      Toast.fire({
        type: 'success',
        title: 'Data ' + flashdata
      })
    }
    const error = $(".flash-error").data('flashdata');
    if (error) {
      Toast.fire({
        type: 'error',
        title: 'Data ' + error
      })
    }
    table = $(".table").DataTable({
      "processing"  : true,
      "serverSide"  : true,
      "searching"   :false,
      "order"       : [],
      "ajax" : {
        "url" :  "<?php echo base_url('master/paket/ajax_list') ?>",
        "type":   "POST",
        "data": function(data){
          data.outlet = $('#outlet').val();
          data.jenis = $('#jenis').val();
          data.nama = $('#nama').val();
        }
      },
      "columDefs": [
      {
        "targets"  : [0],
        "orderable"   : false,
      },
      ],
    });
    $("#outlet").on('change',function(){
      table.ajax.reload();
    });
    $("#nama").on('change',function(){
      table.ajax.reload();
    });
    $("#jenis").on('change',function(){
      table.ajax.reload();
    })
  })
  function reload() {
    table.ajax.reload();
  }
  $(function(){
    $('.select2bs4').select2({
     
    })
  })
</script>