<?php
session_start();
if (isset($_SESSION["is_login"])) {
    header("location:dashboard.php");
    exit();
}
include "koneksi.php";

$tgl_sekarang = date('Y-m-d');

// // Mengambil data dari tabel absensi dan data (disesuaikan dengan skema lama agar tidak error)
// $q_hadir = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM absensi WHERE tanggal='$tgl_sekarang' AND status='Hadir'");
// $jml_hadir = $q_hadir ? mysqli_fetch_assoc($q_hadir)['jml'] : 0;

// $q_telat = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM absensi WHERE tanggal='$tgl_sekarang' AND status='Terlambat'");
// $jml_telat = $q_telat ? mysqli_fetch_assoc($q_telat)['jml'] : 0;

// $q_alpa = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM absensi WHERE tanggal='$tgl_sekarang' AND status='Alpa'");
// $jml_alpa = $q_alpa ? mysqli_fetch_assoc($q_alpa)['jml'] : 0;

// // Nilai default/dummy
// $penduduk_laki = $jml_hadir > 0 ? $jml_hadir : 2145;
// $penduduk_perempuan = $jml_telat > 0 ? $jml_telat : 2210;
// $jumlah_kk = $jml_alpa > 0 ? $jml_alpa : 1420;
// $jumlah_dusun = 4;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Resmi Desa Bades</title>
    <meta name="description" content="Portal resmi pemerintah Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang.">
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* ── Top Bar ── */
        .top-bar {
            background-color: #0f4c81;
            /* Biru klasik */
            color: #fff;
            font-size: 13px;
            padding: 8px 0;
        }

        .top-bar a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }

        /* ── Navbar ── */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }

        .navbar-brand .brand-title {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            margin: 0;
            line-height: 1.2;
        }

        .navbar-brand .brand-subtitle {
            font-size: 12px;
            color: #666;
            margin: 0;
        }

        .nav-item .nav-link {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 15px;
            text-transform: uppercase;
        }

        .nav-item .nav-link:hover,
        .nav-item .nav-link.active {
            color: #0f4c81;
        }

        /* ── Statistik ── */
        .stats-section {
            background-color: #fff;
            padding: 30px 0;
            border-bottom: 1px solid #ddd;
        }

        .stat-box {
            text-align: center;
            padding: 15px;
            border-right: 1px solid #eee;
        }

        .stat-box:last-child {
            border-right: none;
        }

        .stat-box i {
            font-size: 32px;
            color: #0f4c81;
            margin-bottom: 10px;
        }

        .stat-box h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: #333;
        }

        .stat-box p {
            font-size: 13px;
            color: #777;
            text-transform: uppercase;
            margin: 0;
        }

        /* ── Widget Layanan & Berita ── */
        .section-title {
            border-bottom: 2px solid #0f4c81;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
            font-weight: 700;
            display: inline-block;
        }

        .main-content {
            padding: 40px 0;
        }

        .card-widget {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .card-widget .card-header {
            background: #0f4c81;
            color: #fff;
            font-weight: 600;
            font-size: 15px;
            border-radius: 4px 4px 0 0;
            padding: 10px 15px;
        }

        .list-layanan a {
            display: block;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            color: #444;
            text-decoration: none;
            font-size: 14px;
        }

        .list-layanan a:hover {
            background-color: #f9f9f9;
            color: #0f4c81;
        }

        .list-layanan a i {
            margin-right: 10px;
            color: #0f4c81;
        }

        /* ── Footer ── */
        .footer {
            background-color: #222;
            color: #ccc;
            padding: 40px 0 20px;
            font-size: 13px;
        }

        .footer h4 {
            color: #fff;
            font-size: 16px;
            margin-bottom: 20px;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }

        .footer ul {
            padding: 0;
            list-style: none;
        }

        .footer ul li {
            margin-bottom: 8px;
        }

        .footer ul li a {
            color: #ccc;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: #fff;
        }

        .footer-bottom {
            background-color: #111;
            padding: 15px 0;
            color: #888;
            font-size: 12px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stat-box {
                border-right: none;
                border-bottom: 1px solid #eee;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <!-- <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between">
            <div>
                <i class="fa-solid fa-phone me-2"></i> (0334) 123456 &nbsp;&nbsp;|&nbsp;&nbsp;
                <i class="fa-solid fa-envelope me-2"></i> pemdes@bades.desa.id
            </div>
            <div>
                <a href="login.php" style="margin-right:0;"><i class="fa-solid fa-lock me-1"></i> Login Admin</a>
            </div>
        </div>
    </div> -->

    <?php include "komponen_navbar.php"; ?>

    <?php include "komponen_hero.php"; ?>

    <?php include "komponen_stats.php"; ?>

    <!-- Main Content -->
    <section class="main-content container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="section-title">Berita Desa Terkini</h2>
                <div class="row mb-4">
                    <?php
                    $q_berita_home = mysqli_query($koneksi, "SELECT * FROM berita WHERE status='Publikasi' ORDER BY tgl_publikasi DESC LIMIT 2");
                    if ($q_berita_home && mysqli_num_rows($q_berita_home) > 0):
                        while ($rb = mysqli_fetch_assoc($q_berita_home)):
                    ?>
                            <div class="col-md-6 mb-3">
                                <a href="detail_berita.php?id=<?= $rb['id'] ?>" class="text-decoration-none">
                                    <div class="card shadow-sm h-100 border-0 rounded-0" style="transition:.2s; cursor:pointer;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform=''">
                                        <img src="<?= htmlspecialchars($rb['gambar_url']) ?>" class="card-img-top rounded-0" alt="<?= htmlspecialchars($rb['judul']) ?>" style="height:180px; object-fit:cover;">
                                        <div class="card-body">
                                            <small class="text-muted"><i class="fa-regular fa-calendar-alt me-1"></i> <?= date('d F Y', strtotime($rb['tgl_publikasi'])) ?></small>
                                            <h5 class="card-title mt-2 text-dark" style="font-size:15px; font-weight:700;"><?= htmlspecialchars($rb['judul']) ?></h5>
                                            <p class="card-text text-muted" style="font-size:13px;"><?= htmlspecialchars(substr(strip_tags($rb['konten']), 0, 100)) ?>...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                    else: ?>
                        <div class="col-12">
                            <p class="text-muted">Belum ada berita.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <a href="berita.php" class="btn btn-outline-primary btn-sm rounded-0">Lihat Semua Berita <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>

            <div class="col-lg-4" id="layanan">
                <div class="card-widget">
                    <div class="card-header"><i class="fa-solid fa-concierge-bell me-2"></i>Layanan Mandiri</div>
                    <div class="list-layanan">
                        <a href="layanan.php"><i class="fa-solid fa-file-lines"></i> Surat Pengantar KTP</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-lines"></i> Surat Pengantar KK</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-invoice"></i> Surat Keterangan Usaha</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-signature"></i> Surat Keterangan Tidak Mampu</a>
                        <a href="layanan.php"><i class="fa-solid fa-person-circle-exclamation"></i> Pengaduan Masyarakat</a>
                    </div>
                </div>

                <div class="card-widget">
                    <div class="card-header"><i class="fa-solid fa-map-location-dot me-2"></i>Peta Wilayah Desa</div>
                    <div class="card-body p-0">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.123456789012!2d113.12345678901234!3d-8.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMDcnMjQuNCJTIDExM8KwMDcnMjQuNCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "komponen_footer.php"; ?>
</body>

</html>