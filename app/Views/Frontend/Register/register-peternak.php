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
               <h3 style="color: #fff">Daftar</h3>
            </div>
         </a>
      </div>
   </div>

   <nav class="nav-register-user">
      <div class="container-register-user">
         <h3
            style="text-align: center; color: #fff; padding-bottom: 30px; position: absolute; width: -webkit-fill-available; top: 40px; left: 0;">
            Buat Akun Baru
         </h3>
         <div class="row">
            <div class="col-md-12 container-input">
               <form action="<?= base_url('/registering-account-peternak');?>" method="post">
                  <div class="form-group">
                     <label for="nama">Nama Lengkap</label>
                     <input type="text" class="form-control" id="nama" name="nama_lengkap" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group">
                     <label for="email">Email address</label>
                     <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <label for="telp">No. Hp</label>
                     <input type="tel" class="form-control" id="telp" name="no_hp" placeholder="no_hp">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Password</label>
                     <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Ulangi Password</label>
                     <input type="password" class="form-control"  name="konfirm_password" placeholder="ulangi password">
                  </div>
                  <div class="form-group" style="margin-bottom: 0; padding-top: 15px">
                     <button type="submit" class="btn btn-primary">Daftar</button>
                  </div>
                  <!-- <div class="form-group" style="margin-bottom: 0; padding-top: 15px">
                     <a href="#" class="btn btn-danger" style="border-radius: 20px; font-size: 15px;"><i class="fa-brands fa-google"></i> Daftar dengan Google</a>
                  </div> -->
                  <div class="form-group" style="margin-bottom: 0; padding-top: 15px">
                     <a href="/peternak" style="font-size: 10px;">
                        <span style="color: #fff">Sudah memiliki akun?</span>
                        <br>
                        <span style="color: #fff">Masuk disini</span>
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