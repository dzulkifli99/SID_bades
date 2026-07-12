<?php
session_start();
include "koneksi.php";

$pesan = $tipe = "";

if (isset($_POST['kirim'])) {
    $nama = trim($_POST['nama']);
    $no_hp = trim($_POST['no_hp']);
    $kategori = $_POST['kategori'];
    $pesan_isi = trim($_POST['pesan']);
    
    if (empty($nama) || empty($pesan_isi)) {
        $pesan = "Nama dan isi pesan wajib diisi."; $tipe = "danger";
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO pengaduan (nama, no_hp, kategori, pesan) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $no_hp, $kategori, $pesan_isi);
        if (mysqli_stmt_execute($stmt)) {
            $pesan = "Terima kasih! Pengaduan Anda telah kami terima dan akan segera ditindaklanjuti oleh Pemerintah Desa Bades.";
            $tipe = "success";
        } else {
            $pesan = "Gagal mengirim pengaduan. Silakan coba lagi."; $tipe = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { font-family:'Open Sans',sans-serif; background:#f4f6f9; }
        .top-bar { background-color:#0f4c81; color:#fff; font-size:13px; padding:8px 0; }
        .top-bar a { color:#fff; text-decoration:none; margin-right:15px; }
        .navbar-custom { background-color:#ffffff; box-shadow:0 2px 4px rgba(0,0,0,0.1); padding:10px 0; }
        .navbar-brand img { height:50px; margin-right:10px; }
        .navbar-brand .brand-title { font-size:18px; font-weight:700; color:#000; margin:0; line-height:1.2; }
        .navbar-brand .brand-subtitle { font-size:12px; color:#666; margin:0; }
        .nav-item .nav-link { color:#333; font-weight:600; font-size:14px; padding:10px 15px; text-transform:uppercase; }
        .nav-item .nav-link:hover { color:#0f4c81; }
        
        .pengaduan-hero { background:linear-gradient(rgba(15,76,129,0.85),rgba(15,76,129,0.92)), url('https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1200') center/cover; color:#fff; padding:70px 0; text-align:center; }
        
        .info-box { background:#fff; border-radius:12px; padding:25px; border-left:4px solid; text-align:center; }
        .form-card { background:#fff; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.07); padding:35px; }
        .form-control, .form-select { border-radius:8px; border:1.5px solid #e2e8f0; }
        .form-control:focus, .form-select:focus { border-color:#0f4c81; box-shadow:0 0 0 3px rgba(15,76,129,0.1); }
        .btn-submit { background:#0f4c81; border:none; padding:12px 35px; border-radius:8px; font-weight:700; font-size:15px; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include "komponen_navbar.php"; ?>
    
    <div class="pengaduan-hero" data-aos="fade-in">
        <div class="container">
            <h1 class="fw-bold mb-3"><i class="fa-solid fa-comment-dots me-2"></i> Pengaduan Masyarakat</h1>
            <p class="lead mb-0 opacity-90">Sampaikan aspirasi, kritik, dan saran Anda untuk kemajuan Desa Bades.</p>
        </div>
    </div>

    <div class="container py-5 flex-grow-1">
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="info-box h-100" style="border-color:#ef4444;">
                    <div class="display-5 text-danger mb-3"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <h6 class="fw-bold">Pengaduan</h6>
                    <p class="text-muted small mb-0">Laporkan masalah infrastruktur, keamanan, atau pelayanan desa yang perlu segera ditangani.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="info-box h-100" style="border-color:#f59e0b;">
                    <div class="display-5 text-warning mb-3"><i class="fa-solid fa-thumbs-down"></i></div>
                    <h6 class="fw-bold">Kritik</h6>
                    <p class="text-muted small mb-0">Berikan kritik membangun terkait kebijakan atau pelayanan aparatur desa yang dirasa kurang tepat.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="info-box h-100" style="border-color:#22c55e;">
                    <div class="display-5 text-success mb-3"><i class="fa-solid fa-lightbulb"></i></div>
                    <h6 class="fw-bold">Saran</h6>
                    <p class="text-muted small mb-0">Berikan ide-ide segar dan gagasan inovatif untuk meningkatkan kualitas pelayanan dan pembangunan desa.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="form-card">
                    <h4 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-envelope-open-text me-2 text-primary"></i> Formulir Pengaduan</h4>
                    
                    <?php if($pesan): ?>
                    <div class="alert alert-<?= $tipe ?> alert-dismissible fade show">
                        <i class="fa-solid <?= $tipe=='success'?'fa-circle-check':'fa-circle-exclamation' ?> me-2"></i>
                        <?= $pesan ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">No. HP (opsional)</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Jenis Laporan</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kat1" value="Pengaduan" checked>
                                        <label class="form-check-label" for="kat1"><span class="text-danger fw-bold">Pengaduan</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kat2" value="Kritik">
                                        <label class="form-check-label" for="kat2"><span class="text-warning fw-bold">Kritik</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="kat3" value="Saran">
                                        <label class="form-check-label" for="kat3"><span class="text-success fw-bold">Saran</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Isi Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" class="form-control" rows="5" placeholder="Tuliskan pengaduan, kritik, atau saran Anda secara jelas dan sopan..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="kirim" class="btn btn-submit text-white w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Kirim Laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration:700, once:true });</script>
</body>
</html>
