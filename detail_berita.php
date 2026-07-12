<?php
session_start();
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$q = mysqli_query($koneksi, "SELECT * FROM berita WHERE id=$id AND status='Publikasi'");

if (mysqli_num_rows($q) == 0) {
    header("Location: berita.php");
    exit();
}
$berita = mysqli_fetch_assoc($q);

// Berita terkait lainnya
$q_lain = mysqli_query($koneksi, "SELECT id, judul, gambar_url, tgl_publikasi FROM berita WHERE status='Publikasi' AND id != $id ORDER BY tgl_publikasi DESC LIMIT 4");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($berita['judul']) ?> - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { font-family:'Open Sans',sans-serif; background:#f4f6f9; color:#333; }
        .top-bar { background-color:#0f4c81; color:#fff; font-size:13px; padding:8px 0; }
        .top-bar a { color:#fff; text-decoration:none; margin-right:15px; }
        .navbar-custom { background-color:#ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1); padding:10px 0; }
        .navbar-brand img { height:50px; margin-right:10px; }
        .navbar-brand .brand-title { font-size:18px; font-weight:700; color:#000; margin:0; line-height:1.2; }
        .navbar-brand .brand-subtitle { font-size:12px; color:#666; margin:0; }
        .nav-item .nav-link { color:#333; font-weight:600; font-size:14px; padding:10px 15px; text-transform:uppercase; }
        .nav-item .nav-link:hover { color:#0f4c81; }
        
        .article-title { font-weight:800; color:#111; line-height:1.3; }
        .article-content { font-size:16px; line-height:1.9; color:#444; }
        .article-content p { margin-bottom:1.5rem; text-align:justify; }
        .featured-img { border-radius:10px; width:100%; max-height:420px; object-fit:cover; box-shadow:0 6px 20px rgba(0,0,0,0.12); }
        .sidebar-thumb { width:72px; height:58px; object-fit:cover; border-radius:6px; flex-shrink:0; }
        .article-card { background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.06); padding:30px; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between">
            <div><i class="fa-solid fa-phone me-2"></i> (0334) 123456 &nbsp;|&nbsp; <i class="fa-solid fa-envelope me-2"></i> pemdes@bades.desa.id</div>
            <div><a href="login.php"><i class="fa-solid fa-lock me-1"></i> Login Admin</a></div>
        </div>
    </div>
    <?php include "komponen_navbar.php"; ?>
    
    <div class="container py-4 pb-5 flex-grow-1">
        <div class="row g-4">
            <!-- Artikel Utama -->
            <div class="col-lg-8" data-aos="fade-up">
                <div class="article-card">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="berita.php" class="text-decoration-none">Berita</a></li>
                            <li class="breadcrumb-item active"><?= htmlspecialchars(substr($berita['judul'],0,40)) ?>...</li>
                        </ol>
                    </nav>

                    <span class="badge bg-primary mb-3"><?= htmlspecialchars($berita['kategori']) ?></span>
                    <h1 class="article-title mb-3" style="font-size:1.6rem;"><?= htmlspecialchars($berita['judul']) ?></h1>
                    
                    <div class="d-flex gap-3 mb-4 text-muted small flex-wrap">
                        <span><i class="fa-regular fa-calendar-alt me-1"></i><?= date('d F Y', strtotime($berita['tgl_publikasi'])) ?></span>
                        <span><i class="fa-regular fa-user me-1"></i><?= htmlspecialchars($berita['penulis']) ?></span>
                    </div>

                    <?php if($berita['gambar_url']): ?>
                    <img src="<?= htmlspecialchars($berita['gambar_url']) ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="featured-img mb-4">
                    <?php endif; ?>

                    <div class="article-content">
                        <?php
                        $paragraphs = explode("\n", trim($berita['konten']));
                        foreach ($paragraphs as $p) {
                            if (trim($p)) echo "<p>" . htmlspecialchars(trim($p)) . "</p>";
                        }
                        ?>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2 align-items-center">
                        <span class="small text-muted">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="fa-brands fa-facebook me-1"></i> Facebook</a>
                        <a href="https://wa.me/?text=<?= urlencode($berita['judul']." http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3"><i class="fa-brands fa-whatsapp me-1"></i> WhatsApp</a>
                        <a href="berita.php" class="btn btn-sm btn-light border rounded-pill px-3 ms-auto"><i class="fa-solid fa-arrow-left me-1"></i> Semua Berita</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 fw-bold">
                        <i class="fa-solid fa-newspaper me-2 text-primary"></i> Berita Terkini
                    </div>
                    <div class="card-body p-3">
                        <?php if(mysqli_num_rows($q_lain)>0): while($r=mysqli_fetch_assoc($q_lain)): ?>
                        <a href="detail_berita.php?id=<?= $r['id'] ?>" class="d-flex gap-3 mb-3 align-items-center text-decoration-none">
                            <img src="<?= htmlspecialchars($r['gambar_url'] ?: 'https://via.placeholder.com/72') ?>" class="sidebar-thumb" alt="">
                            <div>
                                <div class="fw-bold text-dark" style="font-size:0.85rem; line-height:1.3;"><?= htmlspecialchars(substr($r['judul'],0,65)) ?><?= strlen($r['judul'])>65?'...':'' ?></div>
                                <small class="text-muted"><?= date('d M Y', strtotime($r['tgl_publikasi'])) ?></small>
                            </div>
                        </a>
                        <?php endwhile; else: ?>
                        <p class="text-muted small">Tidak ada berita lain.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="background:linear-gradient(135deg,#0f4c81,#1a78c2); color:#fff;">
                    <div class="card-body p-3 text-center">
                        <i class="fa-solid fa-comment-dots fa-2x mb-2 opacity-75"></i>
                        <h6 class="fw-bold">Ada Keluhan atau Saran?</h6>
                        <p class="small opacity-75 mb-3">Sampaikan langsung ke Pemerintah Desa Bades melalui fitur Pengaduan.</p>
                        <a href="pengaduan.php" class="btn btn-light btn-sm rounded-pill px-4 fw-bold text-primary">Buka Pengaduan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration:700, once:true});</script>
</body>
</html>
