<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<section class="container">
    <div class="card border-0 shadow-sm mb-5 mt-3">
        <div class="card-body">
            <h2 class="py-2 mb-4 d-inline-block fw-bold text-pri border-bottom border-danger"" style=" font-size: 18px;">Data Peminjaman Dokumen Dept. Administrasi Koorporasi</h2>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Nomor Permintaan</th>
                        <th scope="col">NPK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Unit Kerja</th>
                        <th scope="col">Status Permintaan</th>
                        <?php if ($permohonan->status == "selesai") : ?>
                            <th scope="col">Unduh</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $permohonan->no_permintaan ?></td>
                        <td><?= $permohonan->npk ?></td>
                        <td><?= ucwords($permohonan->nama) ?></td>
                        <td><?= ucwords($permohonan->unit_kerja) ?></td>
                        <td>
                            <?php if ($permohonan->status == 'proses') : ?>
                                <span class="badge bg-warning text-white">Proses</span>
                            <?php endif; ?>
                            <?php if ($permohonan->status == 'gagal') : ?>
                                <span class="badge bg-danger text-white">Gagal</span>
                            <?php endif; ?>
                            <?php if ($permohonan->status == 'selesai') : ?>
                                <span class="badge bg-success text-white">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <?php if ($permohonan->status == "selesai") : ?>
                            <td class="d-flex">
                                <a href="<?= site_url('peminjaman/print/' . $transaction->no_permintaan); ?>" class="btn btn-sm me-2 text-white bg-pri">Berita Acara</a>
                                <a href="<?= base_url('dokumen/sukses/' . $permohonan->file); ?>" target="_blank" class="btn btn-sm text-pri border-pri">Dokumen</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
