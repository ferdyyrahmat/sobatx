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
</head>

<body>
   <div class="back-login-user">
      <div class="container-back-login">
         <a href="/" style="color: #fff">
            <div class="round-back">
               <span>
                  <i class="fa fa-angle-left"></i> back
               </span>
               <h3 style="color: #fff">Login</h3>
            </div>
         </a>
      </div>
   </div>

   <nav class="nav-login-user" style="background-color: #5086AB;">
      <div class="container-login-user">
         <div class="row">
            <div class="col-md-12"
               style="text-align: center; color: #fff; padding-bottom: 30px; position: absolute; width: -webkit-fill-available; top: 3vb; left: 0;">
               <a href="<?= base_url('/login-peternak'); ?>"
                  style="color:#fff; width: -webkit-fill-available; left: 0; top:8vb; padding-bottom: 10px;">
                  <img src="<?= base_url()?>Assets/img/user.png" alt="..." class="img-circle"
                     style="width:12vb; height:12vb; background: #fff; outline: solid;">
               </a>

               <!-- <h2 style="color: #fff; padding-top: 10px;">Masuk</h2> -->
               <!-- <p><span style="padding: 20px 0;">Masuk Sebagai Peternak</span></p> -->
               <h5 style="color: #fff; padding-top: 10px; font-weight: 500;">Masuk Sebagai Peternak</h5>
            </div>
            <div class="col-md-12 container-input" style="margin-top: 2vb;
               padding-top: 9vb;
               align-self: center;
               position: absolute;
               top: 22vb;
               bottom: 20vb;
               left: 50px;
               right: 50px;
               width: -webkit-fill-available;">
               <form action="<?= base_url('/peternak/login-auth');?>" method="post">
                  <div class="form-group">
                     <label for="email">Email address</label>
                     <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                        style="background: #2E3F42;">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Password</label>
                     <input type="password" class="form-control" name="password" placeholder="Password"
                        style="background: #2E3F42;">
                  </div>
                  <div class="form-group" style="padding-top: 15px; margin-bottom: 0;">
                     <button type="submit" class="btn btn-primary" id="login">Login</button>
                  </div>
                  <div class="form-group" style="padding-top: 15px; margin-bottom: 0;">
                     <a href="<?= $link ?>" class="btn btn-danger"><i class="fa-brands fa-google"></i> Googlea</a>
                  </div>
                  <div class="form-group" style="padding-top: 15px; margin-bottom: 0;">
                     <a href="/register" style="font-size: 10px;">
                        <span style="color: #fff">belum memiliki akun?</span>
                        <br>
                        <span style="color: #fff">Daftar</span>
                     </a>
                  </div>
               </form>
            </div>
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
         Swal2.fire({
            icon: 'success',
            title: 'Success!',
            html: '<?php echo $_SESSION['success']; ?>'
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
         Swal2.fire({
            icon: 'warning',
            title: 'Warning!',
            html: '<?php echo $_SESSION['warning']; ?>'
         })
      });
   </script>
   <?php endif; ?>
   <?php if (session()->getFlashdata('info')) : ?>
   <script type="text/javascript">
      $(document).ready(function () {
         Swal2.fire({
            icon: 'info',
            title: 'Info!',
            html: '<?php echo $_SESSION['info']; ?>'
         })
      });
   </script>
   <?php endif; ?>
   
</body>

</html>