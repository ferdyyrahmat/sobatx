<style>
   html {
      scroll-behavior: smooth;
   }

   .product-section {
      padding: 17vw 0 0 0;
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
                  <h4><i class="fa-solid fa-location-dot" style="color: #ec971f; font-size: 15px;"></i> Tambah Alamat
                     Pengiriman</h4>
               </div>
               <!-- /Product main img -->

               <!-- Product details -->
               <div class="col-md-5">
                  <div class="product-details" style="margin-top: 5px;">
                     <form action="/marketplace/save/alamat" method="POST">
                        <div class="row"
                           style="border-bottom: 1px dashed; border-bottom-width: medium; padding-top: 10px;">
                           <div class="form-group">
                              <label for="nama_penerima">Nama Penerima</label>
                              <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Masukkan Nama" required>
                           </div>
                           <div class="form-group">
                              <label for="no_hp">No Handphone</label>
                              <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="+62..." required>
                           </div>
                           <div class="form-group">
                              <label for="provinsi">Provinsi</label>
                              <select class="form-control" name="provinsi" id="provinsi"></select>
                           </div>
                           <div class="form-group">
                              <label for="provinsi">Kota</label>
                              <select class="form-control" name="kota" id="kota"></select>
                           </div>
                           <div class="form-group">
                              <label for="alamat_lengkap">Alamat Lengkap</label>
                              <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="30"
                                 rows="3"></textarea>
                           </div>
                           <div class="form-group">
                              <label for="detail_alamat">Detail Alamat</label>
                              <input type="text" class="form-control" id="detail_alamat" name="detail_alamat" placeholder="Cth: Blok J No.2">
                           </div>
                           <div class="form-group">
                              <label for="kode_pos">Kode Pos</label>
                              <input type="number" class="form-control" id="kode_pos" name="kode_pos" placeholder="12345" required>
                           </div>
                        </div>
                        <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                           <button type="submit" class="btn btn-warning" style="width: -webkit-fill-available;">simpan alamat</button>
                        </div>
                     </form>
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
         url: '<?= base_url('/rajaongkir/provinsi')?>',
         success: function (hasil_provinsi) {
            $("select[id=provinsi]").html(hasil_provinsi);
            // console.log(hasil_provinsi);
         }
      });

      $('select[id=provinsi]').on("change", function () {
         var id_provinsi = $('option:selected', this).attr('id_provinsi');
         $.ajax({
            type: 'POST',
            url: '<?= base_url('/rajaongkir/kota')?>',
            data: 'id_provinsi=' + id_provinsi,
            success: function (hasil_kota) {
               // console.log(hasil_kota);
               $("select[id=kota]").html(hasil_kota);
            }
         })
      })
   });
</script>