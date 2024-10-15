<style>
   html {
      scroll-behavior: smooth;
   }

   .product-section {
      padding: 17vw 0 17vh 0;
   }

   .chart {
      z-index: 999999;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      max-height: 100px;
      box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
      background-color: #167B60;
      display: flex;
      overflow-x: auto;
   }

   .product-details .add-to-cart .add-to-cart-btn {
      border-radius: 0;
   }

   .nav-bottom {
      border-radius: 0;
   }

   h4 {
      margin-top: 10px;
   }
</style>
<!-- SECTION -->
<div class="section product-section">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <!-- <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp; Checkout</h4> -->
      <!-- SECTION -->
      <div class="section" style="padding-top: 0;">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- Product main img -->
               <div class="col-md-5 col-md-push-2">

               </div>
               <!-- /Product main img -->

               <!-- Product details -->
               <div class="col-md-5">
                  <div class="product-details" style="margin-top: 5px;">
                     <a href="/marketplace/checkout/alamat">
                        <div class="row"
                           style="border-bottom: 1px dashed; border-bottom-width: medium; padding-top: 10px;">
                           <div class="col-md-2 col-xs-1" style="padding: 0; text-align: center;">
                              <i class="fa-solid fa-location-dot" style="color: #ec971f; font-size: 15px;"></i>
                           </div>
                           <div class="col-md-10 col-xs-10" style="padding: 0;">
                              <p style="font-size: 15px;">
                                 <b>Alamat Pengiriman</b>
                                 <br>
                                 <span style="font-size: 13px;">
                                    <?php if(isset($dataAlamat['nama_penerima'])){ ?>
                                    <?= $dataAlamat['nama_penerima']?> | <?= $dataAlamat['no_hp_penerima']?> <br>
                                    <?= $dataAlamat['alamat_lengkap']?> (<?= $dataAlamat['detail_alamat']?>) <br />
                                    <?php
                                    foreach($dataKota as $kota){
                                       $idKota = $dataAlamat['id_kota'];
                                       if($kota['city_id'] == $idKota){
                                          $dataKota_r = $kota['city_name'];
                                       }
                                    }
                                    foreach($dataProvinsi as $provinsi){
                                       $idProvinsi = $dataAlamat['id_provinsi'];
                                       if($provinsi['province_id'] == $idProvinsi){
                                          $dataProvinsi_r = $provinsi['province'];
                                       }
                                    }
                                    ?>
                                    <?= $dataKota_r?>, <?= $dataProvinsi_r?>, <?= $dataAlamat['kode_pos']?>
                                    <?php }else{ ?>
                                    Alamat Belum dibuat!
                                    <?php } ?>
                                 </span>
                              </p>
                           </div>
                           <div class="col-md-8 col-xs-1" style="padding: 0; text-align: right; margin: 50px 0;">
                              <i class="fa-solid fa-chevron-right"></i>
                           </div>
                        </div>
                     </a>
                     <div class="row" style="padding-top: 20px;">
                        <div class="col-md-4 col-xs-3" style="padding: 0;">
                           <img src="<?= base_url()?>Assets/img/toko/produk/<?= $dataTransaksi['nm_foto']?>" alt=""
                              style="width: -webkit-fill-available; border: 1px solid grey; border-radius: 10px;">
                        </div>
                        <div class="col-md-8 col-xs-9" style="padding: 5px 0 5px 10px;">
                           <p style="font-size: 15px;">
                              <b><?= $dataTransaksi['nama_produk']?> </b>
                              <br>
                              <span style="font-size: 13px;">
                                 jumlah pembelian: <?= $dataTransaksi['jumlah']?>
                              </span>
                              <br>
                              <b>Rp <?= $dataTransaksi['harga']?></b>
                              <br />
                              <small><i><?= $dataTransaksi['berat']*$dataTransaksi['jumlah']?> gr</i></small>
                           </p>
                        </div>
                        <form action="">
                           <div class="col-md-12 col-xs-12"
                              style="padding-top: 10px;padding-bottom: 10px;border-top: 1px solid darkgray;border-bottom: 1px solid darkgray;margin-top: 10px;margin-bottom: 10px;border-radius: 10px;">
                              <p style="font-size: 14px; margin: 0;"> <b>Opsi Pengiriman</b></p>
                              <div class="form-group">
                                 <select class="form-control" name="ekspedisi" id="ekspedisi"
                                    style="border: 0; border-bottom: 1px solid #ccc; box-shadow: unset; -webkit-box-shadow: unset;"></select>
                                    <!-- <select class="form-control" name="ekspedisi"
                                    style="border: 0; border-bottom: 1px solid #ccc; box-shadow: unset; -webkit-box-shadow: unset;">
                                       <option value="">Pilih ekspedisi</option>
                                       <option value="cod">COD - Bayar di Tempat</option>
                                    </select> -->
                              </div>
                           </div>
                           <a href="#">
                              <div class="col-md-12 col-xs-12"
                                 style="border-top: 1px solid darkgrey; border-bottom: 1px solid darkgrey; border-radius: 10px;">
                                 <p style="font-size: 14px; margin:10px 0;"> <b>Metode Pembayaran</b></p>
                                 <div class="form-group">
                                    <select class="form-control" name="paket" id="paket"
                                    style="border: 0; border-bottom: 1px solid #ccc; box-shadow: unset; -webkit-box-shadow: unset;"></select>
                                    <!-- <select class="form-control" id="metode" name="metode_bayar"
                                       style="border: 0; border-bottom: 1px solid #ccc; box-shadow: unset; -webkit-box-shadow: unset;"
                                       required>
                                       <option value="">pilih pembayaran</option>
                                       <?php foreach($dataRekening as $data){?>
                                       <option value="<?= $data['nama_bank']?>"><?= strtoupper($data['nama_bank'])?>
                                       </option>
                                       <?php }?>
                                    </select> -->
                                 </div>
                              </div>
                           </a>

                           <div class="col-md-12 col-xs-12" style="padding-top: 20px;">
                              <p style="font-size: 14px; margin: 0;"> <b>Rincian Pembayaran</b></p>
                              <div class="col-xs-7">Harga Produk</div>
                              <div class="col-xs-5">Rp
                                 <?= number_format((int)str_replace(".", "", $dataTransaksi['harga'])*(int)$dataTransaksi['jumlah'], 2, ",", ".")?>
                              </div>

                              <div class="col-xs-7">Jumlah Pembelian</div>
                              <div class="col-xs-5">x <?= $dataTransaksi['jumlah']?></div>

                              <div class="col-xs-7">Biaya Pengiriman</div>
                              <div class="col-xs-5"><label id="ongkir" style="font-weight: unset;">Rp 0</label></div>

                              <!-- <div class="col-xs-7">Biaya Layanan</div>
                              <div class="col-xs-5">Rp 2.500,00</div> -->
                           </div>
                           <div class="col-md-12 col-xs-12" style="padding-top: 20px;">
                              <p class="col-xs-7" style="font-size: 14px; margin: 0; padding: 0;"> <b>Total
                                    Pembayaran</b>
                              </p>
                              <?php $t_harga = ((int)str_replace(".", "", $dataTransaksi['harga'])*(int)$dataTransaksi['jumlah'])?>
                              <div class="col-xs-5" style="font-size: 15px;">
                                 <label id="t_bayar" style="font-weight: unset;">Rp
                                    <?= number_format($t_harga, 0, "", ".")?></label>
                              </div>
                           </div>

                           <!-- Buttons -->
                           <div class="add-to-cart chart">
                              <a href="#" style="width: 100%;">
                                 <button class="btn-xs add-to-cart-btn"
                                    style="background-color: #ec971f; width: 100%; height: 100%; max-height: 60px;">
                                    <span style="font-size: 10px;">Total Pembayaran</span>
                                    <br>
                                    <b style="font-size: 15px; padding:0;"><label id="tt_bayar"
                                          style="font-weight: unset;">Rp
                                          <?= number_format($t_harga, 0, "", ".")?></label></b>
                                 </button>
                              </a>
                        </form>
                        <button id="btn_buat_pesanan" class="btn-xs add-to-cart-btn" type='button'
                           style="width: 100%; height: 100%; max-height: 60px; align-content: center; text-align-last: center;">
                           Buat Pesanan
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /Product details -->
         </div>
         <!-- /row -->
      </div>
      <!-- /container -->
   </div>
   <!-- /SECTION -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
   $(document).ready(function () {
      $.ajax({
         type: 'POST',
         url: '<?= base_url('/rajaongkir/ekspedisi')?>',
         success: function (hasil_ekspedisi) {
            $("select[id=ekspedisi]").html(hasil_ekspedisi);
            // console.log(hasil_provinsi);
         }
      });
      $('select[id=ekspedisi]').on("change", function () {
         var ekspedisi_terpilih = $('select[id=ekspedisi]').val();
         // alert(ekspedisi_terpilih);
         $.ajax({
            type: 'POST',
            url: '<?= base_url('/rajaongkir/paket ')?>',
            data: 'ekspedisi=' + ekspedisi_terpilih,
            success: function (hasil_paket) {
               // console.log(hasil_kota);
               $("select[id=paket]").html(hasil_paket);
            }
         })
      })
      $('select[id=paket]').on("change", function () {
         var a_ongkir = $('option:selected', this).attr('a_ongkir');
         var b_ongkir = $('option:selected', this).attr('b_ongkir');
         var t_harga = <?= $t_harga ?> ;
         var t_bayar = (parseInt(b_ongkir) + parseInt(t_harga));
         var metode = $('option:selected', this).attr('metode');
         $("#ongkir").html(Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
         }).format(a_ongkir));
         $("#t_bayar").html(Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
         }).format(t_bayar));
         $("#tt_bayar").html(Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
         }).format(t_bayar));
         $.ajax({
            type: 'POST',
            url: '<?= base_url('/marketplace/update-total-bayar/'.sha1($dataTransaksi['id_transaksi']))?>',
            data: {'total_bayar' : t_bayar, 'metode' : metode},
            success: $('#btn_buat_pesanan').on('click', function () {
            document.location = "<?= base_url('/marketplace/buat-pesanan/' . sha1($dataTransaksi['id_transaksi'])); ?>";
               })
         });
      })
      // $('select[id=metode]').on("change", function () {
      //    $('#btn_buat_pesanan').on('click', function () {
      //       document.location = "<?= base_url('/marketplace/buat-pesanan/'.sha1($dataTransaksi['id_transaksi']));?>";
      //    })
      // })
   });
</script>