<style>
   html {
      scroll-behavior: smooth;
   }

   .product-section {
      padding: 15vw 0 0 0;
   }

   .product-details .product-name {
      font-size: 15px;
   }

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

   h4 {
      margin-top: 10px;
   }

   .product-details .add-to-cart .add-to-cart-btn {
      background-color: #D10024;
      border-color: #D10024;
   }

   .product-details .add-to-cart .add-to-cart-btn i {
      color: #FFF;
   }

   .product-details .add-to-cart .add-to-cart-btn:hover {
      background-color: #FFF;
      border-color: #D10024;
   }

   .product-details .add-to-cart .add-to-cart-btn i:hover {
      color: #D10024;
   }
</style>
<style>
   #header {
      border-radius: 0 0 0 60px;
   }

   .product-section {
      padding: 14vw 0 0 0;
   }

   .header-search-2 {
      border-radius: 0;
   }

   .header-ctn>div+div {
      margin: 0;
   }

   @media only screen and (max-width: 1201px) {

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
<!-- SECTION -->
<div class="section product-section">
   <!-- container -->
   <div class="container" style="padding: 0;  padding-bottom: 60px;">
      <!-- Content title here!
      <h4><a href="/peternak/dashboard"><i class="fa-solid fa-arrow-left"></i></a>&ensp;</h4> -->
      <!-- SECTION -->
      <div class="section" style="padding-top: 0;">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- Product main img -->
               <div class="col-md-5 col-md-push-2" style="padding: 0;">
                  <div id="product-main-img">
                     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                           <?php 
                              $i=1;
                              foreach($dataFotoProduk as $data){ ?>
                           <div class="item <?php if($i==1){echo 'active';};?>">
                              <img src="<?= base_url()?>Assets/img/toko/produk/<?= $data['nm_foto']?>"
                                 alt="<?= $data['nm_foto']?>" style="width: 100%; height: 400px; object-fit: contain;">
                           </div>
                           <?php $i++; } ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                           <span class="fa-solid fa-chevron-left" aria-hidden="true"
                              style="position: absolute; top: 50%;"></span>
                           <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="next">
                           <span class="fa-solid fa-chevron-right" aria-hidden="true"
                              style="position: absolute; top: 50%;"></span>
                           <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- /Product main img -->
               <!-- Product details -->
               <div class="col-md-5">
                  <div class="product-details">
                     <div style="border-bottom: 1px solid #eee; margin-bottom: 15px;">
                        <div class="product-price" style="font-size: 20px;">
                           <small>Rp</small><b><?= $dataProduk['harga'];?></b> <del class="product-old-price"></del>
                        </div>
                        <!-- <span class="product-available">In Stock</span> -->
                     </div>
                     <div class="product-name"><?= $dataProduk['nama_produk']?></div>
                     <?php
                     foreach($dataKota as $data){
                        if($data['city_id'] == $dataProduk['id_kota']){
                           session()->set(['kota_asal_toko' => $data['city_name']]);
                        }
                     }
                     ?>
                     <small>stok: <?= $dataProduk['stok']?></small>
                     <hr style="margin-bottom: 10px;">
                     <div>
                        <b style="opacity: 80%;">Description</b>
                        <br />
                        <br />
                        <p><?= $dataProduk['deskripsi_produk']?></p>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-9" style="display: flex; align-items: center;">
                           <img class="img-responsive img-circle" style="width: 75px; height: 75px; margin-right: 10px;"
                              src="<?= base_url()?>Assets/img/toko/<?= $dataProduk['foto_toko']?>" alt="">
                           <div>
                              <span style="font-size: 18px; width: 100%;"><?= $dataProduk['nama_toko']?></span><br/>
                              <span class="review-link">( <?= session('kota_asal_toko')?> )</span>
                              <div style="width: 100%;">
                                 <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                 </div>
                                 <br />
                                 <a class="review-link" href="#">10 Review(s)</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3"
                           style="display: flex; align-items: center; justify-content: space-around;">
                           <div style="height: 75px; width: auto;">
                           </div>
                           <a href="#" class="btn btn-default" style="color: #D10024; padding: 10px 15px;">
                              <i class="fa-solid fa-store"></i>
                           </a>
                        </div>
                     </div>
                     <!-- Menu Favorite -->
                     <div class="add-to-cart chart"
                        style="left: 85%; right: 5%; width: auto; height: auto; bottom: 10%; box-shadow: unset;">
                        <form id="form-fav">
                           <input type="hidden" name="id_produk" value="<?= $dataProduk['id_produk'];?>">
                           <input type="hidden" name="id_user" value="<?= session('id')?>">
                        </form>
                        <!-- <button type="button" onclick="add_favorite()" class="btn-xs add-to-cart-btn"
                           style="width: 100%; border-radius: 50%; padding: 0;">
                           <i class="fa-solid fa-heart"
                              style="opacity: unset; visibility: visible; width: unset; height: unset; position: unset; font-size: 15px;"></i>
                        </button> -->
                     </div>
                     <!-- Menu Pesan -->
                     <div class="add-to-cart chart">
                        <!-- <a href="#" style="width: 25%;">
                           <button class="btn-xs add-to-cart-btn"
                              style="width: 100%; background-color: #ec971f; border-right: 1px solid;">
                              <span class="fa-solid fa-cart-plus" style="font-size: 20px;"></span>
                           </button>
                        </a> -->
                        <!-- <a href="#" style="width: 25%;">
                           <button class="btn-xs add-to-cart-btn"
                              style="width: 100%; background-color: #ec971f; border-right: 1px solid;">
                              <span class="fa-solid fa-comment"></span> Chat
                           </button>
                        </a> -->
                        <a href="#" style="width: 100%;">
                           <button class="btn-xs add-to-cart-btn" style="width: 100%;" data-toggle="modal"
                              data-target="#Modal_Product10">
                              Pesan Sekarang
                           </button>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- /Product details -->
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <hr />
                  <h5 style="">
                     Featured Product
                  </h5>
               </div>
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
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="menu-cat">
                     <?php foreach($dataFeaturedProduk as $data){?>
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
            <!-- /row -->
            <hr>
         </div>
         <!-- /container -->
      </div>
      <!-- /SECTION -->
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->
<div class="modal fade" id="Modal_Product10" tabindex="-1" role="dialog" aria-labelledby="Modal_Product10"
   aria-hidden="true" style="top: unset; bottom: 40%;">
   <div class="modal-dialog">
      <div class="modal-content">
         <form action="/marketplace/checkout/<?= sha1($dataProduk['id_produk'])?>" method="post">
         <div class="modal-body">
            <div class="row">
               <div class="col-md-2 col-sm-3 col-xs-3">
                  <img class="img-responsive" src="<?= base_url()?>Assets/img/toko/produk/<?= $dataProduk['nm_foto']?>"
                     alt="<?= $dataProduk['nm_foto']?>" style="border: 1px solid grey; border-radius: 10px;">
               </div>
               <div class="col-md-10 col-sm-9 col-xs-9">
                  <div class="product-price" style="font-size: 20px;">
                     <small>Rp</small><b style="color: #D10024"><?= $dataProduk['harga'];?></b>
                     <br/>
                     <small>Stok: <?= $dataProduk['stok']?></small>
                  </div>
               </div>
            </div>
            <hr/>
            <div class="row">
               <div class="col-md-9 col-sm-9 col-xs-9">
                  Jumlah
               </div>
               <div class="col-md-3 col-sm-3 col-xs-3">
                  <input type="number" name="jumlah_beli" class="form-control" value="1" maxlength = "4" min = "1" max = "9999" oninput="maxLengthCheck(this)">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-danger" style="width: 100%;">
               Beli Sekarang
            </button>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   function load_fav() {
      $.ajax({
         url: "<?php echo base_url('/marketplace/load/favorite')?>",
         success: function (data) {
            $('#count-fav').html(data)
         }
      })
   }

   function add_favorite() {
      $.ajax({
         url: "<?php echo base_url('/marketplace/product/add-favorite/').sha1($dataProduk['id_produk'])?>",
         type: "POST",
         data: $('#form-fav').serialize(),
         success: function (data) {
            FavToast.fire({
               icon: 'success',
               title: 'Favorite',
               html: '<i class="bi bi-heart-fill"></i> Item Favorite',
            });
            load_fav();
         }
      })
   }

   function maxLengthCheck(object)
   {
      if (object.value.length > object.maxLength)
         object.value = object.value.slice(0, object.maxLength)
   }
</script>