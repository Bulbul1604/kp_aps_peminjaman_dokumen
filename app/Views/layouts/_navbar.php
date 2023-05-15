<nav class="navbar navbar-expand-lg navbar-light shadow-sm" id="mainNav">
    <div class="container">
        <a class="navbar-brand fs-3 fw-bold pem-doc" href="<?= base_url(); ?>">Peminjaman Dokumen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item">
                    <?php if (!session('logged_in')) : ?>
                        <!-- Button trigger modal login -->
                        <button type="button" class="btn btn-sm text-white d-flex align-items-center gap-1 bg-pri" data-bs-toggle="modal" data-bs-target="#modalLogin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="m13 16 5-4-5-4v3H4v2h9z"></path>
                                <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path>
                            </svg>
                            Login
                        </button>
                    <?php else : ?>
                        <a href="<?= base_url('dashboard') ?>" class="fw-bold text-pri"><?= ucwords(session('username')); ?></a>
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
                <h1 class="modal-title fs-5 fw-bold" id="modalLoginLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container px-5">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <p class="fw-semibold p-0 m-0">Email atau password anda salah!</p>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('login'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Jhon Doe">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="*************">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm bg-pri text-white px-4">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
