<!-- NAVIGATION -->
<div id="navigation">
   <!-- container -->
   <div class="container cust-nav">
      <div class="col-12">
         <!-- responsive-nav -->
         <div class="row">
            <div class="col-md-10 col-xs-9">
               <h4 style="margin: 10px 0; color:#fff;">Halo, <?= session()->get('nama') ?></h4>

               <span style="margin: 10px 0 20px 0;" class="head-content-loc"><i class="fa-solid fa-location-dot"></i>
                  Selamat datang di SobatX!</span>
            </div>
            <div class="col-md-2 col-xs-3" style="text-align: -webkit-right; padding: 0;">
               <div class="dropdown">
                  <?php 
                  if(isset($profile['foto_user'])){
                     $checkFoto = file_exists('Assets/img/profile/'.$profile['foto_user']);
                     if($checkFoto){
                        if ($profile['foto_user'] == '' or $profile['foto_user'] == '-') {
                           $user_profile = base_url().'Assets/img/user.png';
                        }else{
                        $user_profile = base_url().'Assets/img/profile/'.$profile['foto_user'];
                        }
                     }
                     elseif(!$checkFoto){
                        $user_profile = base_url() . 'Assets/img/user.png';
                     }
                  }else{
                     $user_profile = base_url() . 'Assets/img/user.png';
                  }
                  ?>
                  <img src="<?= $user_profile ?>"
                     style="width: auto; max-height: 57px; height: 100%; margin: 10px 0 10px 10px; border-radius: 100%;"
                     id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                     <li>
                        <a href="/peternak/logout"><b>Logout</b><i class="fa-solid fa-right-from-bracket pull-right"></i></a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-10 col-xs-6">
            </div>
         </div>
         <!-- /responsive-nav -->
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /NAVIGATION -->