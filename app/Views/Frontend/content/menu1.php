<!-- SECTION -->
<div class="section" style="padding: 15px 15px 0 15px;">
   <!-- container -->
   <div class="container">
      <h3>Menu</h3>
      <div class="menu-nav" style="padding-top: 10px;">
         <?php 
         if (!$cekBeliPaket) { ?>
         <div class="menu-nav__container">
            <a href="/peternak/m/mulai-usaha" class="menu-nav__link">
               <i class="fa-solid fa-warehouse menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Mulai Usaha Yuk</span>
         </div>
         <div class="menu-nav__container">
            <a href="#" class="menu-nav__link">
               <i class="fa-solid fa-people-group menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Tentang Kami</span>
         </div>
         <div class="menu-nav__container">
            <a href="#" class="menu-nav__link">
               <i class="fa-solid fa-cart-shopping menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Belanja Yuk</span>
         </div>
         <div class="menu-nav__container">
            <a href="#" class="menu-nav__link">
               <i class="fa-solid fa-people-roof menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Komunitas</span>
         </div>
         <?php } else{ ?>
         <div class="menu-nav__container">
            <a href="/peternak/marketplace" class="menu-nav__link">
               <i class="fa-solid fa-cart-shopping menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Belanja Yuk</span>
         </div>
         <div class="menu-nav__container">
            <a href="/marketplace/pesanan-saya/<?= sha1($profile['id_user'])?>" class="menu-nav__link">
               <i class="fa-solid fa-box menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Pesanan Saya</span>
         </div>
         <div class="menu-nav__container">
            <a href="/peternak/m/mulai-usaha" class="menu-nav__link">
               <i class="fa-solid fa-warehouse menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Mulai Usaha Yuk</span>
         </div>
         <div class="menu-nav__container">
            <a href="/peternak/pengajuan/" class="menu-nav__link">
               <i class="fa-solid fa-file-circle-check menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Status Pengajuan</span>
         </div>
         <!-- <div class="menu-nav__container">
            <a href="/peternak/pelatihan" class="menu-nav__link">
               <i class="fa-solid fa-chalkboard-user menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Mulai Pelatihan</span>
         </div> -->
         <?php 
         if($cekToko != 0){ ?>
         <div class="menu-nav__container">
            <a href="/peternak/produk-s" class="menu-nav__link">
               <i class="fa-solid fa-boxes-stacked menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Produk Saya</span>
         </div>
         <?php } ?>
         <div class="menu-nav__container">
            <a href="/peternak/toko-s" class="menu-nav__link">
               <i class="fa-solid fa-shop menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Toko Saya</span>
         </div>
         <?php }
         ?>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->