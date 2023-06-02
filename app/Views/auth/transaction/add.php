<?= $this->extend('auth/layouts/app') ?>

<?= $this->section('title') ?>Ajukan Peminjaman Dokumen<?= $this->endSection() ?>

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
               <form action="<?= site_url('transaksi/save'); ?>" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="user_id" value="<?= session('id') ?>">
                  <div class="mb-3">
                     <label for="request_number" class="form-label">Nomor Permintaan</label>
                     <input type="text" class="form-control" name="request_number" id="request_number" placeholder="Masukkan nomor permintaan" required>
                  </div>
                  <div class="mb-3">
                     <label for="npk" class="form-label">NPK</label>
                     <input type="text" class="form-control" name="npk" id="npk" value="<?= ucwords(session('username')) ?>" required readonly>
                  </div>
                  <div class="mb-3">
                     <label for="nama" class="form-label">Nama Lengkap</label>
                     <input type="text" class="form-control" name="nama" id="nama" value="<?= ucwords(session('name')) ?>" required readonly>
                  </div>
                  <div class="mb-3">
                     <label for="unit_kerja" class="form-label">Unit Kerja</label>
                     <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" value="<?= ucwords(session('work_unit')) ?>" required readonly>
                  </div>
                  <div class="mb-3">
                     <label for="type" class="form-label">Jenis Permintaan/Piminjaman</label>
                     <select name="type" id="type" class="form-control" onchange="typeChange(this);">
                        <option>Pilih salah satu</option>
                        <option value="permintaan">Permintaan</option>
                        <option value="peminjaman">Peminjaman</option>
                     </select>
                  </div>
                  <div class="mb-3" id="request_date" style="display: none;">
                     <label for="request_date" class="form-label">Tanggal Permintaan</label>
                     <input type="date" class="form-control" name="request_date" id="request_date">
                  </div>
                  <div class="mb-3">
                     <label for="need" class="form-label">Keperluan</label>
                     <textarea class="form-control" name="need" id="need" rows="3"></textarea>
                  </div>
                  <div class="mb-3" id="borrow_date" style="display: none;">
                     <label for="borrow_date" class="form-label">Tanggal Mulai Pinjam</label>
                     <input type="date" class="form-control" name="borrow_date" id="borrow_date">
                  </div>
                  <div class="mb-3" id="return_date" style="display: none;">
                     <label for="return_date" class="form-label">Tanggal Kembali</label>
                     <input type="date" class="form-control" name="return_date" id="return_date">
                  </div>
                  <div class="mb-3">
                     <label for="document" class="form-label">Upload Dokumen Permintaan</label>
                     <input type="file" class="form-control" required name="document" id="document">
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

<?= $this->section('script') ?>
<script>
   function typeChange(that) {
      if (that.value == "permintaan") {
         document.getElementById("request_date").style.display = "block";
         document.getElementById("borrow_date").style.display = "none";
         document.getElementById("return_date").style.display = "none";
      } else if (that.value == "peminjaman") {
         document.getElementById("request_date").style.display = "none";
         document.getElementById("borrow_date").style.display = "block";
         document.getElementById("return_date").style.display = "block";
      } else {
         document.getElementById("request_date").style.display = "none";
         document.getElementById("borrow_date").style.display = "none";
         document.getElementById("return_date").style.display = "none";
      }
   }
</script>
<?= $this->endSection() ?>
