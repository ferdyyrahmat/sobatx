<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>SobatX | FreshX SuperApp</title>
   <link rel="shortcut icon" href="<?= base_url()?>Assets/img/favicon.ico" type="image/x-icon">

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

   <!-- Preloader -->
   <link rel="stylesheet" href="<?= base_url()?>Assets/preloader/css/fakeLoader.css">
</head>

<body>
   <div class="loader">
      <img src="<?= base_url()?>Assets/img/logo-sobatx-new.png">
   </div>
   <div class="login-background">
      <div class="login-logo">
         <img src="<?= base_url()?>Assets/img/logo-sobatx-new.png">
      </div>
      <div class="login-logo__text">
         <h2>SobatX App</h2>
         <span>Mulai Sekarang</span>
      </div>
   </div>
   <nav class="nav-login">
         <div class="container-login">
            <div class="row">
               <div class="col-md-12" style="padding-bottom: 10px;">
                  <a href="/user-login">
                     <button type="button" class="btn btn-warning btn-lg btn-block">Login</button>
                  </a>
               </div>
               <div class="col-md-12" style="padding-top: 10px;">
                  <a href="/register">
                     <button type="button" class="btn btn-info btn-lg btn-block">Register</button>
                  </a>
               </div>
            </div>
         </div>
      </nav>


   <script src="<?= base_url()?>Assets/preloader/js/fakeLoader.js" charset="utf-8"></script>
   <!-- jQuery Plugins -->
   <script src="<?= base_url()?>Assets/js/jquery.min.js"></script>
   <script src="<?= base_url()?>Assets/js/bootstrap.min.js"></script>
   <script src="<?= base_url()?>Assets/js/slick.min.js"></script>
   <script src="<?= base_url()?>Assets/js/nouislider.min.js"></script>
   <script src="<?= base_url()?>Assets/js/jquery.zoom.min.js"></script>
   <script src="<?= base_url()?>Assets/js/main.js"></script>
</body>

</html>