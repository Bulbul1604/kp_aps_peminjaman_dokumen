<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('title') ?>Data Peminjaman<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Data Peminjaman - <?= $transaction->no_permintaan ?></h6>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('peminjaman/update/' . $transaction->no_permintaan); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Upload Dokumen Permintaan/ Permohonan</label>
                            <input type="file" class="form-control" required name="dokumen" id="dokumen">
                        </div>
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
