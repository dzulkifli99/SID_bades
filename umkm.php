<?php
session_start();
include "koneksi.php";

$q_umkm = mysqli_query($koneksi, "SELECT * FROM umkm ORDER BY tgl_tambah DESC");
$umkm_data = [];
while ($r = mysqli_fetch_assoc($q_umkm)) {
    $umkm_data[] = $r;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potensi UMKM - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #f8fafc; }
        
        .hero-umkm {
            background: linear-gradient(rgba(15, 76, 129, 0.8), rgba(15, 76, 129, 0.9)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80') center/cover;
            color: white;
            padding: 80px 0 60px;
            text-align: center;
        }

        .umkm-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
            height: 100%;
            cursor: pointer;
        }

        .umkm-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .umkm-img-wrap {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .umkm-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .umkm-card:hover .umkm-img-wrap img { transform: scale(1.05); }

        .price-badge {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(46, 204, 113, 0.95);
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            backdrop-filter: blur(4px);
        }

        .umkm-card-body { padding: 20px; }
        .umkm-title { font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
        .umkm-owner { font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 12px; }
        
        /* Modal Detail */
        .modal-img { width: 100%; height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 20px; }
        .detail-row { display: flex; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .detail-icon { width: 40px; color: #0f4c81; font-size: 20px; }
        .detail-content h6 { margin: 0 0 5px; font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 700; }
        .detail-content p { margin: 0; font-size: 15px; color: #1e293b; font-weight: 600; }
    </style>
</head>
<body>
    <?php include "komponen_navbar.php"; ?>

    <section class="hero-umkm">
        <div class="container">
            <h1 class="fw-bold mb-3">Etalase UMKM Desa Bades</h1>
            <p class="lead mb-0" style="max-width: 600px; margin: 0 auto; opacity: 0.9;">Mendukung perekonomian lokal dengan mempromosikan produk-produk unggulan karya warga desa.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-4">
            <?php if (count($umkm_data) > 0): ?>
                <?php foreach ($umkm_data as $u): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="umkm-card" onclick='showUmkmDetail(<?= json_encode($u) ?>)'>
                        <div class="umkm-img-wrap">
                            <img src="<?= htmlspecialchars($u['gambar_url']) ?>" alt="<?= htmlspecialchars($u['nama_produk']) ?>" onerror="this.src='https://via.placeholder.com/300x200'">
                            <div class="price-badge"><?= htmlspecialchars($u['harga']) ?></div>
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-title"><?= htmlspecialchars($u['nama_produk']) ?></h3>
                            <div class="umkm-owner"><i class="fa-solid fa-store me-1"></i> <?= htmlspecialchars($u['pemilik']) ?></div>
                            <div class="small text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= htmlspecialchars($u['deskripsi']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-box-open mb-3" style="font-size: 40px; opacity: 0.5;"></i>
                    <h5>Belum ada produk UMKM yang ditampilkan.</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Detail UMKM -->
    <div class="modal fade" id="modalDetail" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary" id="m_title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <img src="" id="m_img" class="modal-img" onerror="this.src='https://via.placeholder.com/400x300'">
                    
                    <div class="detail-row">
                        <div class="detail-icon"><i class="fa-solid fa-user-tag"></i></div>
                        <div class="detail-content">
                            <h6>Nama Pemilik / Usaha</h6>
                            <p id="m_owner"></p>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-icon"><i class="fa-solid fa-tags text-success"></i></div>
                        <div class="detail-content">
                            <h6>Rentang Harga</h6>
                            <p id="m_price" class="text-success"></p>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-icon"><i class="fa-solid fa-location-dot text-danger"></i></div>
                        <div class="detail-content">
                            <h6>Lokasi Produksi</h6>
                            <p id="m_location"></p>
                        </div>
                    </div>
                    
                    <div class="detail-row border-0 mb-0 pb-0">
                        <div class="detail-icon"><i class="fa-solid fa-circle-info text-info"></i></div>
                        <div class="detail-content w-100">
                            <h6>Deskripsi Produk</h6>
                            <p id="m_desc" style="font-size: 14px; font-weight: 400; line-height: 1.6;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
    function showUmkmDetail(data) {
        document.getElementById('m_title').textContent = data.nama_produk;
        document.getElementById('m_img').src = data.gambar_url;
        document.getElementById('m_owner').textContent = data.pemilik;
        document.getElementById('m_price').textContent = data.harga;
        document.getElementById('m_location').textContent = data.lokasi;
        document.getElementById('m_desc').textContent = data.deskripsi;
        modalDetail.show();
    }
    </script>
</body>
</html>
