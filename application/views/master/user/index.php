<div class="usr" data-flashdata="<?=$this->session->flashdata('user')?>"></div>
<div class="eror" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
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
                <select name="outlet" class="form-control" id="outlet">
                  <option value="">Pilih Outlet</option>
                  <?php foreach ($outlet as $x): ?>
                    <option value="<?=$x->id_outlet?>"><?=$x->nama?></option>
                  <?php endforeach ?>
                </select> 
              </div>
              <div class="form-group">
                <select id="role" class="form-control">
                  <option value="">Pilih Posisi</option>
                  <option value="admin">admin</option>
                  <option value="kasir">kasir</option>
                  <option value="owner">owner</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="nama"  placeholder="nama user.." class="form-control" id="nama">
              </div>
            </div>
          </div>  
        </div>
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul;?></h3>
              <div class="card-tools">
                <a onclick="reload()" href="javascript:void(0)" class="btn btn-tool"><i class="fas fa-refresh"></i></a>
                <a href="<?=base_url('master/user/tambah')?>" class="btn btn-tool"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar</th>
                  <th>Nama User</th>
                  <th>Outlet</th>
                  <th>Posisi</th>
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
        table = $('.table').DataTable({
          "processing"  : true,
          "serverSide"  : true,
          "searching"   :false,
          "order"       : [],
          "ajax" : {
            "url" :  "<?php echo base_url('master/user/ajax_list') ?>",
            "type":   "POST",
            "data": function(data){
              data.outlet = $('#outlet').val();
              data.nama = $('#nama').val();
              data.role= $('#role').val();
            }
          },
          "columDefs": [
          {
            "targets"  : [0],
            "orderable"   : false,
          },
          ],
        });
        $('[name="nama"]').on('keyup',function() {
          table.ajax.reload();
        });
        $('[name="outlet"]').on('change',function() {
          table.ajax.reload();
        });
        $("#role").on('change',function() {
          table.ajax.reload();
        });
      })
      function reload() {
        table.ajax.reload();
      }
      const usr = $('.usr').data('flashdata');
      const eror = $('.eror').data('flashdata');
      if (usr) {
        Toast.fire({
          type : 'success',
          title: 'Data' + usr
        })
      }else if(eror){
        Toast.fire({
          type: 'error',
          title: 'Data' + eror
        })
      }
      
    </script>
