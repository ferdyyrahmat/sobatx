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
      <div id="header">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- SEARCH BAR -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="header-search-2"
                        style="padding-right: 15px;padding-top: 0;position: fixed;top: 0;z-index: 9999;width: -webkit-fill-available;">
                        <div class="col-md-2 col-xs-2" style="padding-right: 0; margin: 20px 0; text-align: center;">
                           <a href="#">
                              <p style="color: #fff; font-size: 18px;margin: 0;"><i class="fa-solid fa-arrow-left" style=""></i></p>
                           </a>
                        </div>
                        <div class="col-md-10 col-xs-10" style="padding-left:0; margin: 20px 0; ">
                           <p style="color: #fff; font-size: 18px; margin: 0;"><b><?= $page;?></b></p>
                        </div>
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