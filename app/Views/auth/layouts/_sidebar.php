<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('/'); ?>">
      <div class="pem-doc text-white">Peminjaman Dokumen</div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item active">
      <a class="nav-link" href="<?= site_url('dashboard'); ?>">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Dashboard</span></a>
   </li>

   <?php if (session('role') == 'admin') : ?>
      <!-- Nav Item - Data Karyawan -->
      <li class="nav-item active">
         <a class="nav-link" href="<?= site_url('karyawan'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Karyawan</span></a>
      </li>
   <?php endif; ?>

   <li class="nav-item active">
      <a class="nav-link" href="<?= site_url('transaksi'); ?>">
         <i class="fas fa-fw fa-clipboard"></i>
         <span>Data Transaksi</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

</ul>
