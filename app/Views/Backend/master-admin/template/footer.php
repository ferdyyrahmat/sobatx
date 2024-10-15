<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-end">
            <p>2024 &copy; Rumah Cipta Inovasi Digital</p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/components/dark.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js">
</script>


<script src="<?= base_url()?>Assets/Backend/admin/assets/compiled/js/app.js"></script>

<!-- DatePicker -->
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/date-picker.js"></script>

<!-- Parsley -->
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/parsley.js"></script>

<!-- Summernote -->
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/summernote.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/ckeditor.js"></script>

<!-- Need: Apexcharts -->
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/dashboard.js"></script>

<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url()?>Assets/Backend/admin/assets/static/js/pages/datatables.js"></script>
   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
   <script src="<?= base_url()?>Assets/Backend/admin/assets/extensions/sweetalert2/sweetalert2.min.js"></script>

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
        Toast.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo $_SESSION['error']; ?>'
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