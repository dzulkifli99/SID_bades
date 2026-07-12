<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$pesan = $tipe = "";

// Handle update status
if (isset($_POST['update_status'])) {
    $id = (int)$_POST['id_surat'];
    $status = $_POST['status'];
    $allowed = ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'];
    if (in_array($status, $allowed)) {
        $tgl_selesai = ($status == 'Selesai') ? ", tgl_selesai=NOW()" : "";
        mysqli_query($koneksi, "UPDATE layanan_surat SET status='$status'$tgl_selesai WHERE id_surat=$id");
        $pesan = "Status surat berhasil diperbarui menjadi <strong>$status</strong>.";
        $tipe = "success";
    }
}

$filter = isset($_GET['status']) ? $_GET['status'] : '';
$where = $filter ? "WHERE s.status='" . mysqli_real_escape_string($koneksi, $filter) . "'" : '';
$q = mysqli_query($koneksi, "SELECT s.*, p.nama_lengkap, p.alamat FROM layanan_surat s JOIN penduduk p ON s.nik=p.nik $where ORDER BY tgl_pengajuan DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Surat - Admin Desa Bades</title>
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
                <span class="page-title"><i class="fa-solid fa-file-signature me-2 text-primary"></i> Persetujuan Surat Warga</span>
            </div>
            <div class="user-pill">
                <i class="fa-solid fa-user-tie"></i>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>
        <div class="container-fluid p-4">
            <?php if ($pesan): ?>
                <div class="alert alert-<?= $tipe ?> alert-dismissible fade show py-2"><?= $pesan ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            <?php endif; ?>

            <!-- Filter Tabs -->
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <a href="admin_surat.php" class="btn btn-sm <?= !$filter ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill">Semua</a>
                <?php foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $s):
                    $cls = ['Menunggu' => 'warning', 'Diproses' => 'info', 'Selesai' => 'success', 'Ditolak' => 'danger'][$s];
                ?>
                    <a href="?status=<?= $s ?>" class="btn btn-sm <?= $filter == $s ? "btn-$cls" : "btn-outline-$cls" ?> rounded-pill"><?= $s ?></a>
                <?php endforeach; ?>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Keperluan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                if (mysqli_num_rows($q) > 0): while ($r = mysqli_fetch_assoc($q)):
                                        $bdg = ['Menunggu' => 'bg-warning text-dark', 'Diproses' => 'bg-info text-white', 'Selesai' => 'bg-success text-white', 'Ditolak' => 'bg-danger text-white'][$r['status']] ?? 'bg-secondary'; ?>
                                        <tr>
                                            <td class="text-muted"><?= $no++ ?></td>
                                            <td>
                                                <div class="fw-bold"><?= htmlspecialchars($r['nama_lengkap']) ?></div>
                                                <small class="text-muted">NIK: <?= $r['nik'] ?></small>
                                            </td>
                                            <td><?= htmlspecialchars($r['jenis_surat']) ?></td>
                                            <td><small class="text-muted"><?= htmlspecialchars(substr($r['keperluan'], 0, 60)) ?>...</small></td>
                                            <td><small><?= date('d/m/Y H:i', strtotime($r['tgl_pengajuan'])) ?></small></td>
                                            <td><span class="badge <?= $bdg ?> px-2 py-1"><?= $r['status'] ?></span></td>
                                            <td>
                                                <form method="POST" class="d-flex gap-1 align-items-center">
                                                    <input type="hidden" name="id_surat" value="<?= $r['id_surat'] ?>">
                                                    <select name="status" class="form-select form-select-sm" style="width:120px;">
                                                        <?php foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $opt): ?>
                                                            <option value="<?= $opt ?>" <?= $r['status'] == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="submit" name="update_status" class="btn btn-sm btn-primary px-2" title="Simpan"><i class="fa-solid fa-check"></i></button>
                                                    <?php if ($r['status'] == 'Selesai'): ?>
                                                        <a href="cetak_surat.php?id=<?= $r['id_surat'] ?>&admin=1" target="_blank" class="btn btn-sm btn-success px-2" title="Preview Surat"><i class="fa-solid fa-eye"></i></a>
                                                    <?php endif; ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">Tidak ada data pengajuan surat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>