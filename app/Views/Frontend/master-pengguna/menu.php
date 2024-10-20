<!-- SECTION -->
<div class="section" style="padding: 15px 15px 0 15px;">
   <!-- container -->
   <div class="container">
      <h3>Menu</h3>
      <div class="menu-nav" style="padding-top: 10px;">
         <div class="menu-nav__container">
            <a href="/user/marketplace" class="menu-nav__link">
               <i class="fa-solid fa-cart-shopping menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Belanja Yuk</span>
         </div>
         <div class="menu-nav__container">
            <a href="/user/status-pesanan/<?= sha1($user['id_user'])?>" class="menu-nav__link">
               <i class="fa-solid fa-timeline menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Status Pesanan</span>
         </div>
         <div class="menu-nav__container">
            <a href="#" class="menu-nav__link">
               <i class="fa-solid fa-clock-rotate-left menu-nav__icon"></i>
            </a>
            <span class="menu-nav__text">Riwayat Pesanan</span>
         </div>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->