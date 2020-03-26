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
                  <?=$this->session->flashdata('error')?>
                </div>
              <?php endif ?>
              <form method="post" action="<?=base_url('master/paket/tambah')?>">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Nama Outlet</label>
                        <select name="outlet" class="form-control outlet" id="outlet">
                          <option value="">Pilih Outlet</option>
                          <?php foreach ($outlet as $x): ?>
                            <option value="<?=$x->id_outlet?>"><?=$x->nama?></option>
                          <?php endforeach ?>
                        </select>
                        <?=form_error('outlet','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Jenis Paket</label>
                        <select name="jenis_paket" class="form-control jenis" id="jenis" disabled="disabled">
                          <option value="">Jenis Paket</option>
                          <?php foreach ($jenis as $x): ?>
                            <option value="<?=$x->id_jenis_paket?>"><?=$x->nama_jenis?></option>
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
                        <select name="nama_paket" disabled="disabled" class="form-control paket" id="paket">
                          <option value="">Pilih Paket</option>
                          <option value="kiloan">Kiloan</option>
                          <option value="satuan">Satuan</option>
                        </select> 
                        <?=form_error('nama_paket','<small class="text-danger">','</small>')?>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                      <label>Harga</label>
                      <div id="ha"></div>
                      <div style="margin-top: 0.2cm">
                          <b class="hasil-nilai"></b>
                      </div>
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
    <!-- <script>
      var o = $('.o');
      var n = $('.np');
      var jp = $('.jp');
      function cekPaket(value) {
        var jenis = $('[name = "jenis_paket"]').val();
        var outlet = $('[name = "outlet"]').val();
        console.log(jenis,outlet,value);
        $("#np").html("");
        if (jenis == '') {
          $("#jp").html("jenis tidak boleh kosong");
        }
        if (jenis != '') {
          $("#jp").html("");
        }
        if (outlet == '') {
          $("#o").html("outlet tidak boleh kosong");
        }
        if (outlet != '') {
          $("#o").html("")
        }
        $.ajax({
          url : "<?=base_url('master/paket/ambilJenis')?>",
          data : {
            nama_paket : value,
            id_jenis_paket:jenis,
            outlet:outlet
          },
          dataType:"JSON",
          type:"post",
          success:function(response){
            if (response.berhasil) {
              n.addClass('text-success');
              n.removeClass('text-danger');
              $("#np").html("sukses");
              var ls;
              response.data.map(({id_jenis_paket,kiloan,satuan}) => {
                ls += `<option value=${kiloan}>${kiloan}</option>`
              });
              $('[name = "harga"]').html(ls);
            }else{
              n.addClass('text-danger');
              n.removeClass('text-success');
              $("#np").html("gagal");
            }
          }
        })
      }
      function jenis(value) {
        $('#jp').html('');
        var nama = $('[name = "nama_paket"]').val();
        var outlet = $('[name = "outlet"]').val();
        console.log(nama,outlet,value);
        if (nama == '') {
          $("#np").html("nama paket tidak boleh kosong");
        }
        if (nama != '') {
          $("#np").html("");
        }
        if (outlet == '') {
          $("#o").html("outlet tidak boleh kosong");
        }
        if (outlet != '') {
          $("#o").html("")
        }
        $.ajax({
          url : "<?=base_url('master/paket/ambilJenis')?>",
          type:"post",
          dataType:"JSON",
          data:{
            nama_paket : nama,
            id_jenis_paket:value,
            outlet:outlet
          },
          success:function(data){
            if (data.berhasil) {
              n.addClass('text-success');
              n.removeClass('text-danger');
              $("#np").html("sukses");
            }else{
              n.addClass('text-danger');
              n.removeClass('text-success');
              $("#np").html("gagal");
            }
          }
        })
      }
      function aOutlet(value) {
        $("#o").html("");
        var nama = $('[name = "nama_paket"]').val();
        var jenis = $('[name = "jenis_paket"]').val();
        if (nama == '') {
          $("#np").html("nama paket tidak boleh kosong");
        }
        if (nama != '') {
          $("#np").html("");
        }
        if (jenis == '') {
          $("#jp").html("jenis tidak boleh kosong");
        }
        if (jenis != '') {
          $("#jp").html("")
        }
        $.ajax({
          url : "<?=base_url('master/paket/ambilJenis')?>",
          type:"post",
          dataType:"JSON",
          data:{
            nama_paket : nama,
            id_jenis_paket:jenis,
            outlet:value
          },
          success:function(data){
            if (data.berhasil) {
              n.addClass('text-success');
              n.removeClass('text-danger');
              $("#np").html("sukses");
            }else{
              n.addClass('text-danger');
              n.removeClass('text-success');
              $("#np").html("gagal");
            }
          }
        })
      }
    </script> -->
    <script>
      $(".outlet").select2({

      });
      $(".paket").select2({
        
      });
      $(".jenis").select2({
        
      });
      $(".outlet").on('change',function(){
        var j = document.getElementById("jenis");
        j.disabled = false;
      })
      $(".jenis").on('change',function(){
        var p = document.getElementById("paket");
        p.disabled = false
      })
      $(".paket").on('change',function(){
        var nama_paket = $('[name = "nama_paket"]').val();
        var jenis_paket = $('[name = "jenis_paket"]').val();
        $.ajax({
          url : "<?=base_url('master/paket/ambilJenis')?>",
          type: "post",
          dataType: "JSON",
          data : {
            nama_paket : nama_paket,
            jenis_paket : jenis_paket,
          },
          success : function(response){
            if (response.data.kiloan != null) {
              var ha = `<input type="text" name="ha" readonly class="form-control" id="nilaiwe" value=${response.data.kiloan}>`;
              $("#ha").html(ha);
              var rp_hasil_nilai = $('.hasil-nilai');
              function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
              }

              var nilai = $("#nilaiwe").val();
              rp_hasil_nilai.text(convertToRupiah(nilai));
            }
            if (response.data.satuan != null){
              var ha = `<input type="text" readonly name="ha" class="form-control" id="nilaiwe" value=${response.data.satuan}>`;
              $("#ha").html(ha);
              var rp_hasil_nilai = $('.hasil-nilai');
              function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
              }

              var nilai = $("#nilaiwe").val();
              rp_hasil_nilai.text(convertToRupiah(nilai));
            }
          }
        })
      })
    </script>