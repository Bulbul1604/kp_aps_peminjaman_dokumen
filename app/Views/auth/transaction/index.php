<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Data Transaksi Dokumen<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
   <?php if (!empty(session()->getFlashdata('message'))) : ?>
      <div class="alert alert-success alert-dismissible show fade small">
         <?= session()->getFlashdata('message'); ?>
      </div>
   <?php endif; ?>
   <div class="card shadow mb-4">

      <?php if (session('role') != 'admin') : ?>
         <div class="card-header d-flex justify-content-end">
            <a href="<?= site_url('transaksi/add'); ?>" class="btn tbn-sm btn-primary">Ajukan Dokumen</a>
         </div>
      <?php endif; ?>

      <div class="card-body">
         <div class="table-responsive-lg">
            <div class="row">
               <div class="col-sm-12">
                  <table class="table table-striped table-hover" id="dataTablePeminjaman">
                     <thead>
                        <tr role="row">
                           <th>No. Transaksi</th>
                           <th>NPK</th>
                           <th>Nama</th>
                           <th>Unit Kerja</th>
                           <th>Judul Dokumen</th>
                           <th>Status</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($transactions as $transaction) : ?>
                           <tr>
                              <td><?= strtoupper($transaction->request_number) ?></td>
                              <td><?= $transaction->username ?></td>
                              <td><?= ucwords($transaction->name) ?></td>
                              <td><?= ucwords($transaction->work_unit) ?></td>
                              <td>
                                 <?php if ($transaction->title_file) : ?>
                                    <?= ucwords($transaction->title_file) ?>
                                 <?php else : ?>
                                    <strong>-</strong>
                                 <?php endif; ?>
                              </td>
                              <td><small class="font-weight-bold"><?= ucwords($transaction->status) ?></small></td>
                              <td class="d-flex">
                                 <a href="<?= site_url('transaksi/show/' . $transaction->request_number); ?>" class="badge bg-info btn-info p-2 mx-1"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail</a>
                              </td>
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
      $('#dataTablePeminjaman').DataTable({
         pagingType: 'numbers',
         order: [
            [5, 'asc']
         ],
      });
   });
</script>
<?= $this->endSection() ?>
