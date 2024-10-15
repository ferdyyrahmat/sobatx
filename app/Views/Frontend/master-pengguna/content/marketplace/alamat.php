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
                  <h4><i class="fa-solid fa-location-dot" style="color: #ec971f; font-size: 15px;"></i> Alamat
                     Pengiriman</h4>
               </div>
               <!-- /Product main img -->

               <!-- Product details -->
               <div class="col-md-5">
                  <div class="product-details" style="margin-top: 5px;">
                     <div class="row"
                        style="border-bottom: 1px dashed; border-bottom-width: medium; padding-top: 10px;">
                        <?php foreach($dataAlamat as $data) {?>
                        <a href="/marketplace/alamat/selected/<?= sha1($data['id_alamat'])?>" class="btn btn-default"
                           style="padding: 5px 5px 0 5px; vertical-align: baseline; text-align: left; white-space: normal; border-radius: 10px;">
                           <div class="col-md-2 col-xs-1" style="padding: 0; text-align: center;">
                              <i class="fa-solid fa-location-dot" style="color: #ec971f; font-size: 15px;"></i>
                           </div>
                           <div class="col-md-10 col-xs-11" style="padding: 0;">
                              <p style="font-size: 15px;">
                                 <span style="font-size: 13px;">
                                    <b><?= $data['nama_penerima']?></b> | <?= $data['no_hp_penerima']?> <br>
                                    <?= $data['alamat_lengkap']?> (<?= $data['detail_alamat']?>)
                                    <br/>
                                    <?php
                                    foreach($dataKota as $kota){
                                       $idKota = $data['id_kota'];
                                       if($kota['city_id'] == $idKota){
                                          $dataKota_r = $kota['city_name'];
                                       }
                                    }
                                    foreach($dataProvinsi as $provinsi){
                                       $idProvinsi = $data['id_provinsi'];
                                       if($provinsi['province_id'] == $idProvinsi){
                                          $dataProvinsi_r = $provinsi['province'];
                                       }
                                    }
                                    ?>
                                    <?= $dataKota_r?>, <?= $dataProvinsi_r?>, <?= $data['kode_pos']?>
                                 </span>
                              </p>
                           </div>
                        </a>
                        <?php }?>
                     </div>
                     <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                        <a href="/marketplace/checkout/alamat/input" class="btn btn-warning" style="width: -webkit-fill-available;">tambah alamat</a>
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