<div class="flash-data" data-flashdata="<?=$this->session->flashdata('jenis')?>"></div>
<div class="flash-error" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a onclick="reload()" href="javascript:void(0)" class="btn btn-tool"><i class="fas fa-refresh"></i></a>
                <a href="<?=base_url('setting/jenis_paket/tambah')?>" class="btn btn-tool"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenis Paket</th>
                  <th>Kiloan</th>
                  <th>Satuan</th>
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
      $(document).ready(function() {
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
        table = $('.table').DataTable({
          "processing"  : true,
          "serverSide"  : true,
          "order"       : [],
          "ajax"        : {
            "url"       : "<?=base_url('setting/jenis_paket/ajax_list')?>",
            "type"      : "POST",
          },
          "columnDefs"  : [{
            "targets"   : [0],
            "orderable" : false,
          }]
        })
      })
      function reload() {
          table.ajax.reload();
      }
    </script> 