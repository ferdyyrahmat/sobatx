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
<div class="section product-section" style="margin-bottom: 70px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp; Pesanan Saya</h4>
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
                     <div class="row">
                        <?php foreach ($dataPesanan as $data) { ?>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 10px;">
                           <div class="" style="text-align: left;">
                              <div class="row" style="padding: 0 5px; border: 1px solid grey; border-radius: 10px;">
                                 <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    <div class="row">
                                       <div class="col-md-6 col-sm-6 col-xs-6">
                                          <span style="font-size:10px;">
                                             <i class="fa-solid fa-store"></i>&nbsp;<b><?= $data['nama_toko'] ?></b>
                                          </span>
                                       </div>
                                       <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                          <span style="font-size:11px;">
                                             {status pesanan}
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <hr style="border: 1px solid #adadad; margin:0;">
                                 <a href="/marketplace/detail-pesanan/<?= $data['id_pesanan'] ?>" style="padding-bottom:10px;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <div class="row">
                                          <div class="col-md-4 col-xs-2" style="padding: 5px 0 5px 10px;">
                                             <img src="<?= base_url() ?>Assets/img/toko/produk/<?= $data['nm_foto'] ?>"
                                                alt="" class="img-responsive"
                                                style="width: -webkit-fill-available; border: 1px solid grey; border-radius: 10px;">
                                          </div>
                                          <div class="col-md-8 col-xs-10">
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                   <span>
                                                      <b><?= $data['nama_produk'] ?> </b>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                       <div class="row">
                                          <div class="col-md-6 col-sm-6 col-xs-6">
                                             <div style="margin: 0 15px; text-align: left;">
                                                <small>
                                                   Total <?= $data['jumlah'] ?> item
                                                </small>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-6 col-xs-6">
                                             <div style="margin: 0 15px; text-align: right;">
                                                <small>
                                                   <b style="color: grey;">
                                                      Harga:
                                                      Rp<?= number_format($data['total_bayar'], 0, ",", ".") ?>
                                                   </b>
                                                </small>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </a>
                                 <?php 
                                 if($data['status'] == '2'){
                                 ?>
                                 <div class="col-md-12" style="text-align: right; align-item: end;">
                                    <div class="btn btn-success btn-sm" style="margin: 10px 0">pesanan diterima</div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
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