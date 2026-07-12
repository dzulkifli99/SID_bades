<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Mandiri - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; background: #f4f6f9; color: #333; margin: 0; }

        /* ── Hero Layanan dengan Foto Desa ── */
        .layanan-hero {
            position: relative;
            min-height: 320px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .layanan-hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://assets.promediateknologi.id/crop/0x0:0x0/1200x0/webp/photo/p1/882/2023/09/03/WhatsApp-Image-2023-09-03-at-194902-2548912262.jpeg');
            background-size: cover;
            background-position: center;
            filter: brightness(0.45);
        }
        .layanan-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 50px 20px;
            color: #fff;
        }
        .layanan-hero-content .icon-layanan {
            width: 70px; height: 70px;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.4);
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 28px; margin-bottom: 16px;
            backdrop-filter: blur(4px);
        }
        .layanan-hero-content h1 { font-size: 26px; font-weight: 800; text-shadow: 0 2px 8px rgba(0,0,0,0.5); margin-bottom: 8px; }
        .layanan-hero-content p  { font-size: 14px; opacity: 0.9; max-width: 480px; margin: 0 auto 24px; }

        .btn-hero-login {
            background: #fff; color: #0f4c81; font-weight: 700;
            border: none; padding: 10px 28px; border-radius: 25px;
            font-size: 14px; margin: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-hero-login:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.25); }
        .btn-hero-daftar {
            background: transparent; color: #fff; font-weight: 600;
            border: 2px solid rgba(255,255,255,0.7); padding: 9px 24px; border-radius: 25px;
            font-size: 14px; margin: 4px; transition: all 0.2s;
        }
        .btn-hero-daftar:hover { background: rgba(255,255,255,0.15); border-color: #fff; }

        /* ── Jenis Layanan Cards ── */
        .surat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }
        .surat-card {
            background: #fff; border-radius: 12px;
            padding: 18px 12px; text-align: center;
            border: 1.5px solid #e8edf3;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-decoration: none; color: #333;
            transition: all 0.2s; display: block;
        }
        .surat-card:hover { border-color: #0f4c81; transform: translateY(-3px); box-shadow: 0 6px 18px rgba(15,76,129,0.12); color: #0f4c81; }
        .surat-card .surat-icon {
            width: 46px; height: 46px; border-radius: 12px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 18px; margin-bottom: 10px;
        }
        .surat-card .surat-label { font-size: 12px; font-weight: 600; line-height: 1.3; }

        /* ── Feature Cards ── */
        .feature-card {
            background: #fff; border-radius: 16px;
            padding: 28px 20px; text-align: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #f0f0f0;
            height: 100%;
        }
        .feature-icon {
            width: 60px; height: 60px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 22px; margin-bottom: 16px;
        }

        /* ── Cara Penggunaan Steps ── */
        .step-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 20px; }
        .step-num {
            min-width: 36px; height: 36px; border-radius: 50%;
            background: #0f4c81; color: #fff; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        @media (max-width: 576px) {
            .layanan-hero-content h1 { font-size: 20px; }
            .surat-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include "komponen_navbar.php"; ?>

    <!-- Hero dengan foto desa asli -->
    <div class="layanan-hero">
        <div class="layanan-hero-bg"></div>
        <div class="layanan-hero-content" data-aos="fade-up">
            <div class="icon-layanan"><i class="fa-solid fa-laptop-file"></i></div>
            <h1>Layanan Mandiri Warga</h1>
            <p>Urus surat keterangan desa secara online, kapan saja &amp; di mana saja. Tidak perlu antre di Balai Desa!</p>
            <div>
                <a href="login_warga.php" class="btn-hero-login"><i class="fa-solid fa-right-to-bracket me-2"></i>Masuk Sekarang</a>
                <a href="register_warga.php" class="btn-hero-daftar"><i class="fa-solid fa-user-plus me-2"></i>Daftar Baru</a>
            </div>
        </div>
    </div>

    <!-- Jenis Surat Tersedia -->
    <div class="container my-5">
        <div class="text-center mb-4" data-aos="fade-up">
            <h4 class="fw-bold">Surat yang Tersedia</h4>
            <p class="text-muted small">Klik untuk langsung mengajukan permohonan surat</p>
        </div>
        <div class="surat-grid" data-aos="fade-up" data-aos-delay="100">
            <a href="login_warga.php" class="surat-card">
                <div class="surat-icon" style="background:#dbeafe; color:#2563eb;"><i class="fa-solid fa-id-card"></i></div>
                <div class="surat-label">Pengantar KTP</div>
            </a>
            <a href="login_warga.php" class="surat-card">
                <div class="surat-icon" style="background:#dcfce7; color:#16a34a;"><i class="fa-solid fa-users"></i></div>
                <div class="surat-label">Pengantar KK</div>
            </a>
            <a href="login_warga.php" class="surat-card">
                <div class="surat-icon" style="background:#fef9c3; color:#ca8a04;"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <div class="surat-label">Surat Tidak Mampu (SKTM)</div>
            </a>
            <a href="login_warga.php" class="surat-card">
                <div class="surat-icon" style="background:#ffe4e6; color:#e11d48;"><i class="fa-solid fa-store"></i></div>
                <div class="surat-label">Keterangan Usaha</div>
            </a>
            <a href="login_warga.php" class="surat-card">
                <div class="surat-icon" style="background:#f3e8ff; color:#9333ea;"><i class="fa-solid fa-map-marker-alt"></i></div>
                <div class="surat-label">Keterangan Domisili</div>
            </a>
        </div>
    </div>

    <!-- Keunggulan -->
    <div style="background:#fff; padding: 50px 0;">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <h4 class="fw-bold">Mengapa Layanan Mandiri?</h4>
            </div>
            <div class="row g-3">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:#dbeafe; color:#2563eb;"><i class="fa-solid fa-bolt"></i></div>
                        <h6 class="fw-bold mb-1">Cepat</h6>
                        <p class="text-muted" style="font-size:12px; margin:0;">Proses dari HP, selesai dalam hitungan menit</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="150">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:#dcfce7; color:#16a34a;"><i class="fa-solid fa-shield-halved"></i></div>
                        <h6 class="fw-bold mb-1">Aman</h6>
                        <p class="text-muted" style="font-size:12px; margin:0;">Login terenkripsi dan divalidasi NIK desa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:#fef9c3; color:#ca8a04;"><i class="fa-solid fa-file-pdf"></i></div>
                        <h6 class="fw-bold mb-1">Cetak PDF</h6>
                        <p class="text-muted" style="font-size:12px; margin:0;">Unduh &amp; cetak surat sendiri setelah disetujui</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-card">
                        <div class="feature-icon" style="background:#ffe4e6; color:#e11d48;"><i class="fa-solid fa-clock"></i></div>
                        <h6 class="fw-bold mb-1">24 Jam</h6>
                        <p class="text-muted" style="font-size:12px; margin:0;">Bisa diakses kapan saja tanpa batasan jam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cara Penggunaan -->
    <div class="container my-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <h4 class="fw-bold mb-4">Cara Mengajukan Surat</h4>
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div>
                        <div class="fw-bold">Daftar Akun</div>
                        <div class="text-muted small">Masukkan NIK Anda. Sistem akan memverifikasi apakah Anda warga Desa Bades secara otomatis.</div>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div>
                        <div class="fw-bold">Pilih Jenis Surat</div>
                        <div class="text-muted small">Pilih surat yang Anda butuhkan dan isi keperluan. Data identitas terisi otomatis dari database desa.</div>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div>
                        <div class="fw-bold">Tunggu Persetujuan</div>
                        <div class="text-muted small">Petugas desa akan memverifikasi dan menyetujui permohonan Anda.</div>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">4</div>
                    <div>
                        <div class="fw-bold">Unduh &amp; Cetak</div>
                        <div class="text-muted small">Setelah disetujui, surat digital resmi siap diunduh dalam format PDF dan langsung dicetak.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="100">
                <div class="p-4 rounded-3" style="background: linear-gradient(135deg, #0f4c81, #1a78c2);">
                    <i class="fa-solid fa-mobile-screen-button" style="font-size:80px; color:rgba(255,255,255,0.3);"></i>
                    <div class="mt-3 text-white">
                        <h5 class="fw-bold">Bisa dari HP Anda!</h5>
                        <p style="font-size:13px; opacity:0.85; margin:0;">Layanan ini dioptimalkan untuk perangkat mobile. Warga cukup menggunakan smartphone untuk mengurus semua keperluan surat keterangan.</p>
                    </div>
                    <div class="mt-4">
                        <a href="login_warga.php" class="btn btn-light fw-bold rounded-pill px-4">
                            <i class="fa-solid fa-right-to-bracket me-2"></i> Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true });</script>
</body>
</html>
