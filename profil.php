<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Desa Bades</title>
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

        .page-header {
            background: #0f4c81;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .footer {
            background-color: #222;
            color: #ccc;
            padding: 40px 0 20px;
            font-size: 13px;
            margin-top: 50px;
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
    </style>
</head>

<body>

    <?php include "komponen_navbar.php"; ?>
    <?php include "komponen_hero.php"; ?>

    <?php $stats_small = true;
    include "komponen_stats.php"; ?>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Sejarah Desa Bades</h4>
                        <p style="line-height:1.7; text-align:justify;">Desa Bades memiliki sejarah panjang yang diwarnai oleh semangat gotong royong dan kebersamaan masyarakatnya. Awalnya, desa ini merupakan kawasan pertanian yang subur dengan aliran air yang melimpah, menjadikannya tempat bermukim yang ideal bagi pendatang dari berbagai daerah.</p>
                        <p style="line-height:1.7; text-align:justify;">Hingga kini, Desa Bades terus berkembang menjadi desa yang maju, mandiri, dan berbudaya dengan tetap mempertahankan kearifan lokal yang telah diwariskan secara turun-temurun.</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-0">
                    <div class="card-body p-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-bullseye text-primary me-2"></i>Visi & Misi</h4>
                        <h5>Visi</h5>
                        <p style="font-style: italic;">"Terwujudnya Desa Bades yang Maju, Mandiri, Sejahtera, dan Berbudaya Berlandaskan Gotong Royong."</p>
                        <h5 class="mt-4">Misi</h5>
                        <ol style="line-height: 1.7;">
                            <li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan kesehatan.</li>
                            <li>Mengoptimalkan potensi pertanian dan pariwisata untuk kesejahteraan masyarakat.</li>
                            <li>Meningkatkan tata kelola pemerintahan desa yang transparan dan akuntabel.</li>
                            <li>Membangun infrastruktur yang memadai dan ramah lingkungan.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-0">
                    <div class="card-body p-4 text-center">
                        <h5 class="border-bottom pb-2 mb-3">Kepala Desa</h5>
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Kepala Desa" class="img-fluid rounded-circle mb-3 border border-3 border-primary" style="width: 150px;">
                        <h5 class="mb-0 fw-bold">Bpk. Sahid, S.A.P.</h5>
                        <p class="text-muted small mb-0">Kepala Desa Bades</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
</body>

</html>