<?php
session_start();
include "koneksi.php";

$tgl_sekarang = date('Y-m-d');

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

    <?php include "komponen_navbar.php"; ?>

    <?php include "komponen_hero.php"; ?>

    <?php include "komponen_stats.php";
    ?>

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
                <!-- Widget Transparansi APBDes -->
                <div class="card-widget mb-4" style="border-top: 4px solid #0f4c81;">
                    <div class="card-header bg-white border-bottom fw-bold text-primary">
                        <i class="fa-solid fa-chart-pie me-2"></i>Transparansi APBDes 2025
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2">
                            <small class="text-muted d-block" style="font-size:11px;">PENDAPATAN DESA</small>
                            <span class="fw-bold text-primary" style="font-size:15px;">Rp 2.823.392.100,68</span>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block" style="font-size:11px;">BELANJA DESA</small>
                            <span class="fw-bold text-success" style="font-size:15px;">Rp 2.450.237.707,00</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block" style="font-size:11px;">SILPA</small>
                            <span class="fw-bold text-warning" style="font-size:14px;">Rp 55.653.986,43</span>
                        </div>
                        <a href="apbdes.php" class="btn btn-sm btn-outline-primary w-100 rounded-pill" style="font-size:12px;">
                            <i class="fa-solid fa-receipt me-1"></i> Rincian Pembangunan 2025 &rarr;
                        </a>
                    </div>
                </div>

                <div class="card-widget">
                    <div class="card-header"><i class="fa-solid fa-concierge-bell me-2"></i>Layanan Mandiri</div>
                    <div class="list-layanan">
                        <a href="layanan.php"><i class="fa-solid fa-file-lines"></i> Surat Pengantar SKCK</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-lines"></i> Surat Belum Menikah</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-invoice"></i> Surat Keterangan Usaha</a>
                        <a href="layanan.php"><i class="fa-solid fa-file-signature"></i> Surat Keterangan Tidak Mampu</a>
                        <a href="pengaduan.php"><i class="fa-solid fa-person-circle-exclamation"></i> Pengaduan Masyarakat</a>
                    </div>
                </div>

                <div class="card-widget">
                    <div class="card-header"><i class="fa-solid fa-map-location-dot me-2"></i>Peta Wilayah Desa</div>
                    <div class="card-body p-0">
                        <iframe src="https://maps.app.goo.gl/SAgPrtpB3vV7NBMQA" width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Galeri Kegiatan Desa ===== -->
    <?php
    $q_keg = mysqli_query($koneksi, "SELECT * FROM kegiatan_desa WHERE aktif=1 ORDER BY tgl_tambah DESC LIMIT 8");
    if ($q_keg && mysqli_num_rows($q_keg) > 0):
    ?>
        <section class="py-5" style="background:#fff; border-top:1px solid #eee;">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="section-title mb-0">Galeri Kegiatan Desa</h2>
                    <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size:12px;">Terbaru</span>
                </div>
                <div class="row g-3">
                    <?php while ($kg = mysqli_fetch_assoc($q_keg)): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="position-relative rounded-3 overflow-hidden shadow-sm" style="padding-bottom:75%; background:#f0f0f0;" onclick="showKegModal('<?= htmlspecialchars($kg['foto'], ENT_QUOTES) ?>','<?= htmlspecialchars($kg['judul'], ENT_QUOTES) ?>','<?= htmlspecialchars($kg['caption'], ENT_QUOTES) ?>','<?= $kg['tgl_kegiatan'] ? date('d F Y', strtotime($kg['tgl_kegiatan'])) : '' ?>')" style="cursor:pointer;">
                                <img src="<?= htmlspecialchars($kg['foto']) ?>"
                                    style="position:absolute;inset:0;width:100%;height:100%;object-fit:contain;background-color:#222;transition:transform 0.3s;"
                                    onerror="this.style.display='none'"
                                    class="keg-img"
                                    alt="<?= htmlspecialchars($kg['judul']) ?>">
                                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:10px;">
                                    <div>
                                        <div class="fw-bold text-white" style="font-size:12px;line-height:1.3;"><?= htmlspecialchars($kg['judul']) ?></div>
                                        <?php if ($kg['tgl_kegiatan']): ?><small class="text-white-50" style="font-size:10px;"><i class="fa-regular fa-calendar me-1"></i><?= date('d M Y', strtotime($kg['tgl_kegiatan'])) ?></small><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

        <!-- Modal Kegiatan -->
        <div class="modal fade" id="modalKeg" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-body p-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white shadow-sm" data-bs-dismiss="modal" style="z-index:10;border-radius:50%;padding:8px;"></button>
                        <img id="kegModalImg" src="" class="w-100 rounded-top" style="max-height:500px;object-fit:contain;background-color:#111;" alt="">
                        <div class="p-4">
                            <h5 class="fw-bold mb-1" id="kegModalJudul"></h5>
                            <small class="text-muted" id="kegModalTgl"></small>
                            <p class="mt-2 text-muted" id="kegModalCaption" style="font-size:14px;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showKegModal(foto, judul, caption, tgl) {
                document.getElementById('kegModalImg').src = foto;
                document.getElementById('kegModalJudul').textContent = judul;
                document.getElementById('kegModalTgl').textContent = tgl ? '📅 ' + tgl : '';
                document.getElementById('kegModalCaption').textContent = caption;
                new bootstrap.Modal(document.getElementById('modalKeg')).show();
            }
            document.querySelectorAll('.keg-img').forEach(img => {
                img.closest('.position-relative').addEventListener('mouseenter', () => img.style.transform = 'scale(1.06)');
                img.closest('.position-relative').addEventListener('mouseleave', () => img.style.transform = 'scale(1)');
            });
        </script>
    <?php endif; ?>

    <?php include "komponen_footer.php"; ?>
</body>

</html>