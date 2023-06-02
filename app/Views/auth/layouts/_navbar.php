<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

   <!-- Sidebar Toggle (Topbar) -->
   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
   </button>

   <!-- Topbar Navbar -->
   <ul class="navbar-nav ml-auto">

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-inline text-gray-600 font-weight-bold small">
               <?= ucwords(session('name')); ?>
            </span>
         </a>
         <!-- Dropdown - User Information -->
         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= site_url('change-password') ?>">
               <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
               Rubah Kata Sandi
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="<?= site_url('logout'); ?>">
               <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
               Logout
            </a>
         </div>
      </li>

   </ul>

</nav>
