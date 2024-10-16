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
                        <div class="col-md-12 col-xs-12">
                           <div class="row" style="margin-bottom: 10px;">
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
                              <?php
                              if($dataPesanan['status_pesanan'] == '2'){ ?>
                              <div class="col-12 col-md-12 col-sm-12 col-xs-12"
                                 style="border-bottom: 1px solid grey; padding-bottom: 10px;">
                                 <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                       <span><b>Info Kurir</b></span>
                                    </div>
                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 10px;">
                                       <i class="fa-solid fa-person-walking-luggage"></i>
                                       <span
                                          style="font-size: 12px;"><?= strtoupper($dataPesanan['nama_kurir'])?></span>
                                    </div>
                                    <div class="col-6 col-md-6 col-sm-6 col-xs-6"
                                       style="padding-top: 10px; text-align: right;">
                                       <span><?= $dataPesanan['no_hp_kurir']?></span>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
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
                                                x<?= $dataPesanan['jumlah']?>
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
                        <?php
                        if($dataPesanan['status_pesanan'] == '1'){ ?>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                           <div class="row">
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                 <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>">
                                    <button type="button" class="btn btn-default" style="width:100%">Kembali</button>
                                 </a>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                 <!-- <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>"> -->
                                 <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#modalPesanan" style="width:100%">Kirim Barang</button>
                                 <!-- </a> -->
                              </div>
                           </div>
                        </div>
                        <?php 
                        }elseif($dataPesanan['status_pesanan'] == '2'){ ?>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                           <div class="row">
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                 <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>">
                                    <button type="button" class="btn btn-default" style="width:100%">Kembali</button>
                                 </a>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-6">
                                 <!-- <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user']) ?>"> -->
                                 <div class="btn btn-info"
                                    style="width:100%"><i>Sedang dikirim</i></div>
                                 <!-- </a> -->
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
<style>
   .modal {
      text-align: center;
      padding: 0 !important;
   }

   .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
   }

   .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
      min-width: 300px;
   }
</style>
<!-- Modal -->
<div class="modal fade" id="modalPesanan" tabindex="-1" role="dialog" aria-labelledby="modalPesananLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <form action="/marketplace/kirim-pesanan/<?= $dataPesanan['id_pesanan']?>" method="post">
               <div class="form-group">
                  <label for="exampleInputEmail1">Masukkan Nama Kurir</label>
                  <input type="text" class="form-control" name="nama_kurir" placeholder=" masukkan nama kurir">
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">No Handphone</label>
                  <input type="tel" class="form-control" name="no_hp_kurir" placeholder="08...">
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
            </form>
         </div>
      </div>
   </div>
</div>