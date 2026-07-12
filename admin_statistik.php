<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

// AJAX Handler
if (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'update_statistik') {
    header('Content-Type: application/json');
    $laki = (int)$_POST['jumlah_laki'];
    $perempuan = (int)$_POST['jumlah_perempuan'];
    $kk = (int)$_POST['jumlah_kk'];
    $dusun = (int)$_POST['jumlah_dusun'];

    // Check if row exists
    $cek = mysqli_query($koneksi, "SELECT * FROM statistik_desa");
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE statistik_desa SET jumlah_laki=$laki, jumlah_perempuan=$perempuan, jumlah_kk=$kk, jumlah_dusun=$dusun";
    } else {
        $query = "INSERT INTO statistik_desa (jumlah_laki, jumlah_perempuan, jumlah_kk, jumlah_dusun) VALUES ($laki, $perempuan, $kk, $dusun)";
    }

    if (mysqli_query($koneksi, $query)) {
        echo json_encode(['status' => 'success', 'msg' => 'Data statistik berhasil diperbarui!']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Gagal menyimpan: ' . mysqli_error($koneksi)]);
    }
    exit();
}

// Get current data
$q = mysqli_query($koneksi, "SELECT * FROM statistik_desa LIMIT 1");
$data = mysqli_fetch_assoc($q);
if (!$data) {
    $data = ['jumlah_laki' => 0, 'jumlah_perempuan' => 0, 'jumlah_kk' => 0, 'jumlah_dusun' => 0];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Desa - Admin Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        .admin-content {
            padding: 20px;
        }

        .stat-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }
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
                <span class="page-title"><i class="fa-solid fa-chart-pie me-2 text-primary"></i> Master Data Statistik</span>
            </div>
            <div class="user-pill d-none d-md-flex">
                <i class="fa-solid fa-user-tie"></i>
                <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>

        <div class="container-fluid p-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card stat-card">
                        <div class="card-header bg-white border-bottom p-4">
                            <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-pen-to-square me-2"></i> Update Statistik Demografi</h5>
                            <p class="text-muted small mb-0 mt-1">Data ini akan ditampilkan secara langsung di halaman depan website (Landing Page).</p>
                        </div>
                        <div class="card-body p-4">
                            <form id="formStatistik">
                                <input type="hidden" name="ajax_action" value="update_statistik">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-person text-info me-1"></i> Jumlah Laki-Laki</label>
                                        <input type="number" name="jumlah_laki" class="form-control" value="<?= $data['jumlah_laki'] ?>" required min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-person-dress text-danger me-1"></i> Jumlah Perempuan</label>
                                        <input type="number" name="jumlah_perempuan" class="form-control" value="<?= $data['jumlah_perempuan'] ?>" required min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-house-chimney-user text-success me-1"></i> Jumlah Kartu Keluarga (KK)</label>
                                        <input type="number" name="jumlah_kk" class="form-control" value="<?= $data['jumlah_kk'] ?>" required min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted"><i class="fa-solid fa-map-location-dot text-warning me-1"></i> Jumlah Dusun</label>
                                        <input type="number" name="jumlah_dusun" class="form-control" value="<?= $data['jumlah_dusun'] ?>" required min="0">
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-top text-end">
                                    <button type="submit" id="btnSave" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                        <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#formStatistik').on('submit', function(e) {
                e.preventDefault();
                $('#btnSave').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...');

                $.ajax({
                    url: 'admin_statistik.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        $('#btnSave').prop('disabled', false).html('<i class="fa-solid fa-save me-1"></i> Simpan Perubahan');
                        if (res.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.msg
                            });
                        }
                    },
                    error: function() {
                        $('#btnSave').prop('disabled', false).html('<i class="fa-solid fa-save me-1"></i> Simpan Perubahan');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Sistem',
                            text: 'Terjadi kesalahan pada server.'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>