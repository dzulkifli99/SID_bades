<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$pesan = $tipe = "";

// Handle update status + balas
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];
    $balasan = trim($_POST['balasan']);
    $stmt = mysqli_prepare($koneksi, "UPDATE pengaduan SET status=?, balasan=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssi", $status, $balasan, $id);
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Pengaduan berhasil diperbarui.";
        $tipe = "success";
    }
}

// Handle hapus
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id=" . (int)$_GET['hapus']);
    $pesan = "Pengaduan dihapus.";
    $tipe = "warning";
}

$filter = isset($_GET['status']) ? $_GET['status'] : '';
$where = $filter ? "WHERE status='" . mysqli_real_escape_string($koneksi, $filter) . "'" : '';
$q = mysqli_query($koneksi, "SELECT * FROM pengaduan $where ORDER BY tgl_kirim DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Pengaduan - Admin Desa Bades</title>
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

        .pengaduan-card {
            border: none;
            border-left: 4px solid #e2e8f0;
            transition: all 0.2s;
        }

        .pengaduan-card.baru {
            border-left-color: #ef4444;
        }

        .pengaduan-card.dibaca {
            border-left-color: #94a3b8;
        }

        .pengaduan-card.ditindaklanjuti {
            border-left-color: #22c55e;
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
                <span class="page-title"><i class="fa-solid fa-comment-dots me-2 text-warning"></i> Kotak Pengaduan Masyarakat</span>
            </div>
            <div class="user-pill">
                <i class="fa-solid fa-user-tie"></i>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>
        <div class="container-fluid p-4">
            <?php if ($pesan): ?><div class="alert alert-<?= $tipe ?> alert-dismissible fade show py-2"><?= $pesan ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

            <div class="mb-3 d-flex gap-2 flex-wrap">
                <a href="admin_pengaduan.php" class="btn btn-sm <?= !$filter ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill">Semua</a>
                <a href="?status=Baru" class="btn btn-sm <?= $filter == 'Baru' ? 'btn-danger' : 'btn-outline-danger' ?> rounded-pill">Baru</a>
                <a href="?status=Dibaca" class="btn btn-sm <?= $filter == 'Dibaca' ? 'btn-secondary' : 'btn-outline-secondary' ?> rounded-pill">Dibaca</a>
                <a href="?status=Ditindaklanjuti" class="btn btn-sm <?= $filter == 'Ditindaklanjuti' ? 'btn-success' : 'btn-outline-success' ?> rounded-pill">Ditindaklanjuti</a>
            </div>

            <div class="row g-3">
                <?php if (mysqli_num_rows($q) > 0): while ($r = mysqli_fetch_assoc($q)):
                        $cls = strtolower($r['status']);
                        $bdg = ['Baru' => 'bg-danger', 'Dibaca' => 'bg-secondary', 'Ditindaklanjuti' => 'bg-success'][$r['status']] ?? 'bg-secondary';
                        $icon = ['Pengaduan' => 'fa-triangle-exclamation text-danger', 'Kritik' => 'fa-thumbs-down text-warning', 'Saran' => 'fa-lightbulb text-success'][$r['kategori']] ?? 'fa-comment';
                ?>
                        <div class="col-12 col-lg-6">
                            <div class="card shadow-sm pengaduan-card <?= $cls ?>">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <i class="fa-solid <?= $icon ?> me-2"></i>
                                            <strong><?= htmlspecialchars($r['nama']) ?></strong>
                                            <?php if ($r['no_hp']): ?><small class="text-muted"> &mdash; <?= htmlspecialchars($r['no_hp']) ?></small><?php endif; ?>
                                        </div>
                                        <span class="badge <?= $bdg ?>"><?= $r['status'] ?></span>
                                    </div>
                                    <p class="mb-2 text-dark" style="font-size:0.9rem;"><?= nl2br(htmlspecialchars($r['pesan'])) ?></p>
                                    <small class="text-muted"><i class="fa-regular fa-clock me-1"></i><?= date('d/m/Y H:i', strtotime($r['tgl_kirim'])) ?> &nbsp;|&nbsp; Kategori: <strong><?= $r['kategori'] ?></strong></small>

                                    <?php if ($r['balasan']): ?>
                                        <div class="mt-2 p-2 rounded" style="background:#f0fdf4; border-left:3px solid #22c55e; font-size:0.85rem;">
                                            <strong class="text-success">Balasan Admin:</strong> <?= nl2br(htmlspecialchars($r['balasan'])) ?>
                                        </div>
                                    <?php endif; ?>

                                    <form method="POST" class="mt-3 d-flex gap-2 align-items-end">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <div class="flex-grow-1">
                                            <label class="form-label small mb-1">Balasan (opsional)</label>
                                            <textarea name="balasan" class="form-control form-control-sm" rows="2" placeholder="Tulis balasan..."><?= htmlspecialchars($r['balasan'] ?? '') ?></textarea>
                                        </div>
                                        <div>
                                            <label class="form-label small mb-1">Status</label>
                                            <select name="status" class="form-select form-select-sm">
                                                <?php foreach (['Baru', 'Dibaca', 'Ditindaklanjuti'] as $s): ?>
                                                    <option value="<?= $s ?>" <?= $r['status'] == $s ? 'selected' : '' ?>><?= $s ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" name="update" class="btn btn-sm btn-primary mt-1 w-100">Simpan</button>
                                        </div>
                                        <a href="?hapus=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else: ?>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center text-muted py-5">Belum ada pengaduan masuk.</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>