<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

   <title>SobatX | FreshX SuperApp</title>

   <!-- Google font -->
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

   <!-- Bootstrap -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/bootstrap.min.css" />

   <!-- Slick -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/slick.css" />
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/slick-theme.css" />

   <!-- nouislider -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/nouislider.min.css" />

   <!-- Font Awesome Icon -->
   <link rel="stylesheet" href="<?= base_url()?>Assets/css/font-awesome.min.css">

   <!-- Custom stlylesheet -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/style.css" />

   <script src="https://kit.fontawesome.com/d64adf002a.js" crossorigin="anonymous"></script>

   <!-- DataTables -->
   <link href="<?= base_url()?>Assets/datatables/datatables.min.css" rel="stylesheet">

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>
<style>
   .input:focus {
      outline: none;
   }
</style>

<body>
   <!-- HEADER -->
   <header class="header">
      <!-- MAIN HEADER -->
      <div id="header" style="border-radius: 10px">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- LOGO -->
               <div class="col-md-3">
                  <div class="header-logo">
                     <a href="#" class="logo">
                        <img src="<?= base_url()?>Assets/img/logo-sobatx.png" alt=""
                           style="width: 100%; height:100%; min-height:70px; max-height:70px;">
                     </a>
                  </div>
               </div>
               <!-- /LOGO -->

               <!-- SEARCH BAR -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="header-search-2"
                        style="padding-top: 0;position: fixed;top: 0;z-index: 9999;width: -webkit-fill-available;">
                        <div class="col-md-12 col-xs-12" style="padding-left:0; padding-right: 0;">
                           <div class="header-search-2" style=" margin: 10px; padding-top:0;">
                              <form id="form" action="/marketplace/product/search" method="POST"> 
                                 <input oninput="load_produk()" class="input" name="nama_produk" id="nama_produk" placeholder="Search here"
                                    style="width: calc(100% - 46px); padding:0 10px;" <?php if($activity == 'search'){echo 'value="'.$pencarian.'"';}?>>
                                 <button type="button" class="search-btn" style="background-color: #FFF; color: inherit;"
                                    id="btn-search" onclick="load_produk()">
                                    <i class="fa-solid fa-magnifying-glass" style="padding: 0 10px;"></i>
                                 </button>
                              </form>
                           </div>
                        </div>
                        <!-- Cart -->
                        <!-- <div class="col-md-2 col-xs-4" style="padding: 10px 12vw 10px 0;">
                           <div class="header-search-2" style=" margin: 10px; padding-top:0;">
                              <div class="row">
                                 <div class="header-ctn">
                                    <div class="col-xs-6">
                                       <a href="#" id="count-fav">
                                          <i class="fa-brands fa-gratipay"></i>
                                          <?php if($jumlahDataFavorite != 0){?>
                                          <span class="qty"><?= $jumlahDataFavorite;?></span>
                                          <?php } ?>
                                       </a>
                                    </div>
                                    <div class="col-xs-6">
                                       <a href="#">
                                          <i class="fa-solid fa-cart-shopping"></i>
                                          <span class="qty">3</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div> -->
                     </div>
                  </div>
               </div>
               <!-- /SEARCH BAR -->
            </div>
            <!-- row -->
         </div>
         <!-- container -->
      </div>
      <!-- /MAIN HEADER -->
   </header>
   <!-- /HEADER -->