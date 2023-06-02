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
                  <?php if (!session('logged_in')) : ?>
                     <!-- Button trigger modal peminjaman dokumen -->
                     <button type="button" class="btn text-white d-flex align-items-center gap-1 bg-pri" data-bs-toggle="modal" data-bs-target="#modalLogin">
                        Ajukan Peminjaman Dokumen
                     </button>
                  <?php else : ?>
                     <a href="<?= base_url('transaksi') ?>" class="btn text-white d-flex align-items-center gap-1 bg-pri">Ajukan Peminjaman Dokumen</a>
                  <?php endif; ?>
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
<?= $this->endSection() ?>
