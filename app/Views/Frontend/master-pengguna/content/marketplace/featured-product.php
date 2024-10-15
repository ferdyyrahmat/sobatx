<div class="col-xs-12 col-sm-12 col-md-12">
   <?php
      if($pencarian != '') {?>
   <p>menampilkan "<?= $pencarian?>", <small><?= $jumlahDataProduk?> item ditemukan</small> </p>
   <?php } ?>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">

   <div class="menu-cat" style="padding:0 10px; <?php if($jumlahDataProduk <= 1) {echo 'width: 50%;';}?>">
      <?php
         foreach($dataProduk as $data){?>
         <div class="product">
            <a href="/marketplace/product/detail/<?= sha1($data['id_produk'])?>">
            <div class="product-img">
               <img src="<?= base_url()?>Assets/img/toko/produk/<?= $data['nm_foto']?>" alt="">
               <div class="product-label">
                  <!-- <span class="sale">-30%</span> -->
               </div>
            </div>
            <div class="product-body">
               <p class="product-category"><?= $data['nama_kategori']?></p>
               <h3 class="product-name"><a href="#"><?= $data['nama_produk']?></a></h3>
               <h4 class="product-price"><small>Rp </small><?= $data['harga']?> <del
                     class="product-old-price">$990.00</del></h4>
            </div>
         </a>
         </div>
      <?php } ?>
   </div>
</div>