<style>
   .add-button {
      z-index: 999999;
      position: fixed;
      bottom: 20px;
      left: 0;
      width: 100%;
      height: 100%;
      max-height: 70px;
      display: flex;
      overflow-x: auto;
      justify-content: center;
      border: 0;
   }

   .product-details .add-to-cart .add-to-cart-btn {
      border-radius: 0;
      background-color: #FD873F;
   }
</style>
<!-- SECTION -->
<div class="section" style="padding: 15px 3px 20vb 3px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Produk Saya</h4>
      <div class="row">
         <div class="product-details">
            <?php 
            foreach($dataProduk as $data)
            {
            ?>
            <div class="col-xs-6 col-sm-3 col-md-3" style="padding: 3px;">
               <!-- Content here! -->
               <a href="/peternak/produk-s/edit/<?= sha1($data['id_produk'])?>">
                  <div class="thumbnail img-responsive" style="min-width: 150px; width: 100%; min-height: 200px; height:100%; margin-bottom: 3px;">
                     <img src="<?= base_url()?>Assets/img/toko/produk/<?= $data['nm_foto']; ?>" alt="..." style="border: 1px solid grey; border-radius: 5px; width: -webkit-fill-available; height:160px; object-fit: cover;">
                     <div class="caption" style="padding: 0">
                        <span style="font-size: 10px;"><?= $data['nama_produk']; ?></span>
                        <br/>
                        <h6 style="margin: 3px 0; color: #138738;">Rp<?= $data['harga']; ?></h6>
                     </div>
                  </div>
               </a>
            </div>
            <?php  } ?>
            <!-- <p style="text-align: center;"><a href="#" class="btn btn-success"> Selesaikan Pelatihan </a></p> -->
            <div class="add-to-cart add-button">
               <a href='/peternak/produk-s/add' style="">
                  <button class="btn-xs add-to-cart-btn" style="border-radius: 20px;">
                     Tambah Produk
                  </button>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->