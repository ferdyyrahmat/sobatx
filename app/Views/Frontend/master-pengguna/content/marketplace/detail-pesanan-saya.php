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
                     <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <center>
                              <h3 style="position: relative; z-index: 1;">Order Successfully</h3>
                              <img class="img-responsive" src="<?= base_url() ?>Assets/img/gif/order-success.gif"
                                 style="margin: -60px 0px -50px -0px;">
                              <small>
                                 <span>Kurir akan segera mengantarkan pesananmu</span>
                                 <br>
                                 <span>mohon menunggu</span>
                              </small>
                           </center>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <center>
                                    <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>">
                                       <button type="button" class="btn btn-default btn-sm">Kembali</button>
                                    </a>
                                    <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>">
                                       <button type="button" class="btn btn-success btn-sm">Pesanan Diterima</button>
                                    </a>
                                 </center>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                           <div class="row" style="margin-top: 30px; margin-bottom: 10px;">
                              <div class="col-12 col-md-12 col-sm-12 col-xs-12"
                                 style="border-bottom: 1px solid grey; padding-bottom: 10px;">
                                 <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                       <span><b>Info Pengiriman</b></span>
                                    </div>
                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 10px;">
                                       <i class="fa-solid fa-truck-fast"></i>
                                       <span style="font-size: 12px;"><?= strtoupper($dataPesanan['metode'])?></span>
                                    </div>
                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6"
                                       style="padding-top: 10px; text-align: right;">
                                       <span><small>Rp<?= number_format($dataPesanan['total_bayar'], 0, "", ".")?></small></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 10px;">
                                 <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                       <span><b>Alamat Pengiriman</b></span>
                                    </div>
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                                       <div class="col-md-2 col-xs-1" style="padding: 0; text-align: center;">
                                          <i class="fa-solid fa-location-dot"
                                             style="color: #ec971f; font-size: 15px;"></i>
                                       </div>
                                       <div class="col-md-10 col-xs-11" style="padding: 0;">
                                          <p style="font-size: 12px;">
                                             <span style="font-size: 12px;">
                                                <?php if(isset($dataPesanan['nama_penerima'])){ ?>
                                                <b><?= $dataPesanan['nama_penerima']?></b> (
                                                <?= $dataPesanan['no_hp_penerima']?> )
                                                <br>
                                                <?= $dataPesanan['alamat_lengkap']?>
                                                (<?= $dataPesanan['detail_alamat']?>)
                                                <?php } ?>
                                             </span>
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row" style="margin-bottom: 10px;">
                              <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid grey;">
                                 <i class="fa-solid fa-store"></i>&nbsp;<b><?= $dataPesanan['nama_toko']?></b>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <div class="row">
                                    <div class="col-md-4 col-xs-3" style="padding: 5px 0 5px 10px;">
                                       <img src="<?= base_url() ?>Assets/img/toko/produk/<?= $dataPesanan['nm_foto'] ?>"
                                          alt=""
                                          style="width: -webkit-fill-available; border: 1px solid grey; border-radius: 10px;">
                                    </div>
                                    <div class="col-md-8 col-xs-9" style="padding: 5px 5px 5px 10px;">
                                       <p style="font-size: 12px;">
                                          <b><?= $dataPesanan['nama_produk'] ?> </b>
                                          <p style="font-size: 12px; text-align:right">
                                             <span style="font-size: 13px;">
                                                x<?= $dataPesanan['jumlah'] ?>
                                             </span>
                                          </p>
                                          <span
                                             style="width: 100%; text-align: right;">Rp<?= number_format($dataPesanan['total_harga'], 0, ",", ".") ?></span>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"
                                    style="margin-bottom: 5px; border-radius: 10px;">
                                    <div class="panel panel-default">
                                       <div class="panel-heading" role="tab" id="headingOne"
                                          style=" text-align: right;">
                                          <h4 class="panel-title">
                                             <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <small>Total Pesanan:
                                                   Rp<?= number_format($dataPesanan['total_bayar'], 0, ",", ".") ?>
                                                   &nbsp;<i class="fa-solid fa-angle-down"></i>
                                                </small>
                                             </a>
                                          </h4>
                                       </div>
                                       <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                          aria-labelledby="headingOne">
                                          <div class="panel-body">
                                             <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                   <small>
                                                      <span>Harga Produk</span>
                                                      <br>
                                                      <span>Jumlah Pembelian</span>
                                                      <br>
                                                      <span>Biaya Ongkir</span>
                                                      <br>
                                                      <span style="font-size: 14px;"><b>Total</b></span>
                                                   </small>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                                   <small>
                                                      <span>Rp<?= $dataPesanan['harga']?></span>
                                                      <br>
                                                      x<?= $dataPesanan['jumlah'] ?>
                                                      <br>
                                                      <span>
                                                         <?php $ongkir = (int)$dataPesanan['total_bayar'] - (int)$dataPesanan['total_harga']?>
                                                         Rp<?= number_format($ongkir, 0, "", ".") ?>
                                                      </span>
                                                      <br>
                                                      <span style="font-size: 14px;">
                                                         <b>Rp<?= number_format($dataPesanan['total_bayar'], 0, ",", ".") ?></b>
                                                      </span>
                                                   </small>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
                                                   <small><i>(*biaya layanan sudah termasuk ongkir)</i></small>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <span></span>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6"></div>
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