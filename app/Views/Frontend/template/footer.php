<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
<!-- jQuery Plugins -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>Assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>Assets/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>Assets/js/slick.min.js"></script>
<script src="<?= base_url()?>Assets/js/nouislider.min.js"></script>
<script src="<?= base_url()?>Assets/js/jquery.zoom.min.js"></script>
<script src="<?= base_url()?>Assets/js/main.js"></script>
<script src="<?= base_url()?>Assets/js/image_preview.js"></script>
<script src="<?= base_url()?>Assets/datatables/datatables.min.js"></script>
<script>
   new DataTable('#example', {
      layout: {
         top2Start: '',
         top2End: '',
         topStart: '',
         topEnd: '',
         bottomStart: '',
         bottomEnd: '',
         bottom2Start: '',
         bottom2End: ''
      }
   });
</script>

<script>
    const Swal2 = Swal.mixin({
        customClass: {
            input: 'form-control'
        }
    })
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        // timer: 10000,
        // timerProgressBar: true,
        // didOpen: (toast) => {
        //     toast.addEventListener('mouseenter', Swal.stopTimer)
        //     toast.addEventListener('mouseleave', Swal.resumeTimer)
        // }
    })
    const FavToast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        // didOpen: (toast) => {
        //     toast.addEventListener('mouseenter', Swal.stopTimer)
        //     toast.addEventListener('mouseleave', Swal.resumeTimer)
        // }
    })
</script>
<?php if (session()->getFlashdata('success-add-fav')) : ?>
<script type="text/javascript">
    $(document).ready(function () {
        Toast.fire({
            icon: 'success',
            title: '<i class="bi bi-heart-fill"></i>',
            html: '<?php echo $_SESSION['success']; ?>'
        })
    });
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('success')) : ?>
<script type="text/javascript">
    $(document).ready(function () {
        Toast.fire({
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
        Toast.fire({
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
            html: '<?php echo $_SESSION['warning']; ?>'
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
            html: '<?php echo $_SESSION['info']; ?>'
        })
    });
</script>
<?php endif; ?>

</body>

</html>