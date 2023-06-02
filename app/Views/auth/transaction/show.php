<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Data Transaksi Dokumen<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Detail Data Transaksi Dokumen - <?= $transaction->request_number ?></h6>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                  <?php foreach ($datas as $key => $data) : ?>
                     <tr>
                        <th class="col-3"><?= ucwords($tables[$key]) ?></th>
                        <td><?= ucwords($transaction->$data) ?></td>
                     </tr>
                  <?php endforeach; ?>
                  <?php if ($transaction->type == 'permintaan') : ?>
                     <tr>
                        <th class="col-4">Tanggal Permintaan</th>
                        <td><?= date('d F Y', strtotime($transaction->request_date)) ?></td>
                     </tr>
                  <?php endif; ?>
                  <?php if ($transaction->type == 'peminjaman') : ?>
                     <tr>
                        <th class="col-4">Tanggal Peminjaman</th>
                        <td><?= date('d F Y', strtotime($transaction->borrow_date)) ?></td>
                     </tr>
                     <tr>
                        <th class="col-4">Tanggal Pengembalian</th>
                        <td><?= date('d F Y', strtotime($transaction->return_date)) ?></td>
                     </tr>
                  <?php endif; ?>
                  <tr>
                     <th class="col-4">Dokumen <?= ucwords($transaction->type) ?></th>
                     <td><a href="<?= base_url('dokumen/permintaan/' . $transaction->document); ?>" target="_blank">Unduh Dokumen</a></td>
                  </tr>
                  <?php if ($transaction->type == 'permintaan' && $transaction->title_file) : ?>
                     <tr>
                        <th class="col-3">Judul Dokumen Permintaan</th>
                        <td><?= ucwords($transaction->title_file) ?></td>
                     </tr>
                     <tr>
                        <th class="col-3">Dokumen Permintaan</th>
                        <td><a href="<?= base_url('dokumen/sukses/' . $transaction->request_file); ?>" target="_blank">Unduh Dokumen Permintaan</a></td>
                     </tr>
                  <?php endif; ?>
                  <?php if ($transaction->type == 'peminjaman' && $transaction->title_file) : ?>
                     <tr>
                        <th class="col-3">Judul Dokumen Peminjaman</th>
                        <td><?= ucwords($transaction->title_file) ?></td>
                     </tr>
                     <tr>
                        <th class="col-3">Keterangan</th>
                        <td>Dokumen Peminjaman Dapat Diambil Di Departemen Administrasi Koorporasi.</td>
                     </tr>
                  <?php endif; ?>
                  <?php if ($transaction->type == 'permintaan' || $transaction->type == 'peminjaman') : ?>
                     <?php if ($transaction->status == 'peminjaman' || $transaction->status == 'selesai') : ?>
                        <tr>
                           <th class="col-3">Berita Acara</th>
                           <td><a href="<?= base_url('transaksi/print/' . $transaction->request_number); ?>" target="_blank">Unduh Berita Acara</a></td>
                        </tr>
                     <?php endif; ?>
                  <?php endif; ?>
               </table>
            </div>
            <?php if ($transaction->status == 'proses' && session('role') == "admin") : ?>
               <div class="card-footer text-right">
                  <a href="<?= site_url('transaksi/edit/' . $transaction->request_number); ?>" class="btn btn-sm bg-pri text-white">Konfirmasi Permintaan</a>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>
