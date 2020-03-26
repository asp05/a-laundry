<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('master/outlet')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?=base_url('master/outlet/edit/'.base64_encode($outlet['id_outlet']))?>">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama Outlet</label>
                        <input type="text" name="nama_outlet" placeholder="nama outlet.." class="form-control" value="<?=$outlet['nama']?>">
                        <?=form_error('nama_outlet','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>No Telpon</label>
                        <input type="text" name="tlp" placeholder="telpon.." class="form-control" value="<?=$outlet['tlp']?>">
                        <?=form_error('tlp','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Alamat</label>
                        <textarea name="alamat" class="form-control"><?=$outlet['alamat']?></textarea>
                        <?=form_error('alamat','<small class="text-danger">','</small>')?>
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