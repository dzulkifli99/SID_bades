<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemerintahan Desa Bades</title>
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

        .page-header {
            background: #0f4c81;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include "komponen_navbar.php"; ?>
    <?php include "komponen_hero.php"; ?>

    <?php $stats_small = true;
    include "komponen_stats.php"; ?>
    <div class="container mt-5 mb-5 flex-grow-1">
        <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">Struktur Organisasi Pemerintahan Desa</h2>

        <div class="row justify-content-center mb-4">
            <div class="col-md-4 col-lg-3" data-aos="zoom-in">
                <div class="card border-0 shadow-sm rounded-0 text-center">
                    <div class="card-body p-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Kepala Desa" class="img-fluid rounded-circle mb-3 border border-3 border-primary" style="width: 120px;">
                        <h5 class="fw-bold mb-1">Bpk. Sahid, S.A.P.</h5>
                        <p class="text-muted small mb-0">Kepala Desa</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-0 text-center h-100">
                    <div class="card-body p-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140047.png" alt="Kaur Keuangan" class="img-fluid rounded-circle mb-3 border border-3 border-secondary" style="width: 100px;">
                        <h6 class="fw-bold mb-1">Ibu Umi Habibah</h6>
                        <p class="text-muted small mb-0">Kaur Keuangan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-0 text-center h-100">
                    <div class="card-body p-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Kaur Perencanaan" class="img-fluid rounded-circle mb-3 border border-3 border-secondary" style="width: 100px;">
                        <h6 class="fw-bold mb-1">Bpk. Choirul Fahmi</h6>
                        <p class="text-muted small mb-0">Kaur Perencanaan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-0 text-center h-100">
                    <div class="card-body p-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Kasun Tabon" class="img-fluid rounded-circle mb-3 border border-3 border-secondary" style="width: 100px;">
                        <h6 class="fw-bold mb-1">Moh. Irfan Maulana</h6>
                        <p class="text-muted small mb-0">Kepala Dusun Tabon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
</body>

</html>