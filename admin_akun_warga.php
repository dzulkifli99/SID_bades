<?php
include "koneksi.php";
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}

// --- AJAX HANDLER ---
if (isset($_POST['ajax_action'])) {
    if (ob_get_length()) ob_clean();
    header('Content-Type: application/json; charset=utf-8');
    verify_csrf_token();
    $action = $_POST['ajax_action'];

    // Get Pending Registrations
    if ($action == 'get_pending') {
        $q = mysqli_query($koneksi, "SELECT * FROM warga_akun WHERE status_akun = 'Menunggu' ORDER BY created_at DESC");
        $data = [];
        if ($q) {
            while ($r = mysqli_fetch_assoc($q)) {
                $r['nik_masked'] = mask_nik($r['nik']);
                $data[] = $r;
            }
        }
        echo json_encode(['data' => $data]);
        exit;
    }

    // Get Approved Accounts
    if ($action == 'get_approved') {
        $q = mysqli_query($koneksi, "SELECT w.*, COALESCE(NULLIF(w.nama_lengkap,''), p.nama_lengkap) as nama_warga, COALESCE(NULLIF(w.rt_rw,''), p.rt_rw) as rt_rw_warga 
                                     FROM warga_akun w 
                                     LEFT JOIN penduduk p ON w.nik = p.nik 
                                     WHERE w.status_akun = 'Disetujui' 
                                     ORDER BY w.created_at DESC");
        $data = [];
        if ($q) {
            while ($r = mysqli_fetch_assoc($q)) {
                $r['nik_masked'] = mask_nik($r['nik']);
                $data[] = $r;
            }
        }
        echo json_encode(['data' => $data]);
        exit;
    }

    // Get Rejected Requests
    if ($action == 'get_rejected') {
        $q = mysqli_query($koneksi, "SELECT * FROM warga_akun WHERE status_akun = 'Ditolak' ORDER BY created_at DESC");
        $data = [];
        if ($q) {
            while ($r = mysqli_fetch_assoc($q)) {
                $r['nik_masked'] = mask_nik($r['nik']);
                $data[] = $r;
            }
        }
        echo json_encode(['data' => $data]);
        exit;
    }

    // Setujui Permohonan Akun & Masukkan ke Database Penduduk
    if ($action == 'approve') {
        $nik = trim($_POST['nik']);
        
        $stmt_get = mysqli_prepare($koneksi, "SELECT * FROM warga_akun WHERE nik = ?");
        if ($stmt_get) {
            mysqli_stmt_bind_param($stmt_get, "s", $nik);
            mysqli_stmt_execute($stmt_get);
            $res = mysqli_stmt_get_result($stmt_get);

            if ($w = mysqli_fetch_assoc($res)) {
                // 1. Update status_akun di warga_akun ke Disetujui
                $stmt_upd = mysqli_prepare($koneksi, "UPDATE warga_akun SET status_akun='Disetujui', alasan_penolakan='' WHERE nik=?");
                if ($stmt_upd) {
                    mysqli_stmt_bind_param($stmt_upd, "s", $nik);
                    mysqli_stmt_execute($stmt_upd);
                }

                // 2. OTOMATIS INSERT / UPDATE ke master database PENDUDUK
                $nama_lengkap      = !empty($w['nama_lengkap']) ? $w['nama_lengkap'] : 'WARGA DESA BADES';
                $no_kk             = !empty($w['no_kk']) ? $w['no_kk'] : '';
                $tempat_lahir      = !empty($w['tempat_lahir']) ? $w['tempat_lahir'] : 'Lumajang';
                $tanggal_lahir     = (!empty($w['tanggal_lahir']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $w['tanggal_lahir'])) ? $w['tanggal_lahir'] : '2000-01-01';
                $jenis_kelamin     = !empty($w['jenis_kelamin']) ? $w['jenis_kelamin'] : 'Laki-laki';
                $alamat            = !empty($w['alamat']) ? $w['alamat'] : 'Desa Bades';
                $rt_rw             = !empty($w['rt_rw']) ? $w['rt_rw'] : '001/001';
                $agama             = !empty($w['agama']) ? $w['agama'] : 'Islam';
                $status_perkawinan = !empty($w['status_perkawinan']) ? $w['status_perkawinan'] : 'Belum Kawin';
                $pekerjaan         = !empty($w['pekerjaan']) ? $w['pekerjaan'] : 'Wiraswasta';

                $stmt_p = mysqli_prepare($koneksi, "INSERT INTO penduduk 
                    (nik, no_kk, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, agama, status_perkawinan, pekerjaan) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE 
                    no_kk = VALUES(no_kk),
                    nama_lengkap = VALUES(nama_lengkap),
                    tempat_lahir = VALUES(tempat_lahir),
                    tanggal_lahir = VALUES(tanggal_lahir),
                    jenis_kelamin = VALUES(jenis_kelamin),
                    alamat = VALUES(alamat),
                    rt_rw = VALUES(rt_rw),
                    agama = VALUES(agama),
                    status_perkawinan = VALUES(status_perkawinan),
                    pekerjaan = VALUES(pekerjaan)");
                
                if ($stmt_p) {
                    mysqli_stmt_bind_param($stmt_p, "sssssssssss", 
                        $nik, $no_kk, $nama_lengkap, $tempat_lahir, $tanggal_lahir, 
                        $jenis_kelamin, $alamat, $rt_rw, $agama, $status_perkawinan, $pekerjaan);
                    mysqli_stmt_execute($stmt_p);
                }

                echo json_encode([
                    'status' => 'success', 
                    'msg' => 'Pendaftaran akun ' . htmlspecialchars($nama_lengkap) . ' BERHASIL DISETUJUI dan data otomatis tersimpan di Master Penduduk!'
                ]);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Data pendaftaran tidak ditemukan.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Gagal memproses permohonan.']);
        }
        exit;
    }

    // Tolak Permohonan Akun
    if ($action == 'reject') {
        $nik    = trim($_POST['nik']);
        $alasan = trim($_POST['alasan']);
        if (empty($alasan)) $alasan = "Data kependudukan tidak sesuai domisili Desa Bades.";

        $stmt = mysqli_prepare($koneksi, "UPDATE warga_akun SET status_akun='Ditolak', alasan_penolakan=? WHERE nik=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $alasan, $nik);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['status' => 'success', 'msg' => 'Permohonan akun telah ditolak.']);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Gagal menolak permohonan.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Gagal menyiapkan query penolakan.']);
        }
        exit;
    }

    // Reset Password
    if ($action == 'reset_password') {
        $nik = trim($_POST['nik']);
        $new_pass = $_POST['new_password'];

        if (strlen($new_pass) < 6) {
            echo json_encode(['status' => 'error', 'msg' => 'Password minimal 6 karakter!']);
            exit;
        }

        $hash = password_hash($new_pass, PASSWORD_BCRYPT);
        $stmt = mysqli_prepare($koneksi, "UPDATE warga_akun SET password_hash=? WHERE nik=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $hash, $nik);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['status' => 'success', 'msg' => 'Kata sandi berhasil direset!']);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Gagal reset kata sandi.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Gagal menyiapkan query reset password.']);
        }
        exit;
    }

    // Delete Akun / Data
    if ($action == 'delete') {
        $nik = trim($_POST['nik']);
        $stmt = mysqli_prepare($koneksi, "DELETE FROM warga_akun WHERE nik=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $nik);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'msg' => 'Gagal menghapus data.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Gagal menyiapkan query hapus.']);
        }
        exit;
    }
}

// Hitung Jumlah Pending untuk Badge
$q_cnt_pending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM warga_akun WHERE status_akun = 'Menunggu'");
$total_pending = ($q_cnt_pending) ? (mysqli_fetch_assoc($q_cnt_pending)['total'] ?? 0) : 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= generate_csrf_token() ?>">
    <title>Persetujuan Akun Warga - Admin Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #f1f5f9; margin: 0; }
        .nav-tabs .nav-link { font-weight: 700; color: #64748b; font-size: 13.5px; border: none; border-bottom: 3px solid transparent; padding: 12px 20px; }
        .nav-tabs .nav-link.active { color: #0f4c81; border-bottom-color: #0f4c81; background: transparent; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>

<body>
    <?php include "sidebar.php"; ?>
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm sidebar-toggle border-0" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars fa-lg text-primary"></i>
                </button>
                <span class="page-title"><i class="fa-solid fa-user-check me-2 text-primary"></i> Verifikasi &amp; Persetujuan Akun Warga</span>
            </div>
            <div class="user-pill">
                <i class="fa-solid fa-user-tie"></i>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>

        <div class="container-fluid p-4">
            <div class="alert alert-info border-0 shadow-sm rounded-3 py-3 px-4 mb-4" style="font-size:13px; background:#e0f2fe; color:#0369a1;">
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size:24px;"><i class="fa-solid fa-clipboard-check"></i></div>
                    <div>
                        <strong>Alur Verifikasi Pendaftaran Warga:</strong><br>
                        Warga mendaftar secara mandiri melalui formulir online. Admin meninjau data kependudukan. Saat Admin men-<strong>Setujui</strong>, akun warga akan aktif dan datanya <strong>otomatis tersimpan ke Master Data Penduduk Desa Bades</strong>.
                    </div>
                </div>
            </div>

            <div class="card card-custom p-3">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs mb-3" id="akunTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active d-flex align-items-center gap-2" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                            <i class="fa-solid fa-clock-rotate-left text-warning"></i> Permohonan Menunggu
                            <?php if ($total_pending > 0): ?>
                            <span class="badge rounded-pill bg-danger" id="badgePending"><?= $total_pending ?></span>
                            <?php endif; ?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">
                            <i class="fa-solid fa-circle-check text-success"></i> Akun Terverifikasi (Disetujui)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
                            <i class="fa-solid fa-circle-xmark text-danger"></i> Permohonan Ditolak
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content p-2" id="akunTabContent">

                    <!-- TAB 1: PERMOHONAN MENUNGGU -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        <div class="table-responsive">
                            <table id="tabelPending" class="table table-hover align-middle w-100" style="font-size:13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>No. KK</th>
                                        <th>Alamat / RT RW</th>
                                        <th>No. HP</th>
                                        <th>Tgl Daftar</th>
                                        <th>Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 2: AKUN TERVERIFIKASI -->
                    <div class="tab-pane fade" id="approved" role="tabpanel">
                        <div class="table-responsive">
                            <table id="tabelApproved" class="table table-hover align-middle w-100" style="font-size:13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>RT/RW</th>
                                        <th>No. HP</th>
                                        <th>Status Database</th>
                                        <th>Tgl Disetujui</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: PERMOHONAN DITOLAK -->
                    <div class="tab-pane fade" id="rejected" role="tabpanel">
                        <div class="table-responsive">
                            <table id="tabelRejected" class="table table-hover align-middle w-100" style="font-size:13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat / Dusun</th>
                                        <th>Alasan Penolakan</th>
                                        <th>Tgl Ditolak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL DATA WARGA -->
    <div class="modal fade" id="modalDetail" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white p-3">
                    <h6 class="modal-title fw-bold" id="modalDetailTitle"><i class="fa-solid fa-id-card me-2"></i>Detail Formulir Pendaftaran Warga</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="modalDetailBody">
                    <!-- Dynamic Body -->
                </div>
                <div class="modal-footer border-0 p-3 bg-light">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PENOLAKAN -->
    <div class="modal fade" id="modalTolak" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white p-3">
                    <h6 class="modal-title fw-bold"><i class="fa-solid fa-circle-xmark me-2"></i>Tolak Permohonan Akun</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="formTolak">
                    <input type="hidden" name="nik" id="tolak_nik">
                    <div class="modal-body p-4">
                        <p class="small text-muted mb-2">Berikan alasan penolakan agar warga dapat mengetahuinya saat mencoba login:</p>
                        <textarea name="alasan" id="tolak_alasan" class="form-control" rows="3" placeholder="Contoh: NIK atau data domisili tidak terdaftar di Desa Bades." required></textarea>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light">
                        <button type="button" class="btn btn-sm btn-light border rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-4 fw-bold">Konfirmasi Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let dtPending, dtApproved, dtRejected;
        let dataStore = {};

        function getCsrfToken() {
            return $('meta[name="csrf-token"]').attr('content') || '<?= generate_csrf_token() ?>';
        }

        $(document).ready(function() {

            // DataTable Pending
            dtPending = $('#tabelPending').DataTable({
                ajax: {
                    url: 'admin_akun_warga.php',
                    type: 'POST',
                    data: function(d) {
                        d.ajax_action = 'get_pending';
                        d.csrf_token = getCsrfToken();
                    },
                    dataSrc: function(json) {
                        (json.data || []).forEach(r => dataStore[r.nik] = r);
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'nik', render: d => '<code>' + d + '</code>' },
                    { data: 'nama_lengkap', render: d => '<strong>' + (d || '-') + '</strong>' },
                    { data: 'no_kk', render: d => d || '-' },
                    { data: 'alamat', render: (d, t, r) => (d || '-') + '<br><small class="text-muted">RT/RW: ' + (r.rt_rw || '-') + '</small>' },
                    { data: 'no_hp', render: d => d ? '<a href="https://wa.me/' + d.replace(/[^0-9]/g,'') + '" target="_blank" class="btn btn-xs btn-outline-success rounded-pill" style="font-size:11px;"><i class="fa-brands fa-whatsapp me-1"></i>' + d + '</a>' : '-' },
                    { data: 'created_at', render: d => d ? d.substring(0, 10) : '-' },
                    {
                        data: null,
                        orderable: false,
                        render: function(d) {
                            return '<div class="btn-group btn-group-sm">' +
                                '<button class="btn btn-info text-white btn-detail" data-nik="' + d.nik + '" title="Detail Form"><i class="fa-solid fa-eye"></i></button>' +
                                '<button class="btn btn-success btn-approve" data-nik="' + d.nik + '" data-nama="' + (d.nama_lengkap || d.nik) + '" title="Setujui & Masukkan ke DB Penduduk"><i class="fa-solid fa-check me-1"></i> Setujui</button>' +
                                '<button class="btn btn-danger btn-reject-modal" data-nik="' + d.nik + '" title="Tolak"><i class="fa-solid fa-xmark me-1"></i> Tolak</button>' +
                                '</div>';
                        }
                    }
                ]
            });

            // DataTable Approved
            dtApproved = $('#tabelApproved').DataTable({
                ajax: {
                    url: 'admin_akun_warga.php',
                    type: 'POST',
                    data: function(d) {
                        d.ajax_action = 'get_approved';
                        d.csrf_token = getCsrfToken();
                    },
                    dataSrc: function(json) {
                        (json.data || []).forEach(r => dataStore[r.nik] = r);
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'nik', render: d => '<code>' + d + '</code>' },
                    { data: 'nama_warga', render: d => '<strong>' + (d || 'Warga Desa Bades') + '</strong>' },
                    { data: 'rt_rw_warga', render: d => d || '-' },
                    { data: 'no_hp', render: d => d || '-' },
                    { data: null, render: () => '<span class="badge bg-success"><i class="fa-solid fa-database me-1"></i> Tersimpan di Penduduk</span>' },
                    { data: 'created_at', render: d => d ? d.substring(0, 10) : '-' },
                    {
                        data: null,
                        orderable: false,
                        render: function(d) {
                            return '<div class="btn-group btn-group-sm">' +
                                '<button class="btn btn-outline-info btn-detail" data-nik="' + d.nik + '" title="Detail"><i class="fa-solid fa-eye"></i></button>' +
                                '<button class="btn btn-warning text-dark btn-reset" data-nik="' + d.nik + '" title="Reset Password"><i class="fa-solid fa-key"></i></button>' +
                                '<button class="btn btn-outline-danger btn-delete" data-nik="' + d.nik + '" title="Hapus"><i class="fa-solid fa-trash"></i></button>' +
                                '</div>';
                        }
                    }
                ]
            });

            // DataTable Rejected
            dtRejected = $('#tabelRejected').DataTable({
                ajax: {
                    url: 'admin_akun_warga.php',
                    type: 'POST',
                    data: function(d) {
                        d.ajax_action = 'get_rejected';
                        d.csrf_token = getCsrfToken();
                    },
                    dataSrc: function(json) {
                        (json.data || []).forEach(r => dataStore[r.nik] = r);
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'nik', render: d => '<code>' + d + '</code>' },
                    { data: 'nama_lengkap', render: d => '<strong>' + (d || '-') + '</strong>' },
                    { data: 'alamat', render: d => d || '-' },
                    { data: 'alasan_penolakan', render: d => '<span class="text-danger fw-bold" style="font-size:12px;">' + (d || 'Data tidak terverifikasi') + '</span>' },
                    { data: 'created_at', render: d => d ? d.substring(0, 10) : '-' },
                    {
                        data: null,
                        orderable: false,
                        render: function(d) {
                            return '<div class="btn-group btn-group-sm">' +
                                '<button class="btn btn-success btn-approve" data-nik="' + d.nik + '" data-nama="' + (d.nama_lengkap || d.nik) + '" title="Setujui Ulang"><i class="fa-solid fa-check me-1"></i> Setujui Ulang</button>' +
                                '<button class="btn btn-outline-danger btn-delete" data-nik="' + d.nik + '" title="Hapus Permanen"><i class="fa-solid fa-trash"></i></button>' +
                                '</div>';
                        }
                    }
                ]
            });

            // Tab switch handler
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let target = $(e.target).attr('data-bs-target');
                if (target === '#pending') dtPending.ajax.reload();
                if (target === '#approved') dtApproved.ajax.reload();
                if (target === '#rejected') dtRejected.ajax.reload();
            });

            // 1. DETAIL DATA MODAL
            $(document).on('click', '.btn-detail', function() {
                let nik = $(this).data('nik');
                let r = dataStore[nik] || {};
                let html = '<div class="row g-3" style="font-size:13px;">' +
                    '<div class="col-md-6"><strong>NIK:</strong><br><code>' + (r.nik || '-') + '</code></div>' +
                    '<div class="col-md-6"><strong>No. KK:</strong><br>' + (r.no_kk || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Nama Lengkap:</strong><br><span class="fw-bold text-primary">' + (r.nama_lengkap || r.nama_warga || '-') + '</span></div>' +
                    '<div class="col-md-6"><strong>Jenis Kelamin:</strong><br>' + (r.jenis_kelamin || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Tempat, Tgl Lahir:</strong><br>' + (r.tempat_lahir || '-') + ', ' + (r.tanggal_lahir || '-') + '</div>' +
                    '<div class="col-md-6"><strong>RT / RW:</strong><br>' + (r.rt_rw || r.rt_rw_warga || '-') + '</div>' +
                    '<div class="col-12"><strong>Alamat / Dusun:</strong><br>' + (r.alamat || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Agama:</strong><br>' + (r.agama || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Status Perkawinan:</strong><br>' + (r.status_perkawinan || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Pekerjaan:</strong><br>' + (r.pekerjaan || '-') + '</div>' +
                    '<div class="col-md-6"><strong>No. HP / WA:</strong><br>' + (r.no_hp || '-') + '</div>' +
                    '<div class="col-md-6"><strong>Status Akun:</strong><br><span class="badge bg-' + (r.status_akun=='Disetujui'?'success':(r.status_akun=='Ditolak'?'danger':'warning')) + '">' + (r.status_akun || 'Menunggu') + '</span></div>' +
                    '</div>';
                
                $('#modalDetailBody').html(html);
                new bootstrap.Modal(document.getElementById('modalDetail')).show();
            });

            // 2. SETUJUI PERMOHONAN AKUN
            $(document).on('click', '.btn-approve', function() {
                let nik = $(this).data('nik');
                let nama = $(this).data('nama');

                Swal.fire({
                    title: 'Setujui Pendaftaran Akun?',
                    html: 'Pendaftaran warga <strong>' + nama + '</strong> (NIK: <code>' + nik + '</code>) akan disetujui.<br><br><span class="text-success"><i class="fa-solid fa-database me-1"></i> Data warga ini akan OTOMATIS tersimpan di Master Data Penduduk Desa Bades.</span>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="fa-solid fa-check me-1"></i> Ya, Setujui & Masukkan ke DB'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('admin_akun_warga.php', { ajax_action: 'approve', nik: nik, csrf_token: getCsrfToken() }, function(res) {
                            if (res.status == 'success') {
                                Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.msg, confirmButtonColor: '#0f4c81' });
                                dtPending.ajax.reload();
                                dtApproved.ajax.reload();
                                dtRejected.ajax.reload();
                            } else {
                                Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                            }
                        }, 'json');
                    }
                });
            });

            // 3. TOLAK PERMOHONAN AKUN
            $(document).on('click', '.btn-reject-modal', function() {
                let nik = $(this).data('nik');
                $('#tolak_nik').val(nik);
                $('#tolak_alasan').val('');
                new bootstrap.Modal(document.getElementById('modalTolak')).show();
            });

            $('#formTolak').on('submit', function(e) {
                e.preventDefault();
                let nik = $('#tolak_nik').val();
                let alasan = $('#tolak_alasan').val();

                $.post('admin_akun_warga.php', { ajax_action: 'reject', nik: nik, alasan: alasan, csrf_token: getCsrfToken() }, function(res) {
                    bootstrap.Modal.getInstance(document.getElementById('modalTolak')).hide();
                    if (res.status == 'success') {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: res.msg, timer: 1500, showConfirmButton: false });
                        dtPending.ajax.reload();
                        dtApproved.ajax.reload();
                        dtRejected.ajax.reload();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                    }
                }, 'json');
            });

            // 4. RESET PASSWORD
            $(document).on('click', '.btn-reset', function() {
                let nik = $(this).data('nik');

                Swal.fire({
                    title: 'Reset Password Warga',
                    html: 'Masukkan Kata Sandi Baru untuk NIK <code>' + nik + '</code>:',
                    input: 'password',
                    inputPlaceholder: 'Minimal 6 Karakter',
                    inputAttributes: { minlength: 6 },
                    showCancelButton: true,
                    confirmButtonText: 'Simpan Password',
                    confirmButtonColor: '#0f4c81'
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $.post('admin_akun_warga.php', { ajax_action: 'reset_password', nik: nik, new_password: result.value, csrf_token: getCsrfToken() }, function(res) {
                            if (res.status == 'success') {
                                Swal.fire({ icon: 'success', title: 'Berhasil', text: res.msg });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                            }
                        }, 'json');
                    }
                });
            });

            // 5. HAPUS AKUN
            $(document).on('click', '.btn-delete', function() {
                let nik = $(this).data('nik');

                Swal.fire({
                    title: 'Hapus Data Akun?',
                    text: 'Data akun warga ini akan dihapus dari sistem.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('admin_akun_warga.php', { ajax_action: 'delete', nik: nik, csrf_token: getCsrfToken() }, function(res) {
                            if (res.status == 'success') {
                                dtPending.ajax.reload();
                                dtApproved.ajax.reload();
                                dtRejected.ajax.reload();
                                Swal.fire({ icon: 'success', title: 'Dihapus', text: 'Data akun berhasil dihapus.', timer: 1500, showConfirmButton: false });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Gagal', text: res.msg });
                            }
                        }, 'json');
                    }
                });
            });

        });
    </script>
</body>
</html>