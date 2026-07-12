<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
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

        .top-bar {
            background-color: #0f4c81;
            color: #fff;
            font-size: 13px;
            padding: 8px 0;
        }

        .top-bar a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }

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

        .news-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .badge-kat {
            font-size: 0.7rem;
            font-weight: 600;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include "komponen_navbar.php"; ?>
    <?php include "komponen_hero.php"; ?>
    <?php $stats_small = true;
    include "komponen_stats.php"; ?>

    <div class="container mt-5 mb-5 flex-grow-1">
        <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">Berita &amp; Informasi Desa</h2>

        <div class="row">
            <?php
            $q = mysqli_query($koneksi, "SELECT * FROM berita WHERE status='Publikasi' ORDER BY tgl_publikasi DESC");
            $delay = 100;
            if (mysqli_num_rows($q) > 0):
                while ($r = mysqli_fetch_assoc($q)):
                    $gambar = $r['gambar_url'] ?: 'https://via.placeholder.com/400x200';
                    $kat_colors = ['Pemerintahan' => 'primary', 'Sosial & Budaya' => 'warning', 'Infrastruktur' => 'info', 'Pariwisata' => 'success', 'Umum' => 'secondary'];
                    $kat_color = $kat_colors[$r['kategori']] ?? 'secondary';
            ?>
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <a href="detail_berita.php?id=<?= $r['id'] ?>" class="text-decoration-none">
                            <div class="card shadow-sm h-100 border-0 rounded-0 news-card">
                                <div style="position:relative; overflow:hidden;">
                                    <img src="<?= htmlspecialchars($gambar) ?>" class="card-img-top rounded-0" alt="<?= htmlspecialchars($r['judul']) ?>" style="height:200px; object-fit:cover;">
                                    <span class="badge bg-<?= $kat_color ?> badge-kat" style="position:absolute; top:10px; left:10px;"><?= htmlspecialchars($r['kategori']) ?></span>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted"><i class="fa-regular fa-calendar-alt me-1"></i><?= date('d M Y', strtotime($r['tgl_publikasi'])) ?></small>
                                    <h5 class="card-title mt-2 fw-bold text-dark" style="font-size:15px; line-height:1.4;"><?= htmlspecialchars($r['judul']) ?></h5>
                                    <p class="card-text text-muted small mt-2"><?= htmlspecialchars(substr(strip_tags($r['konten']), 0, 110)) ?>...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php $delay += 100;
                endwhile;
            else: ?>
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center text-muted py-5">Belum ada berita yang dipublikasikan.</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
</body>

</html>