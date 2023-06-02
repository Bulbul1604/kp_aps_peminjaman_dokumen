<!DOCTYPE html>
<html lang="en">

<head>
   <?= $this->include('auth/layouts/_head.php') ?>
</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Sidebar -->
      <?= $this->include('auth/layouts/_sidebar.php') ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Topbar -->
            <?= $this->include('auth/layouts/_navbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

               <!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h4 mb-0 text-gray-800">
                     <?= $this->renderSection('title') ?>
                  </h1>
               </div>

               <?= $this->renderSection('content') ?>

            </div>
            <!-- /.container-fluid -->

         </div>
         <!-- End of Main Content -->

      </div>
      <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>


   <?= $this->include('auth/layouts/_script.php') ?>
   <?= $this->renderSection('script') ?>
</body>

</html>
