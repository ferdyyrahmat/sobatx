<style>
   .carousel {
      height: 150px;
   }

   .carousel-inner {
      height: 100%;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 1px grey;
   }

   .carousel-inner .item {
      height: 100%;
   }

   #header {
      border-radius: 0 0 0 60px;
   }

   .header-ctn>div+div {
      margin: 0;
   }

   @media only screen and (max-width: 1201px) {
      .header {
         padding-bottom: 10px;
      }

      .account {
         display: block;
         padding: 15px 0;
      }

      .header-ctn {
         padding: 0;
      }

      .header-ctn .menu-toggle {
         display: inline-block;
      }

      .header-ctn li.nav-toggle {
         display: inline-block;
      }
   }

   @media only screen and (max-width: 991px) {
      .header {
         padding-bottom: 10px;
      }

      .account {
         display: block;
      }

      .header-ctn {
         padding: 0;
      }

      .header-ctn .menu-toggle {
         display: inline-block;
      }

      .header-ctn li.nav-toggle {
         display: inline-block;
      }
   }

   @media only screen and (max-width: 767px) {
      .header {
         padding-bottom: 15vw;
      }

      .account {
         display: block;
      }

      .header-ctn {
         padding: 0;
      }

      .header-ctn .menu-toggle {
         display: inline-block;
      }

      .header-ctn li.nav-toggle {
         display: inline-block;
      }
   }

   @media only screen and (max-width: 480px) {
      .header {
         padding-bottom: 20vw;
      }

      .account {
         display: block;
      }

      .header-ctn {
         padding: 0;
      }

      .header-ctn .menu-toggle {
         display: inline-block;
      }

      .header-ctn li.nav-toggle {
         display: inline-block;
      }
   }
</style>
<style>
   .thumbnail {
      margin-bottom: 0;
      border-radius: 10px;
      padding: 0;
   }

   .product {
      margin: 0;
      border-radius: 10px;
   }

   .product .product-img>img {
      height: 150px;
      width: 100%;
      padding: 5px;
      border-radius: 10px;
   }

   .product .product-body .product-rating {
      margin: 0;
   }

   .product .product-body .product-category {
      font-size: 10px;
   }

   .product .product-body .product-name {
      font-size: 12px;
   }

   .product .product-body .product-price {
      font-size: 13px;
      color: #FD873F;
   }
</style>

<!-- SECTION -->
<div class="section" style="padding: 0 0 10vb 0;">
   <!-- container -->
   <div class="container">
      <!-- Content here! -->
      <div class="row">
         <div class="col-xs-12 col-sm-6 col-md-6" style="padding-bottom: 20px;">
            <div id="myCarousel" class="carousel slide" data-ride="carousel"
               style="text-align: center; text-align: -webkit-center;">
               <!-- Carousel indicators -->
               <ol class="carousel-indicators">
                  <?php
                  $i=1;
                  foreach($dataPaket as $data){?>
                  <li data-target="#myCarousel" data-slide-to="<?= $i?>" <?php if($i == 1){echo 'class="active"';}?>>
                  </li>
                  <?php $i++; } ?>
               </ol>
               <!-- Wrapper for carousel items -->
               <div class="carousel-inner">
                  <?php
                  $i=1;
                  foreach($dataPaket as $data){?>
                  <div class="item <?php if($i==1){echo 'active';}?>">
                     <img src="<?= base_url('/Assets/img/paket_usaha/').$data['foto_paket'];?>" class="img-responsive"
                        alt="First Slide" style="height: auto; width: 100%; object-fit: contain;">
                  </div>
                  <?php $i++; }?>
               </div>
            </div>
         </div>
         <div class="col-xs-6 col-sm-3 col-md-3">
            <h5 style="padding-left: 10px;">
               Kategori
            </h5>
         </div>
         <div class="col-xs-6 col-sm-3 col-md-3" style="text-align: right;">
            <a href="#" style="padding-right: 10px;">
            </a>
         </div>
         <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="menu-nav" style="padding:0 10px;">
               <?php
               foreach($dataKategori as $data){?>
               <div class="menu-cat__container">
                  <a href="/peternak/m/mulai-usaha" class="menu-cat__link">
                     <div class="menu-cat__icon">
                        <?= $data['icon']?>
                     </div>
                  </a>
                  <span class="menu-cat__text"><?= $data['nama_kategori']?></span>
               </div>
               <?php } ?>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <h5 style="padding-left: 10px;">
               Featured Product
            </h5>
         </div>
         <div id="product-list">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <?php
                  if($activity == 'search') {?>
               <p>menampilkan "<?= $pencarian?>", <small><?= $jumlahDataProduk?> item ditemukan</small> </p>
               <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="menu-cat" style="padding:0 10px; <?php if($jumlahDataProduk <= 1) {echo 'width: 50%;';}?>">
                  <?php foreach($dataProduk as $data){?>
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
         </div>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->

<script type="text/javascript">
   function load_produk() {
      $.ajax({
         url: "<?php echo base_url('/marketplace/product/load')?>",
         type: "POST",
         data: $('#form').serialize(),
         success: function (data) {
            $('#product-list').html(data);
         }
      })
   }
</script>