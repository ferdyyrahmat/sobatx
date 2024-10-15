<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

   <title>SobatX | FreshX SuperApp</title>

   <!-- Google font -->
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

   <!-- Bootstrap -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/bootstrap.min.css" />

   <!-- Slick -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/slick.css" />
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/slick-theme.css" />
   
   <!-- image preview -->
   <link type="text/css" rel="stylesheet" href="<?= base_url()?>Assets/css/image_preview.css" />

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

<body>
   <!-- HEADER -->
   <header class="header">
      <!-- MAIN HEADER -->
      <div id="header">
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
                  <div class="header-search" style="text-align: center;">
                     <form>
                        <input class="input" placeholder="Search here" style="width: calc(100% - 46px); padding:0 30px">
                        <button class="search-btn" style="background-color: #FFF; color: inherit;">
                           <i class="fa-solid fa-magnifying-glass" style="padding: 0 10px;"></i>
                        </button>
                     </form>
                  </div>
                  <div class="row">
                     <div class="header-search-2" style="padding-right: 15px;padding-top: 0;position: fixed;top: 0;z-index: 9999;width: -webkit-fill-available;">
                        <div class="col-md-1 col-xs-3" style="padding-right: 0;">
                           <div class="header-logo-xs">
                              <img src="<?= base_url()?>Assets/img/logo-sobatx-new.png"
                                 style="width: auto; max-height: 50px; height: 100%; margin: 10px 0 10px 10px; border: hidden; border-radius: 100%;"
                                 alt="user_image">
                           </div>
                        </div>
                        <?php if($menu != 'mulai-usaha') {?>
                        <div class="col-md-10 col-xs-9" style="padding-left:0;">
                           <div class="header-search-2" style="text-align: center;">
                              <form id="form" action="/marketplace/product/search" method="POST">
                                 <input class="input" placeholder="Search here" name="nama_produk"
                                    style="width: calc(100% - 46px); padding:0 30px">
                                 <button class="search-btn" style="background-color: #FFF; color: inherit;">
                                    <i class="fa-solid fa-magnifying-glass" style="padding: 0 10px;"></i>
                                 </button>
                              </form>
                           </div>
                        </div>
                        <?php }?>
                     </div>
                  </div>
               </div>
               <!-- /SEARCH BAR -->

               <!-- ACCOUNT -->
               <!-- /ACCOUNT -->
            </div>
            <!-- row -->
         </div>
         <!-- container -->
      </div>
      <!-- /MAIN HEADER -->
   </header>
   <!-- /HEADER -->