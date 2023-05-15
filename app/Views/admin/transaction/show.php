<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('title') ?>Data Peminjaman<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Data Peminjaman - <?= $transaction->no_permintaan ?></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <?php foreach ($tables as $table) : ?>
                            <tr>
                                <th class="col-3"><?= ucwords($table) ?></th>
                                <td><?= ucwords($transaction->$table) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th class="col-4">Dokumen</th>
                            <td><a href="<?= base_url('dokumen/permintaan/' . $transaction->dokumen); ?>" target="_blank">Unduh Dokumen</a></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="<?= site_url('peminjaman/edit/' . $transaction->no_permintaan); ?>" class="btn btn-sm bg-pri text-white">Konfirmasi Permintaan</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
