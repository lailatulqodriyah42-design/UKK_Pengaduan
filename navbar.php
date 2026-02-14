<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">ASPIRASI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"> 
                <?php if(!isset($_SESSION['role'])): ?>
                    <li class="nav-item"><a class="nav-link" href="?page=login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=register">Daftar</a></li>
                <?php else: ?>
                    <?php if($_SESSION['role']=="siswa"): ?>
                        <li class="nav-item"><a class="nav-link" href="?page=form">Input Aspirasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=histori">Histori</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="?page=aspirasi">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=kategori">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=siswa">Siswa</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=user_admin">Admin</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if(isset($_SESSION['role'])): ?>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3 small">Halo, <b><?= $_SESSION['user'] ?></b></span>
                    <a href="?page=logout" class="btn btn-danger btn-sm">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>