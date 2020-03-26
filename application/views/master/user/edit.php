<div class="flash-error" data-flashdata="<?=$this->session->flashdata('eror')?>"></div>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('master/user')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" action="<?=base_url('master/user/edit/'.base64_encode($user['id_user'])) ?>">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama User</label>
                        <input type="text" name="nama_user" placeholder="nama user.." class="form-control" value="<?=$user['nama_user']?>">
                        <?=form_error('nama_user','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Username</label>
                        <input type="text" name="username" placeholder="username.." class="form-control" value="<?=$user['username']?>">
                        <?=form_error('username','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Outlet</label>
                      <select name="outlet" class="form-control">
                        <option value="">Pilih Outlet</option>
                        <?php foreach ($outlet as $x): ?>
                          <option value="<?=$x->id_outlet?>" <?=($x->id_outlet == $user['id_outlet']) ? 'selected' : '' ?>><?=$x->nama?></option>
                        <?php endforeach ?>
                      </select>
                        <?=form_error('outlet','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Posisi</label>
                      <select name="role" class="form-control">
                        <option value="">Pilih Posisi</option>
                        <option value="admin" <?=('admin' == $user['role']) ? 'selected' : '' ?>>admin</option>
                        <option value="kasir" <?=('kasir' == $user['role']) ? 'selected' : '' ?>>kasir</option>
                        <option value="owner" <?=('owner' == $user['role']) ? 'selected' : '' ?>>owner</option>
                      </select>
                      <?=form_error('role','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Gambar</label>
                      <input type="hidden" name="gbr_lama" value="<?=$user['gambar']?>">
                      <input type="file" name="gambar" id="preview" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <img src="#" id="gambar" width="325px" alt="preview gambar">
                    </div>
                  </div>
                </div>             
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <button type="reset" class="btn btn-danger btn-block">Reset</button>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block simpan">Simpan</button>
                    </div>
                  </div>
                </div> 
              </form>
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
      function bacaGambar(input){
        if (input.files && input.files[0]) {
          var reader  = new FileReader();
          reader.onload = function(e){
            $('#gambar').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#preview").change(function(){
        bacaGambar(this);
      }); 
     $(document).ready(function(){
      const error = $(".flash-error").data('flashdata');
        if (error) {
          Toast.fire({
            type: 'error',
            text:error
          })
        }
     })
    </script>