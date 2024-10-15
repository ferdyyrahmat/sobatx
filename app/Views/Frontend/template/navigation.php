<?php 
   if($profile['akses_level'] == '1') {
      $user = '/peternak/';
   }
   elseif($profile['akses_level'] == '2'){
      $user = '/user/';
   }
?>

<nav class="nav-bottom">
   <a href="<?= $user ?>dashboard" class="nav-bottom__link">
      <i class="fa-solid fa-house nav-bottom__icon"></i>
      <span class="nav-bottom__text">Home</span>
   </a>
   <a href="<?= $user ?>tentang-kami" class="nav-bottom__link">
      <i class="fa-solid fa-phone nav-bottom__icon"></i>
      <span class="nav-bottom__text">Tentang</span>
   </a>
   <a href="<?= $user ?>pemberitahuan" class="nav-bottom__link">
      <i class="fa-solid fa-bell nav-bottom__icon"><small><span class="badge"><?= $jumlahNotif ?></span></small></i>
      <span class="nav-bottom__text">Notification</span>
   </a>
   <a href="<?= $user ?>profil" class="nav-bottom__link">
      <i class="fa-solid fa-user nav-bottom__icon"></i>
      <span class="nav-bottom__text">Profile</span>
   </a>
</nav>