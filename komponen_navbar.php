<style>
/* ══ Navbar SID ══ */
.navbar-sid {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 1030;
}
.navbar-sid .navbar-brand { padding: 8px 0; }
.navbar-sid .navbar-brand img { height: 44px; }
.navbar-sid .brand-name { font-size: 15px; font-weight: 800; color: #0f4c81; margin: 0; line-height: 1.1; }
.navbar-sid .brand-sub  { font-size: 10px; color: #888; margin: 0; }
.navbar-sid .nav-link {
    font-size: 13px; font-weight: 600; color: #444;
    padding: 8px 12px; position: relative;
    transition: color 0.2s;
}
.navbar-sid .nav-link:hover,
.navbar-sid .nav-link.active { color: #0f4c81; }
.navbar-sid .nav-link::after {
    content: ''; position: absolute;
    bottom: 4px; left: 12px;
    width: 0; height: 2px;
    background: #0f4c81; transition: width 0.25s;
}
.navbar-sid .nav-link:hover::after,
.navbar-sid .nav-link.active::after { width: calc(100% - 24px); }

/* Dropdown */
.navbar-sid .dropdown-menu {
    border: none; border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    min-width: 180px; margin-top: 4px;
}
.navbar-sid .dropdown-item { font-size: 13px; font-weight: 600; color: #444; padding: 9px 16px; }
.navbar-sid .dropdown-item:hover { color: #0f4c81; background: #f0f6ff; }

/* Tombol Layanan Mandiri di Navbar */
.btn-layanan-nav {
    font-size: 12px; font-weight: 700;
    background: #0f4c81; color: #fff !important;
    border-radius: 20px; padding: 6px 16px;
    margin-left: 6px;
    transition: background 0.2s;
}
.btn-layanan-nav:hover { background: #0a3360; }
.btn-layanan-nav::after { display: none !important; }

/* Top Bar */
.topbar-public {
    background: #0f4c81;
    color: rgba(255,255,255,0.9);
    font-size: 12px;
    padding: 5px 0;
}
.topbar-public a { color: #fff; text-decoration: none; }

/* Mobile Collapse */
@media (max-width: 991px) {
    .navbar-sid .navbar-collapse { padding: 10px 0; border-top: 1px solid #eee; margin-top: 4px; }
    .navbar-sid .nav-link { padding: 10px 4px; }
    .navbar-sid .nav-link::after { display: none; }
    .btn-layanan-nav { margin: 8px 0 4px 0; display: inline-block; }
}
</style>

<!-- Top Bar - SELALU TAMPIL termasuk HP -->
<div class="topbar-public">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-1">
        <div class="d-flex gap-3 flex-wrap">
            <span><i class="fa-solid fa-phone me-1"></i> (0334) 123456</span>
            <span class="d-none d-sm-inline">|</span>
            <span class="d-none d-sm-inline"><i class="fa-solid fa-envelope me-1"></i> pemdes@bades.desa.id</span>
        </div>
        <div>
            <a href="pengaduan.php" class="me-3"><i class="fa-solid fa-comment-dots me-1"></i> Pengaduan</a>
            <a href="login.php"><i class="fa-solid fa-lock me-1"></i> Admin</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-sid">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/img/logolumajang.png" alt="Logo Desa Bades">
            <div>
                <p class="brand-name">DESA BADES</p>
                <p class="brand-sub">Kec. Pasirian &bull; Kab. Lumajang</p>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= in_array(basename($_SERVER['PHP_SELF']),['profil.php','pemerintahan.php'])?'active':'' ?>"
                       href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profil.php"><i class="fa-solid fa-landmark me-2 text-primary" style="width:16px"></i>Profil Desa</a></li>
                        <li><a class="dropdown-item" href="pemerintahan.php"><i class="fa-solid fa-users me-2 text-primary" style="width:16px"></i>Pemerintah Desa</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='umkm.php'?'active':'' ?>" href="umkm.php">Potensi UMKM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='berita.php'?'active':'' ?>" href="berita.php">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='pengaduan.php'?'active':'' ?>" href="pengaduan.php">Pengaduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-layanan-nav <?= basename($_SERVER['PHP_SELF'])=='layanan.php'?'active':'' ?>" href="layanan.php">
                        <i class="fa-solid fa-laptop-file me-1"></i> Layanan Mandiri
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>