<div class="flash-data" data-flashdata="<?=$this->session->flashdata('berhasil')?>"></div>
<div class="flash-error" data-flashdata="<?=$this->session->flashdata('gagal')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a onclick="reload()" href="javascript:void(0)" class="btn btn-tool"><i class="fas fa-refresh"></i></a>
                <a href="<?=base_url('master/outlet/tambah')?>" class="btn btn-tool"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Invoice</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Pesan</th>
                  <th>Pembayaran Awal</th>
                  <th>Status Pembayaran</th>
                  <th>Status</th>
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
    <!-- /.content -->
    <div class="modal" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Pembayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="tampil" ></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
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
            "url"       : "<?=base_url('master/transaksi/ajax_list')?>",
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
      function pembayaran(value) {
        $("#modal-default").modal("show");
        $.ajax({
          url : '<?=base_url('master/transaksi/ambilDetail')?>',
          data : {
            id : value
          },
          type:"post",
          success : function(data) {
            $("#tampil").html(data)
          }
        })
      }
    </script> 