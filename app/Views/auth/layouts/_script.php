<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="<?= site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= site_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= site_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?= site_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= site_url('assets/js/demo/chart-area-demo.js'); ?>"></script>
<script src="<?= site_url('assets/js/demo/chart-pie-demo.js'); ?>"></script>
<script>
   $(function() {
      <?php if (session()->has("errorss")) { ?>
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= session("errorss") ?>'
         })
      <?php } ?>

      <?php if (session()->has("success")) { ?>
         Swal.fire({
            icon: 'success',
            title: 'Great!',
            text: '<?= session("success") ?>'
         })
      <?php } ?>
   });
</script>
