<style type="text/css">
  .garis{
    width: 100%;
    height: 0.5px;
    background: grey;
    margin-top: 10px;
    margin-bottom: 10px;
  }
</style>
<!-- Main content -->
    <section class="content">
      <form method="post" action="<?=base_url('master/transaksi/simpan')?>">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">A-Laundry : <?=$judul?></h3>
              <div class="card-tools">
                <a href="<?=base_url('master/transaksi')?>" class="btn btn-tool"><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <div class="row">
                  <div class="col-12">
                    <a href="#modal-default" class="btn btn-success mb-2 col-md-2 col-xs-12" data-toggle="modal"title="tambah paket">Tambah</a>
                    <table class="table table-striped table-sm cL">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jenis Paket</th>
                          <th>Nama Paket</th>
                          <th>Harga Satuan</th>
                          <th>QTY</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1;$total=0; foreach ($sementara as $x): ?>
                          <input type="hidden" name="id_paket[]" value="<?=$x->id_paket?>">
                          <input type="hidden" name="keterangan[]" value="<?=$x->keterangan?>">
                          <input type="hidden" name="satuan[]" value="<?=$x->harga_satuan?>">
                          <tr>
                            <div class="id" data-id="<?=$x->id_sementara?>"></div>
                            <td><?=$no++?></td>
                            <td><?=$x->nama_jenis?></td>
                            <td><?=$x->nama_paket?></td>
                            <td>Rp. <?=$x->harga_satuan?></td>
                            <td><input type="number" id="<?=$x->qty?>" style="width: 35px" name="qty1[]" value="<?=$x->qty?>" size="10" onchange="updateqty(this.value,<?=$x->id_sementara?>)" ></td>
                            <td>Rp.<?php $tot = $x->qty*$x->harga_satuan;echo number_format($tot)?></td>
                            <td><a href="<?=base_url('master/transaksi/hapusSementara/'.$x->id_sementara)?>" title="" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                          </tr>
                        <?php $total += $tot;?>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group mb-4">
                      <label>Nama Member</label>
                      <select name="nama_member" class="form-control" onchange="getMember(this.value)">
                        <option value="">Pilih Pelanggan</option>
                        <?php foreach ($member as $x): ?>
                          <option value="<?=$x->id_member?>"><?=$x->nama?></option>
                        <?php endforeach ?>
                      </select>
                      <?=form_error('nama_member','<small class="text-danger">','</small>')?>
                    </div>
                    <div id="pelanggan"></div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="text-center text-danger">
                      <strong>Total Paket</strong><br>
                      Rp.<?=number_format($total,2)?>
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-3 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tagihan</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-4">Paket</div>
                <div class="col-1">: </div>
                <div class="col-7">Rp.<?=number_format($total,2)?></div>
                <div class="col-4">Diskon</div>
                <div class="col-1">: </div>
                <div class="col-3">
                  <input type="text" name="diskon" value="0" style="width:30px;border-width:0px;border:none" readonly>
                </div>
                <div class="col-4">%</div>
                <div class="col-4">Pajak</div>
                <div class="col-1">: </div>
                <div class="col-3"><div id="pajak"></div></div> 
                <div class="col-4">%</div> 
              </div>
              <div class="garis"></div>
              <div class="row">
                <div class="col-12" style="text-align: right;"><strong>Total</strong></div>   
                <div class="col-12" style="text-align: right;">
                  <input type="text" name="total" style="width: 80px;border: none;border-radius: 0px" readonly  placeholder="           Rp.0">
                </div>
              </div>
              <div class="row">
                <div class="col-4 d-none d-md-block">Bayar</div> 
                <div class="col-md-8 col-xs-12 ">
                  <input type="number" name="bayar" onkeyup="kembali(this.value)" style="width: 100%;">
                </div> 
              </div>
              <div class="row">
                <div class="col-12 text-right">
                  <div id="kembali">Rp.0</div>
                </div>
              </div>
            </div>
          </div>
        </div>        <!-- /.col -->
      </div>
      <!-- /.row -->
      </form>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Paket</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" class="form-user">
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Jenis Paket</label>
                    <select name="jenis_paket" class="form-control" onchange="ambilPaket(this.value)">
                      <option value="">Pilih Jenis Paket</option>
                      <?php foreach ($paket as $x): ?>
                        <option value="<?=$x->jenis_paket?>"><?=$x->nama_jenis?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" class="form-control" id="nilaiwe" readonly>
                    <input type="hidden" name="id_p" value="">
                    <div style="margin-top: 0.2cm">
                        <b class="hasil-nilai"></b>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="1"></textarea>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Nama Paket</label>
                    <select name="nama_paket" class="form-control" onchange="ambilHarga(this.value)"></select>
                  </div>
                  <div class="form-group">
                    <label>QTY</label>
                    <input type="number" name="qty" value="1" class="form-control" onkeyup="qt(this.value)" onclick="qt(this.value)">
                  </div>
                  <div class="form-group" style="text-align: center;">
                    <strong>Total Harga<div style="color: red;" id="total_paket"></div></strong> 
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
              <input type="button" disabled="disabled" id="add" class="btn btn-primary" value="Simpan">
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <script>
      $(document).ready(function(){
        getPajak();
      })
      function getMember(value) {

        $.ajax({
          url : "<?=base_url('master/transaksi/ambil_pelanggan')?>",
          type: "POST",
          dataType:"html",
          data : {
            pel :value,
          },
          success : function(response) {
            $('#pelanggan').html(response)
            if (value != 3) {
              getDiskon();
              cekTotal()
            }else{
              $("[name='diskon']").val('0')
              cekTotal()
            }
          }
        })
      }
      function ambilPaket(value) {
        $('[name="harga"]').val("");
        $('#total_paket').html("");
        var buton = document.getElementById('add');
        buton.disabled = true;
        var outlet = "<?=$this->session->userdata('outlet')?>";
        $.ajax({
          url : "<?=base_url('master/transaksi/ambilPaket')?>",
          type: "post",
          dataType: "JSON",
          data : {
            jenis_paket : value,
            outlet      : outlet
          },
          success : function(response) {

           var ls = `<option value="">Pilih Paket</option>`
           response.data.map(({nama_paket})=>{
            ls += `<option value=${nama_paket}>${nama_paket}</option>`
           });
           $('[name="nama_paket"]').html(ls); 
          }
        })
      }
      function ambilHarga(value) {
        
        var outlet = "<?=$this->session->userdata('outlet')?>";
        var jenisPaket = $('[name="jenis_paket"]').val();
        $.ajax({
          url : "<?=base_url('master/transaksi/ambilHarga')?>",
          type: "POST",
          dataType:"JSON",
          data: {
            outlet : outlet,
            jenis_paket : jenisPaket,
            nama_paket:value
          },
          success:function(response){
            $('[name="harga"]').val(response.data.harga);
            $('[name="id_p"]').val(response.data.id_paket)
            var rp_hasil_nilai = $('.hasil-nilai');
            var nilai = $("#nilaiwe").val();
            var harga = $('#nilaiwe').val();
            var kuant = $('[name="qty"]').val();
            var hasil =harga*kuant
            rp_hasil_nilai.text(convertToRupiah(nilai));
            console.log(hasil)
            $("#total_paket").html(convertToRupiah(hasil))
            var buton = document.getElementById('add');
            if (hasil <= 0 ) {
              buton.disabled = true
            }else{
              buton.disabled = false
            }
          }
        })
      }
      function convertToRupiah(angka) {
         var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
      }
      function qt(value){
        var harga = $('#nilaiwe').val();
        var hasil = harga*value
        $("#total_paket").html(convertToRupiah(hasil))
        var buton = document.getElementById('add');
        if (hasil <= 0 ) {
          buton.disabled = true
        }else{
          buton.disabled = false
        }
      }
      $('#add').on('click', function(){
        var data = $('.form-user').serialize();
        $.ajax({
          url : "<?=base_url('master/transaksi/simpancart')?>",
          type :"post",
          data : data,
          success:function(){
            $(document).ajaxStop(function(){
              window.location.reload();
              cekTotal()
            })
          }
        })
      })
      function updateqty(value,id) {
        $.ajax({
          url : '<?=base_url('master/transaksi/updateqty')?>',
          type: 'post',
          dataType:'json',
          data : {
            qty : value,
            id : id
          },
          success : function(response){
            if (response.status == 'berhasil') {
              $(document).ajaxStop(function(){
                window.location.reload();
                cekTotal()
              })
            }else{
              console.log('gagal')
            }
          }
        })
      }
      function getDiskon() {
        $.ajax({
          url : '<?=base_url('master/transaksi/cekDiskon')?>',
          type: 'post',
          dataType:'json',
          success:function(response){
            $('[name="diskon"]').val(response.data)
            cekTotal()
          }
        })
      }
      function getPajak() {
        var p = null;
        $.ajax({
          url : '<?=base_url('master/transaksi/getPajak')?>',
          type: 'post',
          dataType:"json",
          success:function(response){
            $('#pajak').html('<input type="text" name="pajak" value="'+response.data.persentase+'" style="width:30px;border-width:0px;border:none" readonly>')
            cekTotal()
          }
        })
      }
      var total
      function cekTotal(){
        var d = $('[name="diskon"]').val()
        var p = $('[name="pajak"]').val()
        var t = '<?=$total?>'
        var diskon,pajak;
        diskon = t*d/100;
        pajak = t*p/100;
        total = t-diskon+pajak
        $("[name='total']").val(convertToRupiah(total))
      }
      function kembali(value) {
        $('#kembali').html(convertToRupiah(value-total))
      }
    </script>   