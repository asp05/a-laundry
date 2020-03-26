<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('master/paket')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                  <?=$this->session->flashdata('eror')?>
                </div>
              <?php endif ?>
              <form method="post" action="<?=base_url('master/paket/edit/'.base64_encode($paket['id_paket']))?>" >
                <div id="outlet"></div>
                <div id="paket"></div>
                <div id="jenis"></div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama Outlet</label>
                        <select name="outlet" class="form-control outlet"  disabled>
                          <option value="">Pilih Outlet</option>
                          <?php foreach ($outlet as $x): ?>
                            <?$a = $x->id_outlet ?>
                            <option value="<?=$x->id_outlet?>" <?=($x->id_outlet == $paket["id_outlet"] ? 'selected' : '')?>><?=$x->nama?></option>
                          <?php endforeach ?>
                        </select>
                        <?=form_error('outlet','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Jenis Paket</label>
                        <select name="jenis_paket" class="form-control jenis" id="jenis"  disabled>
                          <option value="">Jenis Paket</option>
                          <?php foreach ($jenis as $x): ?>
                            <option value="<?=$x->id_jenis_paket?>" <?=($x->id_jenis_paket == $paket['jenis_paket'] ? 'selected' : '')?> ><?=$x->nama_jenis?></option>
                          <?php endforeach ?>
                        </select>
                        <?=form_error('jenis_paket','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama Paket</label>
                        <select name="nama_paket" disabled class="form-control paket" id="paket">
                          <option value="">Pilih Paket</option>
                          <option value="kiloan" <?=('kiloan' == $paket['nama_paket'] ? 'selected' : '')?>>Kiloan</option>
                          <option value="satuan" <?=('satuan' == $paket['nama_paket'] ? 'selected' : '')?>>Satuan</option>
                        </select> 
                        <?=form_error('nama_paket','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="number" name="harga" class="form-control" onclick="nilaiwe(this.value)" onchange="nilaiwe(this.value)" onkeyup="nilaiwe(this.value)" value="<?=$paket['harga']?>">
                      <div style="margin-top: 0.2cm">
                          <b class="hasil-nilai"></b>
                      </div>
                      <?=form_error('harga','<small class="text-danger">','</small>')?>
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
                      <button type="" class="btn btn-primary btn-block simpan">Simpan</button>
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
      var rp_hasil_nilai = $('.hasil-nilai');
      function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
      }

      function nilaiwe(value) {
        rp_hasil_nilai.text(convertToRupiah(value));
      }
    </script>
