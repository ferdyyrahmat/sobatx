<style>
   .header-search-2 {
      position: relative;
      top: 0;
      z-index: 9999;
   }
</style>
<!-- SECTION -->
<div class="section" style="padding: 15px 15px 20vb 15px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Mulai Usaha</h4>
      <div class="row">
         <?php
            foreach ($dataPaket as $data) { ?>
         <div class="col-xs-12 col-sm-6 col-md-4">
            <!-- Content here! -->
            <div class="thumbnail">
               <img src="<?= base_url().'/Assets/img/paket_usaha/'.$data['foto_paket'];?>" alt="..."
                  style="width: -webkit-fill-available;">
               <div class="caption">
                  <h4><?php echo $data['nama_paket']?></h4>
                  <p><?php echo $data['keterangan']?></p>
                  <p><i class="fa-solid fa-user-tag"></i> <b><?php echo $data['kuota']?> orang</b></p>
                  <h4><b>Rp <?php echo $money_number = number_format($data['harga'],0,',','.')?></b></h4>
                  <p><i class="fa-solid fa-calendar-week"></i> <b><?php echo date("Y-M-d", strtotime($data['tgl_tersedia']));?> -
                  <?php echo $data['tgl_berakhir'] ?></b></p>
                  <br />
                  <a href="/peternak/detail-paket/<?php echo sha1($data['id_paket']);?>" class="btn btn-warning btn-xs" role="button">Selengkapnya</a>
               </div>
            </div>
         </div>
         <?php   }
         ?>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->