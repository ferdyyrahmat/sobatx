<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>SobatX | FreshX SuperApp</title>
   <link rel="shortcut icon" href="<?= base_url()?>Assets/img/favicon.png" type="image/x-icon">

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
</head>

<body>
   <div class="back-login-user">
      <div class="container-back-login">
         <a href="/" style="color: #fff">
            <div class="round-back">
               <span>
                  <i class="fa fa-angle-left"></i> back
               </span>
               <h3 style="color: #fff">Register</h3>
            </div>
         </a>
      </div>
   </div>

   <nav class="nav-login-user">
      <div class="container-login-user">
         <h3
            style="text-align: center; color: #fff; padding-bottom: 30px; position: absolute; width: -webkit-fill-available; top: 40px; left: 0;">
            Daftar Sebagai</h3>
         <div class="row">
            <div class="col-md-6 col-xs-6 user-select">
               <a href="<?= base_url('/register/peternak/'); ?>" style="color:#fff;">
                  <img src="<?= base_url()?>Assets/img/user.png" alt="..." class="img-circle"
                     style="width:12vb; height:12vb">
                  <span> Peternak </span>
               </a>
            </div>
            <div class="col-md-6 col-xs-6 user-select">
               <a href="/register/user/" style="color:#fff;">
                  <img src="<?= base_url()?>Assets/img/user.png" alt="..." class="img-circle"
                     style="width:12vb; height:12vb">
                  <span> Pengguna </span>
               </a>
            </div>
            <!-- <div class="col-md-3 col-xs-6 user-select">
               <a href="#" style="color:#fff;">
                  <img src="<?= base_url()?>Assets/img/user.png" alt="..." class="img-circle" style="width:12vb; height:12vb">
                  <span> UserApps </span>
               </a>
            </div>
            <div class="col-md-3 col-xs-6 user-select">
               <a href="#" style="color:#fff;">
                  <img src="<?= base_url()?>Assets/img/user.png" alt="..." class="img-circle" style="width:12vb; height:12vb">
                  <span> UserApps </span>
               </a>
            </div> -->
         </div>
         <!-- <div class="col-md-12" style="padding-top: 25px; text-align: center; text-align:-webkit-center">
            <a href="#">
               <button type="button" class="btn btn-warning" style="border-radius: 100px; width: 15vb;">Login</button>
            </a> 
         </div> -->
         <div class="col-md-12"
            style="padding-top: 15px; text-align: center; text-align:-webkit-center; position: fixed; bottom: 30px; left: 0; width: -webkit-fill-available;">
            <a href="/user-login" style="font-size: 10px;">
               <span style="color: #fff">sudah memiliki akun?</span>
               <br>
               <span style="color: #fff">Login</span>
            </a>
         </div>
      </div>
   </nav>

   <!-- jQuery Plugins -->
   <script src="<?= base_url()?>Assets/js/jquery.min.js"></script>
   <script src="<?= base_url()?>Assets/js/bootstrap.min.js"></script>
   <script src="<?= base_url()?>Assets/js/slick.min.js"></script>
   <script src="<?= base_url()?>Assets/js/nouislider.min.js"></script>
   <script src="<?= base_url()?>Assets/js/jquery.zoom.min.js"></script>
   <script src="<?= base_url()?>Assets/js/main.js"></script>

   <!-- Alert -->
   <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
   <script>
      const Swal2 = Swal.mixin({
         customClass: {
            input: 'form-control'
         }
      })
      const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 10000,
         timerProgressBar: true,
         didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
      })
   </script>
   <?php if (session()->getFlashdata('success')) : ?>
   <script type="text/javascript">
      $(document).ready(function () {
         Toast.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>'
         })
      });
   </script>
   <?php endif; ?>

   <?php if (session()->getFlashdata('error')) : ?>
   <script type="text/javascript">
      $(document).ready(function () {
         Swal2.fire({
            icon: 'error',
            title: 'Error!',
            html: '<?php echo $_SESSION['error']; ?>'
         })
      });
   </script>
   <?php endif; ?>

   <?php if (session()->getFlashdata('warning')) : ?>
   <script type="text/javascript">
      $(document).ready(function () {
         Toast.fire({
            icon: 'warning',
            title: 'Warning!',
            text: '<?php echo $_SESSION['warning']; ?>'
         })
      });
   </script>
   <?php endif; ?>
   <?php if (session()->getFlashdata('info')) : ?>
   <script type="text/javascript">
      $(document).ready(function () {
         Toast.fire({
            icon: 'info',
            title: 'Info!',
            text: '<?php echo $_SESSION['info']; ?>'
         })
      });
   </script>
   <?php endif; ?>
</body>

</html>