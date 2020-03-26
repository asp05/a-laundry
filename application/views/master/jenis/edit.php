<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('setting/jenis_paket')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?=base_url('setting/jenis_paket/edit/'.base64_encode($jenis['id_jenis_paket']))?>">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                      <label>Nama Jenis</label>
                        <input type="text" name="nama_jenis" readonly placeholder="nama jenis.." class="form-control" value="<?=$jenis['nama_jenis']?>">
                        <?=form_error('nama_jenis','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Kiloan</label>
                        <input type="number" name="kiloan" placeholder="kiloan.." onchange="nilaiwe(this.value)" onkeyup="nilaiwe(this.value)" onclick="nilaiwe(this.value)" class="form-control" value="<?=$jenis['kiloan']?>">
                        <div style="margin-top: 0.2cm">
                            <b class="hasil-nilai"></b>
                        </div>
                        <?=form_error('kiloan','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Satuan</label>
                        <input type="number" name="satuan" onchange="nilais(this.value)" onkeyup="nilais(this.value)" onclick="nilais(this.value)" placeholder="satuan.." class="form-control" value="<?=$jenis['satuan']?>">
                        <div style="margin-top: 0.2cm">
                            <b class="hasil-satuan"></b>
                        </div>
                        <?=form_error('satuan','<small class="text-danger">','</small>')?>
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
      var rp_hasil_nilai = $('.hasil-nilai');
      var rp_hasil_satuan = $('.hasil-satuan');
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
      function nilais(value) {
        rp_hasil_satuan.text(convertToRupiah(value));
      }
    </script>