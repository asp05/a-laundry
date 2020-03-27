<div class="flash-data" data-flashdata="<?=$this->session->flashdata('tambahan')?>"></div>
<div class="flash-error" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : Pajak</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Persentase Pajak</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach ($pajak as $x): ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$x->persentase?>%</td>
                      <td><a href="#modal-default" data-id="<?=base64_encode($x->id_pajak)?>" class="btn btn-success btn-block" data-toggle="modal"title="edit presentase"><i class="fa fa-pencil"></i> Edit</a></td>  
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : Diskon</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Diskon</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach ($diskon as $x): ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$x->diskon?></td>
                      <td><?=date_indo($x->tgl_mulai)?></td>
                      <td><?=date_indo($x->tgl_selesai)?></td>
                      <td><a href="#modal-diskon" data-id="<?=base64_encode($x->id_diskon)?>" class="btn btn-success btn-block" data-toggle="modal"title="edit presentase"><i class="fa fa-pencil"></i> Edit</a></td>  
                    </tr>
                  <?php endforeach ?>
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
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Pajak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="fetch"></div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-diskon">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Diskon</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="fetch"></div>
          </div>
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
        table = $(".table").DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        });
        $("#modal-default").on('show.bs.modal',function(e){
          var rowid = $(e.relatedTarget).data('id');
          $.ajax({
            type:"post",
            url:"<?=base_url('setting/tambahan/edit/')?>",
            data :{
              id : rowid,
            },
            success:function(data){
              $('.fetch').html(data);
              console.log(data);
            }
          })
        })
        $("#modal-diskon").on('show.bs.modal',function(e){
          var rowid = $(e.relatedTarget).data('id');
          $.ajax({
            type:"post",
            url:"<?=base_url('setting/tambahan/editdiskon/')?>",
            data :{
              id : rowid,
            },
            success:function(data){
              $('.fetch').html(data);
              console.log(data);
            }
          })
        })
    })
    </script> 