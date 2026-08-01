<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Kepala Desa - Desa Bades</title>
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
        .page-header {
            background: linear-gradient(rgba(15, 76, 129, 0.88), rgba(15, 76, 129, 0.95)), url('assets/img/hero-bg.jpg') center/cover;
            color: white;
            padding: 55px 0;
            text-align: center;
        }
        .badge-sk {
            background: #fef3c7;
            color: #b45309;
            font-weight: 700;
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 20px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include "komponen_navbar.php"; ?>

    <div class="page-header">
        <div class="container" data-aos="fade-in">
            <h2 class="fw-bold mb-2"><i class="fa-solid fa-file-contract me-2"></i>Surat Keputusan (SK) Kepala Desa Bades</h2>
            <p class="lead mb-0 opacity-90" style="font-size:15px;">Daftar Keputusan Kepala Desa Bades (Bpk. Sahid, S.A.P.) tentang Penetapan & Pengangkatan Perangkat</p>
        </div>
    </div>

    <div class="container py-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius:12px; background:#fffbe6;" data-aos="fade-up">
                    <div class="d-flex align-items-center gap-3">
                        <div style="font-size:24px; color:#d97706;"><i class="fa-solid fa-award"></i></div>
                        <div class="small">
                            <strong>Keputusan Kepala Desa Bades:</strong> Dokumen penetapan resmi operasional, pengangkatan kelembagaan desa, serta pembentukan tim pelayanan kependudukan Desa Bades.
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-3 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-folder-open me-2"></i>Daftar SK Kepala Desa Resmi</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size:14px;">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;">No</th>
                                    <th>Nomor SK</th>
                                    <th>Tentang / Uraian Keputusan</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-muted">1</td>
                                    <td><span class="badge-sk">SK No. 188/01/427.910.15/2026</span></td>
                                    <td><strong>Penetapan Pengelola Sistem Informasi Desa (SID) Bades Tahun 2026</strong></td>
                                    <td>2026</td>
                                    <td><span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> Aktif</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">2</td>
                                    <td><span class="badge-sk">SK No. 188/14/427.910.15/2025</span></td>
                                    <td><strong>Pengangkatan Perangkat Desa Bades Hasil Penjaringan & Penyaringan 2025</strong></td>
                                    <td>2025</td>
                                    <td><span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> Aktif</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">3</td>
                                    <td><span class="badge-sk">SK No. 188/09/427.910.15/2025</span></td>
                                    <td><strong>Pembentukan Pelaksana Operasional Bantuan Langsung Tunai (BLT) Dana Desa</strong></td>
                                    <td>2025</td>
                                    <td><span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> Aktif</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">4</td>
                                    <td><span class="badge-sk">SK No. 188/05/427.910.15/2024</span></td>
                                    <td><strong>Penetapan Pengurus Posyandu dan Kader Kesehatan Desa Bades</strong></td>
                                    <td>2024</td>
                                    <td><span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> Aktif</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-muted">5</td>
                                    <td><span class="badge-sk">SK No. 188/03/427.910.15/2024</span></td>
                                    <td><strong>Penetapan Kelompok Informasi Masyarakat (KIM) Bades Magatra</strong></td>
                                    <td>2024</td>
                                    <td><span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>

</body>
</html>
