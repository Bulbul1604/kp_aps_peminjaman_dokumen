<nav class="navbar navbar-expand-lg navbar-light shadow-sm" id="mainNav">
   <div class="container">
      <a class="navbar-brand fs-3 fw-bold pem-doc" href="<?= base_url(); ?>">Peminjaman Dokumen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         Menu
         <i class="bi-list"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
            <li class="nav-item d-flex gap-2">
               <?php if (!session('logged_in')) : ?>
                  <!-- Button trigger modal login -->
                  <button type="button" class="btn btn-sm text-white d-flex align-items-center gap-1 bg-pri" data-bs-toggle="modal" data-bs-target="#modalLogin">
                     Masuk
                  </button>
                  <!-- Button trigger modal register -->
                  <button type="button" class="btn btn-sm text-white d-flex align-items-center gap-1 border-pri" data-bs-toggle="modal" data-bs-target="#modalRegister">
                     Daftar
                  </button>
               <?php else : ?>
                  <a href="<?= base_url('dashboard') ?>" class="fw-bold text-pri"><?= ucwords(session('name')); ?></a>
               <?php endif; ?>
            </li>
         </ul>
      </div>
   </div>
</nav>

<!-- Modal login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="modalLoginLabel">Masuk</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container px-5">
               <?php if (!empty(session()->getFlashdata('error'))) : ?>
                  <div class="alert alert-danger" role="alert">
                     <p class="fw-semibold p-0 m-0">NPK atau kata sandi anda salah!</p>
                  </div>
               <?php endif; ?>
               <form action="<?= site_url('login'); ?>" method="post">
                  <?= csrf_field(); ?>
                  <div class="mb-3">
                     <label for="username" class="form-label">NPK</label>
                     <input type="text" class="form-control" name="username" id="username" value="<?= old('username') ?>" placeholder="Masukkan NPK">
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Kata Sandi</label>
                     <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi">
                  </div>
                  <div class="text-end">
                     <button type="submit" class="btn btn-sm bg-pri text-white px-4">Masuk</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal register -->
<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold" id="modalRegisterLabel">Daftar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container px-5">
               <?php if (!empty(session()->getFlashdata('errors'))) : ?>
                  <div class="alert alert-danger" role="alert">
                     <?= session()->getFlashdata('errors'); ?>
                  </div>
               <?php endif; ?>
               <form action="<?= site_url('register'); ?>" method="post">
                  <?= csrf_field(); ?>
                  <div class="mb-3">
                     <label for="username" class="form-label">NPK</label>
                     <input type="text" class="form-control" name="username" id="username" value="<?= old('username') ?>" placeholder="Masukkan NPK">
                  </div>
                  <div class="mb-3">
                     <label for="name" class="form-label">Nama Lenkap</label>
                     <input type="text" class="form-control" name="name" id="name" value="<?= old('name') ?>" placeholder="Masukkan nama lengkap">
                  </div>
                  <div class="mb-3">
                     <label for="work_unit" class="form-label">Unit Kerja</label>
                     <input type="text" class="form-control" name="work_unit" id="work_unit" value="<?= old('work_unit') ?>" placeholder="Masukkan unit kerja">
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Kata Sandi</label>
                     <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi">
                  </div>
                  <div class="mb-3">
                     <label for="password2" class="form-label">Konfirmasi Kata Sandi</label>
                     <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukkan konfirmasi kata sandi">
                  </div>
                  <div class="text-end">
                     <button type="submit" class="btn btn-sm bg-pri text-white px-4">Daftar</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
