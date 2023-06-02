<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Data Karyawan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="card shadow mb-4">
      <div class="card-body">
         <div class="table-responsive-lg">
            <div class="row">
               <div class="col-sm-12">
                  <table class="table table-striped table-hover" id="dataTableKaryawan">
                     <thead>
                        <tr role="row">
                           <th>NPK</th>
                           <th>Nama Lengkap</th>
                           <th>Unit Kerja</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($employees as $employee) : ?>
                           <tr>
                              <td><?= $employee->username ?></td>
                              <td><?= ucwords($employee->name) ?></td>
                              <td><?= ucwords($employee->work_unit) ?></td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
   $(document).ready(function() {
      $('#dataTableKaryawan').DataTable({
         pagingType: 'numbers',
      });
   });
</script>
<?= $this->endSection() ?>
