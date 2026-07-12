<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['warga_login'])) {
    header("Location: login_warga.php");
    exit();
}

$nik = $_SESSION['warga_nik'];
$nama = $_SESSION['warga_nama'];
$pesan = "";
$tipe_pesan = "";

// Mengambil data lengkap penduduk agar tidak dipalsukan
$q_penduduk = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik = '$nik'");
$data_penduduk = mysqli_fetch_assoc($q_penduduk);

// --- Handle Form Surat via AJAX ---
if (isset($_POST['ajax_surat'])) {
    header('Content-Type: application/json');
    $jenis_surat = $_POST['jenis_surat'];
    $keperluan = trim($_POST['keperluan']);
    $status_awal = 'Menunggu';

    $stmt = mysqli_prepare($koneksi, "INSERT INTO layanan_surat (nik, jenis_surat, keperluan, status) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nik, $jenis_surat, $keperluan, $status_awal);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'msg' => 'Surat berhasil diajukan! Silakan cek status di dashboard.']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Gagal mengajukan surat. Coba lagi.']);
    }
    exit();
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
    <title>Buat Surat - Dashboard Warga</title>
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
            color: #fff; padding: 0; position: sticky; top: 0; z-index: 1030;
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
            display: flex; flex-direction: column; align-items: center; gap: 3px; cursor: pointer;
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
            border-left: 3px solid transparent; cursor: pointer;
        }
        .sidebar-warga .sw-item:hover,
        .sidebar-warga .sw-item.active {
            background: #f0f6ff; color: #0f4c81;
            border-left-color: #0f4c81;
        }
        .sidebar-warga .sw-item i { width: 18px; text-align: center; font-size: 14px; }

        /* Main content */
        .main-warga { margin-left: 220px; padding: 24px; }

        /* Card Form */
        .card-form {
            background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: none;
        }

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
                <a href="dashboard_warga.php" class="sw-item"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="buat_surat.php" class="sw-item active"><i class="fa-solid fa-file-circle-plus"></i> Buat Surat Baru</a>
                <a class="sw-item" data-bs-toggle="modal" data-bs-target="#modalPengaduan"><i class="fa-solid fa-comment-dots"></i> Pengaduan</a>
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

            <div class="d-flex align-items-center gap-2 mb-4">
                <a href="dashboard_warga.php" class="btn btn-sm btn-light border rounded-circle" style="width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa-solid fa-arrow-left"></i></a>
                <h5 class="fw-bold mb-0">Form Pengajuan Surat</h5>
            </div>

            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card card-form p-3 p-md-4">
                        <form id="formSurat">
                            <input type="hidden" name="ajax_surat" value="1">
                            <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary" style="font-size:14px;"><i class="fa-solid fa-address-card me-2"></i>Data Pemohon</h6>
                            <div class="row mb-3 g-2">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm bg-light" value="<?= htmlspecialchars($data_penduduk['nama_lengkap']) ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">NIK</label>
                                    <input type="text" class="form-control form-control-sm bg-light" value="<?= htmlspecialchars($data_penduduk['nik']) ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small text-muted mb-1">Alamat Tercatat</label>
                                <textarea class="form-control form-control-sm bg-light" rows="2" readonly><?= htmlspecialchars($data_penduduk['alamat'] . ' RT/RW ' . $data_penduduk['rt_rw']) ?></textarea>
                            </div>

                            <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary" style="font-size:14px;"><i class="fa-solid fa-file-lines me-2"></i>Detail Surat</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold small mb-1">Pilih Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" class="form-select form-select-sm" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Surat Keterangan Tidak Mampu (SKTM)">Surat Keterangan Tidak Mampu (SKTM)</option>
                                    <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                                    <option value="Surat Pengantar Pembuatan KTP">Surat Pengantar Pembuatan KTP</option>
                                    <option value="Surat Pengantar Pembuatan KK">Surat Pengantar Pembuatan KK</option>
                                    <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small mb-1">Keperluan <span class="text-danger">*</span></label>
                                <textarea name="keperluan" class="form-control form-control-sm" rows="3" placeholder="Jelaskan untuk keperluan apa surat ini diajukan..." required></textarea>
                            </div>

                            <button type="submit" id="btnSurat" class="btn btn-primary w-100 rounded-pill"><i class="fa-solid fa-paper-plane me-2"></i> Kirim Pengajuan Surat</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3" style="background: linear-gradient(135deg, #0f4c81, #1a78c2); color: #fff;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold"><i class="fa-solid fa-circle-info me-2"></i>Informasi Alur</h6>
                            <ul class="small ps-3 mt-3 mb-0" style="opacity:0.9; line-height:1.6;">
                                <li class="mb-2">Data diri Anda ditarik secara otomatis dari database desa dan tidak dapat diubah di sini.</li>
                                <li class="mb-2">Setelah diajukan, status surat adalah <strong>Menunggu</strong> verifikasi dari Admin Desa.</li>
                                <li>Jika surat disetujui (Selesai), Anda dapat mengunduh dan mencetak file PDF-nya melalui halaman Dashboard.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Nav -->
    <nav class="mobile-nav">
        <a href="dashboard_warga.php" class="mn-item">
            <i class="fa-solid fa-house"></i><span>Beranda</span>
        </a>
        <a href="buat_surat.php" class="mn-item active">
            <i class="fa-solid fa-file-plus"></i><span>Buat Surat</span>
        </a>
        <a class="mn-item" data-bs-toggle="modal" data-bs-target="#modalPengaduan">
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
        // Form Surat
        $('#formSurat').on('submit', function(e) {
            e.preventDefault();
            $('#btnSurat').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Memproses...');
            $.post('buat_surat.php', $(this).serialize(), function(res) {
                $('#btnSurat').prop('disabled', false).html('<i class="fa-solid fa-paper-plane me-1"></i> Ajukan Surat');
                if(res.status == 'success') {
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.msg }).then(() => {
                        window.location.href = 'dashboard_warga.php';
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                }
            }, 'json');
        });

        // Form Pengaduan Modal
        $('#formPengaduan').on('submit', function(e) {
            e.preventDefault();
            $('#btnPengaduan').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Mengirim...');
            $.post('buat_surat.php', $(this).serialize(), function(res) {
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