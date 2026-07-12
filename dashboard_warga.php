<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['warga_login'])) {
    header("Location: login_warga.php");
    exit();
}

$nik = $_SESSION['warga_nik'];
$nama = $_SESSION['warga_nama'];

$q_riwayat = mysqli_query($koneksi, "SELECT * FROM layanan_surat WHERE nik = '$nik' ORDER BY tgl_pengajuan DESC");
$total_surat = mysqli_num_rows($q_riwayat);
mysqli_data_seek($q_riwayat, 0);

$q_selesai = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM layanan_surat WHERE nik='$nik' AND status='Selesai'");
$jml_selesai = mysqli_fetch_assoc($q_selesai)['n'];

$pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';
$tipe_pesan = "success";

if ($pesan == 'sukses') {
    $pesan = "Surat berhasil diajukan! Silakan cek status di bawah.";
}

// --- Handle Form Pengaduan Modal via AJAX ---
if (isset($_POST['ajax_pengaduan'])) {
    header('Content-Type: application/json');
    $kategori = $_POST['kategori'];
    $pesan_isi = trim($_POST['pesan_pengaduan']);
    
    $stmt = mysqli_prepare($koneksi, "INSERT INTO pengaduan (nama, no_hp, kategori, pesan) VALUES (?, '', ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama, $kategori, $pesan_isi);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'msg' => 'Pengaduan berhasil dikirim!']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Gagal mengirim pengaduan.']);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Open Sans', sans-serif; background: #f1f5f9; margin: 0; min-height: 100vh; }

        /* Top bar warga */
        .warga-topbar {
            background: linear-gradient(135deg, #0f4c81, #1a78c2);
            color: #fff; padding: 0;
        }
        .warga-topbar .topbar-inner {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 20px; flex-wrap: wrap; gap: 8px;
        }
        .warga-topbar .logo-area { display: flex; align-items: center; gap: 10px; }
        .warga-topbar .logo-area img { width: 36px; }
        .warga-topbar .logo-area span { font-weight: 700; font-size: 14px; }
        .warga-topbar .user-area { display: flex; align-items: center; gap: 8px; font-size: 13px; }
        .warga-topbar .user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: rgba(255,255,255,0.25); display: inline-flex;
            align-items: center; justify-content: center; font-size: 14px;
        }

        /* Mobile-first bottom nav */
        .mobile-nav {
            display: none;
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #fff; border-top: 1px solid #e2e8f0;
            z-index: 100; padding: 6px 0 8px;
        }
        .mobile-nav .mn-item {
            flex: 1; text-align: center; text-decoration: none;
            color: #94a3b8; font-size: 10px; font-weight: 600;
            display: flex; flex-direction: column; align-items: center; gap: 3px;
        }
        .mobile-nav .mn-item.active, .mobile-nav .mn-item:hover { color: #0f4c81; }
        .mobile-nav .mn-item i { font-size: 18px; }

        /* Sidebar desktop */
        .sidebar-warga {
            width: 220px; min-height: calc(100vh - 58px);
            background: #fff; border-right: 1px solid #e2e8f0;
            display: flex; flex-direction: column;
            position: fixed; top: 58px; left: 0; bottom: 0;
        }
        .sidebar-warga .sw-item {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 18px; color: #555; text-decoration: none;
            font-size: 13px; font-weight: 600; transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-warga .sw-item:hover,
        .sidebar-warga .sw-item.active {
            background: #f0f6ff; color: #0f4c81;
            border-left-color: #0f4c81;
        }
        .sidebar-warga .sw-item i { width: 18px; text-align: center; font-size: 14px; }

        /* Main content */
        .main-warga { margin-left: 220px; padding: 24px; }

        /* Stat cards */
        .stat-mini { background: #fff; border-radius: 12px; padding: 16px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .stat-mini .stat-num { font-size: 28px; font-weight: 800; line-height: 1; }
        .stat-mini .stat-lbl { font-size: 11px; color: #888; margin-top: 4px; }

        /* Surat table card */
        .surat-table-wrap { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; }
        .surat-table-wrap .table { margin: 0; font-size: 13px; }
        .surat-table-wrap .table thead th { background: #f8fafc; font-weight: 700; color: #555; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .badge-status { font-size: 0.7rem; padding: 4px 10px; border-radius: 15px; font-weight: 700; }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar-warga { display: none; }
            .mobile-nav { display: flex; }
            .main-warga { margin-left: 0; padding: 16px; padding-bottom: 80px; }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="warga-topbar">
        <div class="topbar-inner">
            <div class="logo-area">
                <img src="assets/img/logolumajang.png" alt="Logo">
                <span>Portal Warga Desa Bades</span>
            </div>
            <div class="user-area">
                <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($nama) ?></span>
                <a href="logout_warga.php" class="btn btn-sm" style="background:rgba(255,255,255,0.15); color:#fff; border:none; font-size:12px; border-radius:15px; padding:4px 12px;">Keluar</a>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <!-- Sidebar Desktop -->
        <div class="sidebar-warga">
            <div class="p-3 border-bottom">
                <div class="text-center">
                    <div style="width:50px; height:50px; background:#e8f0fe; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:20px; color:#0f4c81;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="fw-bold mt-2" style="font-size:13px;"><?= htmlspecialchars($nama) ?></div>
                    <div class="text-muted" style="font-size:11px;">NIK: <?= substr($nik,0,6).'**********' ?></div>
                </div>
            </div>
            <nav class="mt-2">
                <a href="dashboard_warga.php" class="sw-item active"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="buat_surat.php" class="sw-item"><i class="fa-solid fa-file-circle-plus"></i> Buat Surat Baru</a>
                <a class="sw-item" data-bs-toggle="modal" data-bs-target="#modalPengaduan" style="cursor:pointer;"><i class="fa-solid fa-comment-dots"></i> Pengaduan</a>
                <a href="index.php" class="sw-item"><i class="fa-solid fa-earth-asia"></i> Website Desa</a>
            </nav>
            <div class="mt-auto p-3">
                <a href="logout_warga.php" class="btn btn-outline-danger w-100 rounded-pill" style="font-size:12px;">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                </a>
            </div>
        </div>

        <!-- Main -->
        <div class="main-warga flex-grow-1">

            <h5 class="fw-bold mb-1">Halo, <?= explode(' ', $nama)[0] ?>! 👋</h5>
            <p class="text-muted small mb-4">Berikut adalah ringkasan aktivitas layanan mandiri Anda.</p>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-4">
                    <div class="stat-mini">
                        <div class="stat-num text-primary"><?= $total_surat ?></div>
                        <div class="stat-lbl">Total Surat</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-mini">
                        <div class="stat-num text-success"><?= $jml_selesai ?></div>
                        <div class="stat-lbl">Selesai</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-mini">
                        <div class="stat-num text-warning"><?= $total_surat - $jml_selesai ?></div>
                        <div class="stat-lbl">Proses</div>
                    </div>
                </div>
            </div>

            <!-- Tombol Buat Surat -->
            <a href="buat_surat.php" class="d-flex align-items-center gap-3 p-3 rounded-3 mb-4 text-decoration-none"
               style="background:linear-gradient(135deg,#0f4c81,#1a78c2); color:#fff;">
                <div style="font-size:28px; opacity:0.8;"><i class="fa-solid fa-file-circle-plus"></i></div>
                <div>
                    <div class="fw-bold">Ajukan Surat Baru</div>
                    <div style="font-size:12px; opacity:0.85;">KTP, KK, SKTM, Domisili, Usaha</div>
                </div>
                <i class="fa-solid fa-chevron-right ms-auto"></i>
            </a>

            <!-- Riwayat -->
            <div class="surat-table-wrap">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <span class="fw-bold" style="font-size:14px;"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Riwayat Pengajuan</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($q_riwayat) > 0):
                            while ($row = mysqli_fetch_assoc($q_riwayat)):
                                $badges = ['Menunggu'=>'bg-warning text-dark','Diproses'=>'bg-info text-white','Selesai'=>'bg-success text-white','Ditolak'=>'bg-danger text-white'];
                                $badge = $badges[$row['status']] ?? 'bg-secondary';
                        ?>
                        <tr>
                            <td><div class="fw-bold" style="font-size:12px;"><?= htmlspecialchars($row['jenis_surat']) ?></div></td>
                            <td><span class="text-muted" style="font-size:11px;"><?= date('d/m/Y', strtotime($row['tgl_pengajuan'])) ?></span></td>
                            <td><span class="badge-status <?= $badge ?>"><?= $row['status'] ?></span></td>
                            <td>
                                <?php if($row['status'] == 'Selesai'): ?>
                                <a href="cetak_surat.php?id=<?= $row['id_surat'] ?>" target="_blank"
                                   class="btn btn-sm btn-success rounded-pill px-3" style="font-size:11px;">
                                    <i class="fa-solid fa-print me-1"></i> Cetak PDF
                                </a>
                                <?php else: ?>
                                <span class="text-muted" style="font-size:11px;">Menunggu</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-4" style="font-size:13px;">
                            Belum ada pengajuan surat. <a href="buat_surat.php" class="text-primary">Buat surat pertama Anda</a>
                        </td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Nav -->
    <nav class="mobile-nav">
        <a href="dashboard_warga.php" class="mn-item active">
            <i class="fa-solid fa-house"></i><span>Beranda</span>
        </a>
        <a href="buat_surat.php" class="mn-item">
            <i class="fa-solid fa-file-plus"></i><span>Buat Surat</span>
        </a>
        <a class="mn-item" data-bs-toggle="modal" data-bs-target="#modalPengaduan" style="cursor:pointer;">
            <i class="fa-solid fa-comment-dots"></i><span>Pengaduan</span>
        </a>
        <a href="logout_warga.php" class="mn-item">
            <i class="fa-solid fa-right-from-bracket"></i><span>Keluar</span>
        </a>
    </nav>

    <!-- Modal Pengaduan Pop Up -->
    <div class="modal fade" id="modalPengaduan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fw-bold" style="font-size:16px;"><i class="fa-solid fa-comment-dots text-primary me-2"></i> Form Pengaduan Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formPengaduan">
                    <input type="hidden" name="ajax_pengaduan" value="1">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kategori Laporan</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="k1" value="Pengaduan" checked>
                                    <label class="form-check-label small" for="k1">Pengaduan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="k2" value="Kritik">
                                    <label class="form-check-label small" for="k2">Kritik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="k3" value="Saran">
                                    <label class="form-check-label small" for="k3">Saran</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Isi Pesan / Laporan</label>
                            <textarea name="pesan_pengaduan" class="form-control form-control-sm" rows="4" placeholder="Tuliskan laporan Anda..." required></textarea>
                            <div class="form-text" style="font-size:11px;">Identitas Anda akan disertakan otomatis pada laporan ini.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 pt-0">
                        <button type="button" class="btn btn-sm btn-light border rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnPengaduan" class="btn btn-sm btn-primary rounded-pill px-4"><i class="fa-solid fa-paper-plane me-1"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    $(document).ready(function() {
        // Form Pengaduan Modal
        $('#formPengaduan').on('submit', function(e) {
            e.preventDefault();
            $('#btnPengaduan').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Mengirim...');
            $.post('dashboard_warga.php', $(this).serialize(), function(res) {
                $('#btnPengaduan').prop('disabled', false).html('<i class="fa-solid fa-paper-plane me-1"></i> Kirim');
                if(res.status == 'success') {
                    $('#modalPengaduan').modal('hide');
                    $('#formPengaduan')[0].reset();
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: res.msg, timer: 2000, showConfirmButton: false });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                }
            }, 'json');
        });
    });
    </script>
</body>
</html>