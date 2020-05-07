<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('master/pelanggan')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?=base_url('master/pelanggan/edit/'.base64_encode($member['id_member']))?>">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama Member</label>
                        <input type="text" name="nama" placeholder="nama member.." class="form-control" value="<?=$member['nama']?>">
                        <?=form_error('nama','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Status</label>
                        <input type="text" name="status" readonly placeholder="status.." class="form-control" value="Member">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Jenis Kelamin</label><br>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary <?=($member['jenis_kelamin'] == 'L' ? 'active' : '')?>">
                          <input type="radio" name="jenis_kelamin" id="option1"  value="L" autocomplete="off" <?=($member['jenis_kelamin'] == 'L' ? 'checked' : '')?>> Laki-Laki
                        </label>
                        <label class="btn btn-primary <?=($member['jenis_kelamin'] == 'P' ? 'active' : '')?>">
                          <input type="radio" name="jenis_kelamin"  id="option2" value="P" autocomplete="off" <?=($member['jenis_kelamin'] == 'P' ? 'checked' : '')?>> Perempuan
                        </label>
                      </div><br>
                      <?=form_error('jenis_kelamin','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Telepon</label><br>
                      <input type="number" name="tlp" class="form-control" placeholder="telepon.." value="<?=$member['tlp']?>">
                      <?=form_error('tlp','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>    
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="alamat.."><?=$member['alamat']?></textarea>
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