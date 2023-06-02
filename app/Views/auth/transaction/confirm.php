<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Data Transaksi<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Data Transaksi - <?= $transaction->request_number ?></h6>
            </div>
            <div class="card-body">
               <?php if (!empty(session()->getFlashdata('errors'))) : ?>
                  <div class="alert alert-danger" role="alert">
                     <?= session()->getFlashdata('errors'); ?>
                  </div>
               <?php endif; ?>
               <form action="<?= site_url('transaksi/update/' . $transaction->request_number); ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="doc_id" value="<?= $transaction->doc_id ?>">
                  <input type="hidden" name="type" value="<?= $transaction->type ?>">
                  <div class="mb-3">
                     <label for="title_file" class="form-label">Judul Dokumen <?= ucwords($transaction->type) ?></label>
                     <input type="text" class="form-control" required name="title_file" id="title_file" value="<?= old('title_file') ?>">
                  </div>
                  <?php if ($transaction->type == 'permintaan') : ?>
                     <div class="mb-3">
                        <label for="document" class="form-label">Upload Dokumen Permintaan</label>
                        <input type="file" class="form-control" required name="document" id="document">
                     </div>
                  <?php endif; ?>
                  <div class="text-end">
                     <button type="submit" class="btn btn-sm bg-pri text-white px-4">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>
