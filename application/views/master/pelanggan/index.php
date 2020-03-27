<div class="usr" data-flashdata="<?=$this->session->flashdata('pelanggan')?>"></div>
<div class="eror" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul;?></h3>
              <div class="card-tools">
                <a onclick="reload()" href="javascript:void(0)" class="btn btn-tool"><i class="fas fa-refresh"></i></a>
                <a href="<?=base_url('master/pelanggan/tambah')?>" class="btn btn-tool"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Telepon</th>
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
          "searching"   :true,
          "order"       : [],
          "ajax" : {
            "url" :  "<?php echo base_url('master/pelanggan/ajax_list') ?>",
            "type":   "POST",
          },
          "columDefs": [
          {
            "targets"  : [0],
            "orderable"   : false,
          },
          ],
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
          title: 'Data ' + usr
        })
      }else if(eror){
        Toast.fire({
          type: 'error',
          title: 'Data ' + eror
        })
      }
      
    </script>
