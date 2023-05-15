<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('title') ?>Data Peminjaman<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <?php if (!empty(session()->getFlashdata('message'))) : ?>
        <div class="alert alert-success alert-dismissible show fade small">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive-lg">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-hover" id="dataTablePeminjaman">
                            <thead>
                                <tr role="row">
                                    <th>No. Permintaan</th>
                                    <th>NPK</th>
                                    <th>Nama</th>
                                    <th>Permintaan</th>
                                    <th>Pinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $transaction) : ?>
                                    <tr>
                                        <td><?= $transaction->no_permintaan ?></td>
                                        <td><?= $transaction->npk ?></td>
                                        <td><?= ucwords($transaction->nama) ?></td>
                                        <td><?= date("d F Y", strtotime($transaction->tgl_permintaan)) ?></td>
                                        <td><?= date("d F Y", strtotime($transaction->tgl_pinjam)) ?></td>
                                        <td>
                                            <?php if ($transaction->status == 'proses') : ?>
                                                <span class="badge bg-warning text-white">Proses</span>
                                            <?php endif; ?>
                                            <?php if ($transaction->status == 'gagal') : ?>
                                                <span class="badge bg-danger text-white">Gagal</span>
                                            <?php endif; ?>
                                            <?php if ($transaction->status == 'selesai') : ?>
                                                <span class="badge bg-success text-white">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="d-flex">
                                            <a href="<?= site_url('peminjaman/show/' . $transaction->no_permintaan); ?>" class="badge bg-info btn-info p-2 mx-1"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail</a>
                                            <a href="<?= site_url('peminjaman/print/' . $transaction->no_permintaan); ?>" class="badge bg-success btn-danger p-2"><i class="fa fa-download" aria-hidden="true"></i> Berita Acara</a>
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
        });
    });
</script>
<?= $this->endSection() ?>
