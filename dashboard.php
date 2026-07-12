<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$q_surat_menunggu = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM layanan_surat WHERE status='Menunggu'");
$jml_surat = mysqli_fetch_assoc($q_surat_menunggu)['n'];

$q_pengaduan_baru = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM pengaduan WHERE status='Baru'");
$jml_pengaduan = mysqli_fetch_assoc($q_pengaduan_baru)['n'];

$q_berita = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM berita WHERE status='Publikasi'");
$jml_berita = mysqli_fetch_assoc($q_berita)['n'];

$q_warga = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM warga_akun");
$jml_warga = $q_warga ? mysqli_fetch_assoc($q_warga)['n'] : 0;

$q_surat_baru = mysqli_query($koneksi, "SELECT s.*, p.nama_lengkap FROM layanan_surat s JOIN penduduk p ON s.nik=p.nik ORDER BY tgl_pengajuan DESC LIMIT 6");
$q_aduan_baru  = mysqli_query($koneksi, "SELECT * FROM pengaduan ORDER BY tgl_kirim DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SID Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background: linear-gradient(180deg, #0c3460 0%, #0f4c81 60%, #1a6db5 100%);
            z-index: 200;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform 0.3s;
        }

        .sidebar-brand {
            padding: 18px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand img {
            width: 38px;
        }

        .sidebar-brand .brand-text {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .sidebar-brand .brand-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
        }

        .sidebar-section {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            padding: 14px 16px 4px;
            font-weight: 700;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }

        .sidebar-item i {
            width: 16px;
            text-align: center;
        }

        .sidebar-item:hover,
        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: #fff;
        }

        .sidebar-badge {
            background: #ef4444;
            font-size: 10px;
            padding: 1px 7px;
            border-radius: 10px;
            margin-left: auto;
        }

        /* ── MAIN ── */
        .admin-main {
            margin-left: 240px;
            min-height: 100vh;
        }

        .admin-topbar {
            background: #fff;
            padding: 12px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-topbar .page-title {
            font-weight: 700;
            font-size: 15px;
            color: #111;
        }

        .admin-topbar .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f5f9;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #444;
        }

        .admin-topbar .user-pill i {
            color: #0f4c81;
        }

        /* ── STAT CARDS ── */
        .stat-card {
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            border: none;
            color: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .stat-card .sc-icon {
            position: absolute;
            right: 12px;
            bottom: 8px;
            font-size: 48px;
            opacity: 0.15;
        }

        .stat-card .sc-label {
            font-size: 11px;
            font-weight: 700;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .stat-card .sc-num {
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
        }

        .stat-card .sc-link {
            font-size: 11px;
            opacity: 0.7;
            text-decoration: none;
            color: #fff;
        }

        .stat-card .sc-link:hover {
            opacity: 1;
        }

        /* ── TABLES ── */
        .data-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .data-card .dc-header {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .data-card .dc-header .dc-title {
            font-weight: 700;
            font-size: 13px;
        }

        .data-card table {
            font-size: 12px;
            margin: 0;
        }

        .data-card thead th {
            background: #f8fafc;
            padding: 10px 14px;
            font-weight: 700;
            color: #555;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .data-card tbody td {
            padding: 10px 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-s {
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 12px;
            font-weight: 700;
        }

        /* ── MOBILE ── */
        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 199;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Main Content -->
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm sidebar-toggle border-0" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars fa-lg text-primary"></i>
                </button>
                <span class="page-title">Dashboard</span>
            </div>
            <div class="user-pill">
                <i class="fa-solid fa-user-tie"></i>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($_SESSION['username']) ?></span>
                <span class="badge bg-primary" style="font-size:10px;">Admin</span>
            </div>
        </div>

        <div class="p-3 p-md-4">
            <!-- Welcome -->
            <div class="rounded-3 p-3 p-md-4 mb-4 text-white position-relative overflow-hidden"
                style="background: linear-gradient(135deg,#0c3460,#1a6db5);">
                <div style="position:relative; z-index:2;">
                    <h5 class="fw-bold mb-1">Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>! 👋</h5>
                    <p class="mb-0 small" style="opacity:0.85;">Sistem Informasi Desa Bades &mdash; Kec. Pasirian, Kab. Lumajang</p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <a href="admin_surat.php" class="btn btn-sm btn-light text-primary fw-bold rounded-pill px-3" style="font-size:11px;">
                            <i class="fa-solid fa-file-signature me-1"></i> Cek Surat (<?= $jml_surat ?>)
                        </a>
                        <a href="admin_pengaduan.php" class="btn btn-sm" style="background:rgba(255,255,255,0.15); color:#fff; border:none; border-radius:20px; padding:5px 16px; font-size:11px;">
                            <i class="fa-solid fa-comment-dots me-1"></i> Pengaduan (<?= $jml_pengaduan ?>)
                        </a>
                    </div>
                </div>
                <i class="fa-solid fa-building-columns" style="position:absolute; right:16px; top:50%; transform:translateY(-50%); font-size:80px; opacity:0.07;"></i>
            </div>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">
                        <div class="sc-label">Surat Menunggu</div>
                        <div class="sc-num"><?= $jml_surat ?></div>
                        <a href="admin_surat.php" class="sc-link d-block mt-1">Lihat semua →</a>
                        <div class="sc-icon"><i class="fa-solid fa-file-signature"></i></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card" style="background:linear-gradient(135deg,#f59e0b,#b45309)">
                        <div class="sc-label">Pengaduan Baru</div>
                        <div class="sc-num"><?= $jml_pengaduan ?></div>
                        <a href="admin_pengaduan.php" class="sc-link d-block mt-1">Lihat semua →</a>
                        <div class="sc-icon"><i class="fa-solid fa-comment-dots"></i></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card" style="background:linear-gradient(135deg,#10b981,#065f46)">
                        <div class="sc-label">Total Berita</div>
                        <div class="sc-num"><?= $jml_berita ?></div>
                        <a href="admin_berita.php" class="sc-link d-block mt-1">Kelola →</a>
                        <div class="sc-icon"><i class="fa-solid fa-newspaper"></i></div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card" style="background:linear-gradient(135deg,#6366f1,#3730a3)">
                        <div class="sc-label">Warga Terdaftar</div>
                        <div class="sc-num"><?= $jml_warga ?></div>
                        <span class="sc-link d-block mt-1">Pengguna aktif</span>
                        <div class="sc-icon"><i class="fa-solid fa-users"></i></div>
                    </div>
                </div>
            </div>

            <!-- Tables -->
            <div class="row g-3">
                <!-- Surat Masuk -->
                <div class="col-12 col-lg-6">
                    <div class="data-card">
                        <div class="dc-header">
                            <div class="dc-title"><i class="fa-solid fa-inbox text-primary me-2"></i>Surat Masuk Terbaru</div>
                            <a href="admin_surat.php" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size:11px;">Semua</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Pemohon</th>
                                        <th>Jenis Surat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($q_surat_baru && mysqli_num_rows($q_surat_baru) > 0): while ($r = mysqli_fetch_assoc($q_surat_baru)):
                                            $bdg = ['Menunggu' => 'bg-warning text-dark', 'Diproses' => 'bg-info text-white', 'Selesai' => 'bg-success text-white', 'Ditolak' => 'bg-danger text-white'][$r['status']] ?? 'bg-secondary'; ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= htmlspecialchars($r['nama_lengkap']) ?></div>
                                                </td>
                                                <td><?= htmlspecialchars(substr($r['jenis_surat'], 0, 25)) ?></td>
                                                <td><span class="badge-s <?= $bdg ?>"><?= $r['status'] ?></span></td>
                                            </tr>
                                        <?php endwhile;
                                    else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">Belum ada pengajuan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Terbaru -->
                <div class="col-12 col-lg-6">
                    <div class="data-card">
                        <div class="dc-header">
                            <div class="dc-title"><i class="fa-solid fa-comment-dots text-warning me-2"></i>Pengaduan Terbaru</div>
                            <a href="admin_pengaduan.php" class="btn btn-sm btn-outline-warning rounded-pill px-3" style="font-size:11px;">Semua</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Pengirim</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($q_aduan_baru && mysqli_num_rows($q_aduan_baru) > 0): while ($r = mysqli_fetch_assoc($q_aduan_baru)):
                                            $bdg2 = ['Baru' => 'bg-danger text-white', 'Dibaca' => 'bg-secondary text-white', 'Ditindaklanjuti' => 'bg-success text-white'][$r['status']] ?? 'bg-secondary'; ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= htmlspecialchars($r['nama']) ?></div>
                                                </td>
                                                <td><span class="badge-s bg-light text-dark border"><?= $r['kategori'] ?></span></td>
                                                <td><span class="badge-s <?= $bdg2 ?>"><?= $r['status'] ?></span></td>
                                            </tr>
                                        <?php endwhile;
                                    else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">Belum ada pengaduan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center text-muted small py-3 border-top mt-2">
            &copy; <?= date('Y') ?> <strong>Pemerintah Desa Bades</strong> &mdash; Sistem Informasi Desa
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function closeSidebar() {
            document.getElementById('adminSidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }
    </script>
</body>

</html>