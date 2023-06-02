<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Rubah Kata Sandi<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="card shadow mb-4">
            <div class="card-body">
               <?php if (!empty(session()->getFlashdata('errors'))) : ?>
                  <div class="alert alert-danger" role="alert">
                     <?= session()->getFlashdata('errors'); ?>
                  </div>
               <?php endif; ?>
               <form action="<?= site_url('change-password/' . session('id')); ?>" method="post">
                  <?= csrf_field(); ?>
                  <div class="mb-3">
                     <label for="username" class="form-label">NPK</label>
                     <input type="text" class="form-control" required name="username" id="username" readonly value="<?= ucwords(session('username')); ?>">
                  </div>
                  <div class="mb-3">
                     <label for="name" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" required name="name" id="name" readonly value="<?= ucwords(session('name')); ?>">
                  </div>
                  <div class="mb-3">
                     <label for="work_unit" class="form-label">Unit Kerja</label>
                     <input type="text" class="form-control" required name="work_unit" id="work_unit" readonly value="<?= ucwords(session('work_unit')); ?>">
                  </div>
                  <div class="mb-3">
                     <label for="old_password" class="form-label">Kata Sandi Sekarang</label>
                     <input type="password" class="form-control" required name="old_password" id="old_password" placeholder="Masukkan kata sandi sekarang">
                  </div>
                  <div class="mb-3">
                     <label for="new_password" class="form-label">Kata Sandi Baru</label>
                     <input type="password" class="form-control" required name="new_password" id="new_password" placeholder="Masukkan kata sandi baru">
                  </div>
                  <div class="mb-3">
                     <label for="conf_new_password" class="form-label">Konfirmasi Kata Sandi Baru</label>
                     <input type="password" class="form-control" required name="conf_new_password" id="conf_new_password" placeholder="Masukkan konfirmasi kata sandi baru">
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
