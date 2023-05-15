<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<header class="my-lg-0 py-lg-0 my-5 py-5">
    <div class="container my-lg-0 py-lg-0 my-5 py-5">
        <div class="row gx-5 align-items-center" style="min-height: 90vh;">
            <div class="col-lg-7">
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 fw-bold mb-3">Selamat Datang di Aplikasi <span class="display-3 pem-doc">Peminjaman Dokumen</span></h1>
                    <p class="lead fw-normal text-muted mb-5" style="font-size: 21px;">Aplikasi Peminjaman Dokumen Departemen Administrasi Koorporasi PT. Pupuk Kalimantan Timur</p>
                    <div class="d-flex flex-column flex-lg-row align-items-center gap-2 mb-5">
                        <!-- Button trigger modal peminjaman dokumen -->
                        <button type="button" class="btn text-white d-flex align-items-center gap-1 bg-pri" data-bs-toggle="modal" data-bs-target="#modalPeminjamanDokumen">
                            Ajukan Peminjaman Dokumen
                        </button>
                        <button type="button" class="btn text-white px-3 py-2 border-pri" data-bs-toggle="modal" data-bs-target="#modalCekPeminjamanDokumen">
                            Cek Peminjaman Dokumen
                        </button>
                        <!-- <a class="btn text-white px-3 py-2 border-pri" href="<?= base_url('cek-peminjaman'); ?>">Cek Peminjaman Dokumen</a> -->
                    </div>

                    <?php if (!empty(session()->getFlashdata('message'))) : ?>
                        <div class="alert alert-success alert-dismissible show fade small">
                            <?= session()->getFlashdata('message'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <img src="<?= base_url('assets/img/Files_And_Folder_Monochromatic.svg'); ?>" class="img-fluid" alt="..." style="width: 100%;">
            </div>
        </div>
    </div>
</header>
<!-- Modal peminjaman dokumen -->
<div class="modal fade" id="modalPeminjamanDokumen" tabindex="-1" aria-labelledby="modalPeminjamanDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalPeminjamanDokumenLabel">Peminjaman Dokumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <?= $validation->listErrors() ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('/'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="no_permintaan" class="form-label">Nomor Permintaan</label>
                            <input type="text" class="form-control" name="no_permintaan" id="no_permintaan" placeholder="1234567890">
                        </div>
                        <div class="mb-3">
                            <label for="npk" class="form-label">NPK</label>
                            <input type="text" class="form-control" name="npk" id="npk" placeholder="1234567890">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Jhon Doe">
                        </div>
                        <div class="mb-3">
                            <label for="unit_kerja" class="form-label">Unit Kerja</label>
                            <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="Dept. Administrasi Koorporasi">
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Permintaan/Piminjaman</label>
                            <select name="jenis" id="jenis" class="form-select">
                                <option>Pilih salah satu</option>
                                <option value="permintaan">Permintaan</option>
                                <option value="peminjaman">Peminjaman</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_permintaan" class="form-label">Tanggal Permintaan</label>
                            <input type="date" class="form-control" name="tgl_permintaan" id="tgl_permintaan">
                        </div>
                        <div class="mb-3">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <textarea class="form-control" name="keperluan" id="keperluan" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_pinjam" class="form-label">Tanggal Mulai Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam">
                        </div>
                        <div class="mb-3">
                            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali">
                        </div>
                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Upload Dokumen Permintaan</label>
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

<!-- Modal cek peminjaman dokumen -->
<div class="modal fade" id="modalCekPeminjamanDokumen" tabindex="-1" aria-labelledby="modalCekPeminjamanDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalCekPeminjamanDokumenLabel">Cek Peminjaman Dokumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <?= $validation->listErrors() ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($not)) : ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <?= $not; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('cari-peminjaman'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <small class="fw-semibold">Silahkan Masukkan Nomor Permintaan Untuk Mengecek Permintaan Dokumen.</small>
                        <hr class="mb-3 mt-2" />
                        <div class="mb-3">
                            <label for="no_permintaan" class="form-label">Nomor Permintaan</label>
                            <input type="text" class="form-control" name="no_permintaan" id="no_permintaan" placeholder="1234567890">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm bg-pri text-white px-4">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
