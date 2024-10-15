<style>
   .chart {
      z-index: 999999;
      position: fixed;
      bottom: 9px;
      left: 0;
      width: 100%;
      height: 100%;
      max-height: 70px;
      box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
      /* background-color: #167B60; */
      display: flex;
      overflow-x: auto;
   }

   .product-details .add-to-cart .add-to-cart-btn {
      border-radius: 0;
   }

   .nav-bottom {
      border-radius: 0;
   }

   p {
      text-align: justify;
   }
</style>
<!-- SECTION -->
<div class="section" style="padding: 15px 15px 20vb 15px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/m/mulai-usaha"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Mulai Usaha</h4>
      <!-- SECTION -->
      <div class="section" style="padding-top: 5px;">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- Product main img -->
               <div class="col-md-5 col-md-push-2">
                  <div id="product-main-img">
                     <div class="">
                        <img src="<?= base_url('/Assets/img/paket_usaha/'.$dataPaket['foto_paket']);?>" alt=""
                           style="width: -webkit-fill-available; margin: 0 0 10px">
                     </div>
                  </div>
               </div>
               <!-- /Product main img -->

               <!-- Product details -->
               <div class="col-md-5">
                  <div class="product-details">
                     <h3 class="product-name"><?= $dataPaket['nama_paket']; ?></h3>
                     <div>
                        <!-- <h3 class="product-price"> <del class="product-old-price"></del></h3> -->
                        <h3 class="product-price">Rp <?= $money_number = number_format($dataPaket['harga'],0,',','.') ?>
                        </h3>
                        <span class="product-available">
                           <?php
                           $currentDateTime = new DateTime('now');
                           $currentDate = $currentDateTime->format('Y-m-d H:i:s');
                           if ($dataBeliPaket < $dataPaket['kuota'] and $currentDate < date("Y-m-d H:i:s", strtotime($dataPaket['tgl_berakhir']))) {
                              echo 'Tersedia';
                           }elseif ($dataBeliPaket < $dataPaket['kuota'] and $currentDate > date("Y-m-d H:i:s", strtotime($dataPaket['tgl_berakhir']))) {
                              echo 'Tidak Tersediaa';
                           }elseif ($dataBeliPaket >= $dataPaket['kuota'] and $currentDate < date('Y-M-d H:i:s', strtotime($dataPaket['tgl_berakhir']))) {
                              echo 'Penuh';
                           }elseif ($dataBeliPaket >= $dataPaket['kuota'] and $currentDate >= date('Y-M-d H:i:s', strtotime($dataPaket['tgl_berakhir']))) {
                              echo 'Tidak Tersedia';
                           }
                           ?>
                        </span>
                     </div>
                     <p><?= $dataPaket['keterangan'] ?></p>
                     <hr>
                     <p>Kuota Pendafataran: <br><b><?php echo $dataPaket['kuota']?> orang</b></p>
                     <p>Tanggal Tersedia: <br><b><?php echo date("d M Y", strtotime($dataPaket['tgl_tersedia']));?> --
                           <?php echo date("d M Y H:i", strtotime($dataPaket['tgl_berakhir'])) ?></b></p>

                     <div class="add-to-cart chart">
                     <?php
                     if(!$cekUserBeliPaket){ ?>
                        <a href="/beli-paket/<?= $dataPaket['id_paket']; ?>" style="width: 100%;">
                           <button class="btn-xs add-to-cart-btn" style="width: 100%;">
                              Beli Paket Usaha
                           </button>
                        </a>
                     <?php } else {
                     if (sha1($dataPaket['id_paket']) == $cekBeliPaket['id_paket']) { ?>
                        <button class="btn-xs add-to-cart-btn" style="width: 100%; background-color: green">
                           Sudah diBeli!
                        </button>
                        <?php } else{ ?>
                        <a href="/beli-paket/<?= $dataPaket['id_paket']; ?>" style="width: 100%;">
                           <button class="btn-xs add-to-cart-btn" style="width: 100%;">
                              Beli Paket Usaha
                           </button>
                        </a>
                        <?php } }?>
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