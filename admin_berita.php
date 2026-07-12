<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

$pesan = $tipe = "";

// Handle Tambah
if (isset($_POST['tambah'])) {
    $judul = trim($_POST['judul']);
    $konten = trim($_POST['konten']);
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    
    $gambar = "";
    if (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        if (!is_dir("assets/img/berita")) mkdir("assets/img/berita", 0777, true);
        $nama_file = time() . '_' . basename($_FILES['gambar_file']['name']);
        $path = "assets/img/berita/" . $nama_file;
        if (move_uploaded_file($_FILES['gambar_file']['tmp_name'], $path)) {
            $gambar = $path;
        }
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO berita (judul, konten, gambar_url, kategori, status) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "sssss", $judul, $konten, $gambar, $kategori, $status);
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Berita berhasil dipublikasikan!";
        $tipe = "success";
    } else {
        $pesan = "Gagal menyimpan berita.";
        $tipe = "danger";
    }
}

// Handle Edit
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $judul = trim($_POST['judul']);
    $konten = trim($_POST['konten']);
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    
    $gambar = $_POST['gambar_lama'];
    if (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        if (!is_dir("assets/img/berita")) mkdir("assets/img/berita", 0777, true);
        $nama_file = time() . '_' . basename($_FILES['gambar_file']['name']);
        $path = "assets/img/berita/" . $nama_file;
        if (move_uploaded_file($_FILES['gambar_file']['tmp_name'], $path)) {
            $gambar = $path;
        }
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE berita SET judul=?, konten=?, gambar_url=?, kategori=?, status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $judul, $konten, $gambar, $kategori, $status, $id);
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Berita berhasil diperbarui!";
        $tipe = "success";
    } else {
        $pesan = "Gagal memperbarui berita.";
        $tipe = "danger";
    }
}

// Handle Hapus
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM berita WHERE id=$id");
    $pesan = "Berita berhasil dihapus.";
    $tipe = "warning";
}

// Edit mode
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $q = mysqli_query($koneksi, "SELECT * FROM berita WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($q);
}

$q_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tgl_publikasi DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Desa Bades</title>
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

        .thumb-berita {
            width: 70px;
            height: 55px;
            object-fit: cover;
            border-radius: 6px;
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
                <span class="page-title"><i class="fa-solid fa-newspaper me-2 text-success"></i> Kelola Berita Desa</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah" style="font-size:12px;">
                    <i class="fa-solid fa-plus me-1"></i> Berita Baru
                </button>
                <div class="user-pill d-none d-md-flex">
                    <i class="fa-solid fa-user-tie"></i>
                    <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                </div>
            </div>
        </div>
        <div class="container-fluid p-4">
            <?php if ($pesan): ?><div class="alert alert-<?= $tipe ?> alert-dismissible fade show py-2"><?= $pesan ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>

            <!-- Edit Form -->
            <?php if ($edit_data): ?>
                <div class="card border-warning border-2 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold"><i class="fa-solid fa-pen me-2"></i> Edit Berita</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($edit_data['gambar_url']) ?>">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Judul Berita</label>
                                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($edit_data['judul']) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Upload Gambar Baru (Opsional)</label>
                                    <input type="file" name="gambar_file" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Kategori</label>
                                    <select name="kategori" class="form-select">
                                        <?php foreach (['Umum', 'Pemerintahan', 'Sosial & Budaya', 'Infrastruktur', 'Pariwisata'] as $k): ?>
                                            <option value="<?= $k ?>" <?= $edit_data['kategori'] == $k ? 'selected' : '' ?>><?= $k ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Publikasi" <?= $edit_data['status'] == 'Publikasi' ? 'selected' : '' ?>>Publikasi</option>
                                        <option value="Draft" <?= $edit_data['status'] == 'Draft' ? 'selected' : '' ?>>Draft</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Isi Berita</label>
                                    <textarea name="konten" class="form-control" rows="8" required><?= htmlspecialchars($edit_data['konten']) ?></textarea>
                                </div>
                                <div class="col-12 d-flex gap-2">
                                    <button type="submit" name="edit" class="btn btn-warning px-4"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                                    <a href="admin_berita.php" class="btn btn-outline-secondary px-4">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tabel Berita -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($r = mysqli_fetch_assoc($q_berita)): ?>
                                    <tr>
                                        <td class="text-muted"><?= $no++ ?></td>
                                        <td><img src="<?= htmlspecialchars($r['gambar_url']) ?>" alt="" class="thumb-berita" onerror="this.src='https://via.placeholder.com/70x55'"></td>
                                        <td>
                                            <div class="fw-bold" style="max-width:250px;"><?= htmlspecialchars($r['judul']) ?></div>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= $r['kategori'] ?></span></td>
                                        <td><small><?= date('d/m/Y', strtotime($r['tgl_publikasi'])) ?></small></td>
                                        <td><span class="badge <?= $r['status'] == 'Publikasi' ? 'bg-success' : 'bg-secondary' ?>"><?= $r['status'] ?></span></td>
                                        <td>
                                            <a href="?edit=<?= $r['id'] ?>" class="btn btn-sm btn-outline-warning px-2" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                            <a href="?hapus=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger px-2" title="Hapus" onclick="return confirm('Hapus berita ini?')"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Berita -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-nib me-2"></i>Tulis Berita Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold small">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control" placeholder="Tulis judul yang menarik..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Upload Gambar <span class="text-danger">*</span></label>
                                <input type="file" name="gambar_file" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <?php foreach (['Umum', 'Pemerintahan', 'Sosial & Budaya', 'Infrastruktur', 'Pariwisata'] as $k): ?>
                                        <option value="<?= $k ?>"><?= $k ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Publikasi">Publikasi</option>
                                    <option value="Draft">Draft (Simpan Dulu)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Isi Berita <span class="text-danger">*</span></label>
                                <textarea name="konten" class="form-control" rows="8" placeholder="Tulis isi berita di sini..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-success px-4"><i class="fa-solid fa-paper-plane me-1"></i> Publikasikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>