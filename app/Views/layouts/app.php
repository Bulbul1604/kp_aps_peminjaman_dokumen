<!DOCTYPE html>
<html lang="en">

<head>
   <?= $this->include('layouts/_head') ?>
</head>

<body>

   <!-- Navbar -->
   <?= $this->include('layouts/_navbar') ?>

   <!-- Main Content -->
   <?= $this->renderSection('content') ?>

   <!-- Script -->
   <?= $this->include('layouts/_script') ?>
   <!-- Main Script -->
   <?= $this->renderSection('script') ?>
</body>

</html>
