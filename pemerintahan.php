<?php
session_start();
include "koneksi.php";

// Ambil data dari database berdasarkan urutan dan kategori
$q_all = mysqli_query($koneksi, "SELECT * FROM struktur_desa ORDER BY urutan ASC, id ASC");

$kategori_data = [
    'kepala_desa' => [],
    'sekretariat' => [],
    'seksi' => [],
    'kadus' => [],
    'lainnya' => []
];

if ($q_all && mysqli_num_rows($q_all) > 0) {
    while ($row = mysqli_fetch_assoc($q_all)) {
        $kat = strtolower(trim($row['kategori'] ?? ''));
        $jabatan = strtolower($row['jabatan']);
        
        if (empty($kat)) {
            if ($row['level'] == 'kepala' && strpos($jabatan, 'desa') !== false) {
                $kat = 'kepala_desa';
            } elseif (strpos($jabatan, 'kepala desa') !== false) {
                $kat = 'kepala_desa';
            } elseif (strpos($jabatan, 'sekretaris') !== false || strpos($jabatan, 'kaur') !== false || strpos($jabatan, 'kepala urusan') !== false) {
                $kat = 'sekretariat';
            } elseif (strpos($jabatan, 'kasi') !== false || strpos($jabatan, 'seksi') !== false) {
                $kat = 'seksi';
            } elseif (strpos($jabatan, 'dusun') !== false || strpos($jabatan, 'kadus') !== false || strpos($jabatan, 'kasun') !== false) {
                $kat = 'kadus';
            } else {
                $kat = 'lainnya';
            }
        }
        
        // Cek eksplisit untuk memastikan
        if (strpos($jabatan, 'kepala desa') !== false) {
            $kat = 'kepala_desa';
        }

        if ($kat === 'kepala_desa') {
            // Hanya izinkan 1 Kepala Desa untuk masuk array
            if (empty($kategori_data['kepala_desa'])) {
                $kategori_data['kepala_desa'][] = $row;
            }
        } else {
            $kategori_data[$kat][] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Pemerintahan - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .page-hero {
            background: linear-gradient(rgba(15, 76, 129, 0.88), rgba(15, 76, 129, 0.95)), url('https://images.unsplash.com/photo-1541872703-74c5e44368f9?auto=format&fit=crop&q=80') center/cover;
            color: #fff;
            padding: 60px 0;
            text-align: center;
        }

        .section-header {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .section-header h4 {
            font-size: 20px;
            font-weight: 700;
            color: #0f4c81;
            margin: 0;
            display: inline-block;
            position: relative;
        }

        .section-header h4::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #0f4c81;
        }

        /* Card Styling - Photo ID Card */
        .perangkat-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .perangkat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(15, 76, 129, 0.2);
        }

        .perangkat-card.kades-card {
            max-width: 260px;
            margin: 0 auto;
        }

        .photo-frame {
            padding: 10px;
            background: linear-gradient(145deg, #e7d3a9, #b8996a);
        }

        .photo-frame img {
            width: 100%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            display: block;
            border: 2px solid #fff;
            background: #f1f5f9;
        }

        .name-bar {
            background: rgba(15, 20, 25, 0.9);
            color: #fff;
            text-align: center;
            padding: 10px 8px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            line-height: 1.35;
        }

        .jabatan-bar {
            text-align: center;
            padding: 8px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #fff;
        }

        .jabatan-bar-kades {
            background: #0f4c81;
            font-size: 13px;
            padding: 10px;
        }

        .jabatan-bar-sekretariat {
            background: #2563eb;
        }

        .jabatan-bar-seksi {
            background: #16a34a;
        }

        .jabatan-bar-kadus {
            background: #9333ea;
        }

        .jabatan-bar-lainnya {
            background: #64748b;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include "komponen_navbar.php"; ?>

    <!-- Page Hero -->
    <div class="page-hero">
        <div class="container" data-aos="fade-down">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">Pemerintah Desa Bades</span>
            <h2 class="fw-bold mb-2"><i class="fa-solid fa-sitemap me-2"></i>Struktur Organisasi &amp; Perangkat Desa</h2>
            <p class="mb-0 opacity-90" style="font-size:15px;">Susunan Organisasi Tata Kerja (SOTK) Pemerintah Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang</p>
        </div>
    </div>

    <div class="container my-5 flex-grow-1">

        <!-- 1. KEPALA DESA -->
        <?php if (!empty($kategori_data['kepala_desa'])): ?>
            <div class="mb-5" data-aos="zoom-in">
                <div class="row justify-content-center">
                    <?php foreach ($kategori_data['kepala_desa'] as $kades): ?>
                        <div class="col-md-5 col-lg-4">
                            <div class="perangkat-card kades-card">
                                <div class="photo-frame">
                                    <img src="<?= $kades['foto'] ?: 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' ?>"
                                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4140/4140048.png'"
                                        alt="<?= htmlspecialchars($kades['nama']) ?>">
                                </div>
                                <div class="name-bar"><?= htmlspecialchars($kades['nama']) ?></div>
                                <div class="jabatan-bar jabatan-bar-kades"><?= htmlspecialchars($kades['jabatan']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 2. SEKRETARIAT DESA & KEPALA URUSAN (KAUR) -->
        <?php if (!empty($kategori_data['sekretariat'])): ?>
            <div class="mb-5" data-aos="fade-up">
                <div class="section-header">
                    <h4><i class="fa-solid fa-building-columns me-2 text-primary"></i>Sekretariat Desa &amp; Kepala Urusan (Kaur)</h4>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($kategori_data['sekretariat'] as $sek): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="perangkat-card">
                                <div class="photo-frame">
                                    <img src="<?= $sek['foto'] ?: 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' ?>"
                                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4140/4140048.png'"
                                        alt="<?= htmlspecialchars($sek['nama']) ?>">
                                </div>
                                <div class="name-bar"><?= htmlspecialchars($sek['nama']) ?></div>
                                <div class="jabatan-bar jabatan-bar-sekretariat"><?= htmlspecialchars($sek['jabatan']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 3. KEPALA SEKSI (KASI) -->
        <?php if (!empty($kategori_data['seksi'])): ?>
            <div class="mb-5" data-aos="fade-up">
                <div class="section-header">
                    <h4><i class="fa-solid fa-user-gear me-2 text-success"></i>Pelaksana Teknis / Kepala Seksi (Kasi)</h4>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($kategori_data['seksi'] as $kasi): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="perangkat-card">
                                <div class="photo-frame">
                                    <img src="<?= $kasi['foto'] ?: 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' ?>"
                                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4140/4140048.png'"
                                        alt="<?= htmlspecialchars($kasi['nama']) ?>">
                                </div>
                                <div class="name-bar"><?= htmlspecialchars($kasi['nama']) ?></div>
                                <div class="jabatan-bar jabatan-bar-seksi"><?= htmlspecialchars($kasi['jabatan']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 4. KEPALA DUSUN (KADUS) -->
        <?php if (!empty($kategori_data['kadus'])): ?>
            <div class="mb-5" data-aos="fade-up">
                <div class="section-header">
                    <h4><i class="fa-solid fa-map-location-dot me-2 text-purple" style="color:#9333ea;"></i>Pelaksana Kewilayahan / Kepala Dusun (Kadus)</h4>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($kategori_data['kadus'] as $kadus): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="perangkat-card">
                                <div class="photo-frame">
                                    <img src="<?= $kadus['foto'] ?: 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' ?>"
                                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4140/4140048.png'"
                                        alt="<?= htmlspecialchars($kadus['nama']) ?>">
                                </div>
                                <div class="name-bar"><?= htmlspecialchars($kadus['nama']) ?></div>
                                <div class="jabatan-bar jabatan-bar-kadus"><?= htmlspecialchars($kadus['jabatan']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 5. KATEGORI LAINNYA -->
        <?php if (!empty($kategori_data['lainnya'])): ?>
            <div class="mb-5" data-aos="fade-up">
                <div class="section-header">
                    <h4><i class="fa-solid fa-users me-2 text-secondary"></i>Perangkat Desa Lainnya</h4>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($kategori_data['lainnya'] as $lain): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="perangkat-card">
                                <div class="photo-frame">
                                    <img src="<?= $lain['foto'] ?: 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' ?>"
                                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4140/4140048.png'"
                                        alt="<?= htmlspecialchars($lain['nama']) ?>">
                                </div>
                                <div class="name-bar"><?= htmlspecialchars($lain['nama']) ?></div>
                                <div class="jabatan-bar jabatan-bar-lainnya"><?= htmlspecialchars($lain['jabatan']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php include "komponen_footer.php"; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true
        });
    </script>
</body>

</html>