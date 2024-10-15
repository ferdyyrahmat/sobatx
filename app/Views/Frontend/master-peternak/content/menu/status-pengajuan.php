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
      <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Status Pengajuan</h4>
      <div class="row">
         <?php
            foreach ($cekBeliPaket as $data) { ?>
         <div class="col-xs-12 col-sm-6 col-md-4">
            <!-- Content here! -->
            <div class="thumbnail">
               <img src="<?= base_url().'/Assets/img/paket_usaha/'.$data['foto_paket'];?>" alt="..."
                  style="width: -webkit-fill-available;">
               <div class="caption">
                  <h4><?php echo $data['nama_paket']?></h4>
                  <h4><b>Rp <?php echo $money_number = number_format($data['harga'],0,',','.')?></b></h4>
                  <p>tanggal pembelian: <br> <b><?php echo $data['tgl_pembelian']; ?></b></p>
                  status pengajuan: <br>
                  <?php if($data['status_pengajuan'] == '1'){
                     echo '<span class="btn btn-warning">Menunggu diSetujui</span>';
                  } elseif($data['status_pengajuan'] == '2'){
                     echo '<span class="btn btn-success">Disetujui</span>';
                  } else{
                     echo '<span class="btn btn-secondary">Error!</span>';
                  } ?>
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