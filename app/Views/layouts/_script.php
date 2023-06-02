<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="<?= site_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
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
