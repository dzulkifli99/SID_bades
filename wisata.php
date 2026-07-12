<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potensi Wisata Desa Bades</title>
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
        <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">Destinasi Wisata Unggulan</h2>

        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card shadow-sm border-0 rounded-0 h-100">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=800&auto=format&fit=crop" class="card-img-top rounded-0" alt="Pantai Dampar" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Pantai Dampar</h5>
                        <p class="card-text text-muted small">Hidden gem di pesisir selatan Lumajang. Menawarkan keunikan pasir hitam berkilau, tebing eksotis, dan danau air payau yang indah.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-0 mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card shadow-sm border-0 rounded-0 h-100">
                    <img src="https://images.unsplash.com/photo-1533604100366-51e44f80695b?q=80&w=800&auto=format&fit=crop" class="card-img-top rounded-0" alt="Tradisi Bersih Desa" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Tradisi Bersih Desa & Tarian Godril</h5>
                        <p class="card-text text-muted small">Kearifan lokal masyarakat Bades yang dirayakan rutin. Nikmati sajian budaya tradisional dan kirab hasil bumi.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-0 mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card shadow-sm border-0 rounded-0 h-100">
                    <img src="https://images.unsplash.com/photo-1596701509378-d586e33bdc6f?q=80&w=800&auto=format&fit=crop" class="card-img-top rounded-0" alt="Danau Payau Dampar" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Danau Payau Pantai Dampar</h5>
                        <p class="card-text text-muted small">Bermain perahu dan menikmati ketenangan air payau yang dibatasi oleh hamparan pasir hitam dari deburan ombak selatan.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-0 mt-2">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
</body>

</html>