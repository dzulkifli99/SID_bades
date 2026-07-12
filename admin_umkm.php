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
    $nama_produk = trim($_POST['nama_produk']);
    $pemilik = trim($_POST['pemilik']);
    $deskripsi = trim($_POST['deskripsi']);
    $lokasi = trim($_POST['lokasi']);
    $harga = trim($_POST['harga']);
    
    $gambar = "";
    if (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        if (!is_dir("assets/img/umkm")) mkdir("assets/img/umkm", 0777, true);
        $nama_file = time() . '_' . basename($_FILES['gambar_file']['name']);
        $path = "assets/img/umkm/" . $nama_file;
        if (move_uploaded_file($_FILES['gambar_file']['tmp_name'], $path)) {
            $gambar = $path;
        }
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO umkm (nama_produk, pemilik, deskripsi, lokasi, harga, gambar_url) VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $nama_produk, $pemilik, $deskripsi, $lokasi, $harga, $gambar);
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data UMKM berhasil ditambahkan!";
        $tipe = "success";
    } else {
        $pesan = "Gagal menyimpan data UMKM.";
        $tipe = "danger";
    }
}

// Handle Edit
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $nama_produk = trim($_POST['nama_produk']);
    $pemilik = trim($_POST['pemilik']);
    $deskripsi = trim($_POST['deskripsi']);
    $lokasi = trim($_POST['lokasi']);
    $harga = trim($_POST['harga']);
    
    $gambar = $_POST['gambar_lama'];
    if (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        if (!is_dir("assets/img/umkm")) mkdir("assets/img/umkm", 0777, true);
        $nama_file = time() . '_' . basename($_FILES['gambar_file']['name']);
        $path = "assets/img/umkm/" . $nama_file;
        if (move_uploaded_file($_FILES['gambar_file']['tmp_name'], $path)) {
            $gambar = $path;
        }
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE umkm SET nama_produk=?, pemilik=?, deskripsi=?, lokasi=?, harga=?, gambar_url=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $nama_produk, $pemilik, $deskripsi, $lokasi, $harga, $gambar, $id);
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data UMKM berhasil diperbarui!";
        $tipe = "success";
    } else {
        $pesan = "Gagal memperbarui data UMKM.";
        $tipe = "danger";
    }
}

// Handle Hapus
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM umkm WHERE id=$id");
    $pesan = "Data UMKM berhasil dihapus.";
    $tipe = "warning";
}

// Edit mode
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $q = mysqli_query($koneksi, "SELECT * FROM umkm WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($q);
}

$q_umkm = mysqli_query($koneksi, "SELECT * FROM umkm ORDER BY tgl_tambah DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola UMKM - Admin Desa Bades</title>
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

        .thumb-umkm {
            width: 70px;
            height: 70px;
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
                <span class="page-title"><i class="fa-solid fa-store me-2 text-primary"></i> Kelola Potensi UMKM</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Produk UMKM
                </button>
                <div class="user-pill d-none d-md-flex">
                    <i class="fa-solid fa-user-tie"></i>
                    <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                </div>
            </div>
        </div>
        <div class="container-fluid p-4">
            <?php if ($pesan): ?><div id="phpFlash" data-type="<?= $tipe ?>" data-msg="<?= htmlspecialchars($pesan) ?>" style="display:none;"></div><?php endif; ?>

            <!-- Edit Form -->
            <?php if ($edit_data): ?>
                <div class="card border-warning border-2 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold"><i class="fa-solid fa-pen me-2"></i> Edit Data UMKM</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($edit_data['gambar_url']) ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Nama Produk / Usaha</label>
                                    <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($edit_data['nama_produk']) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Nama Pemilik</label>
                                    <input type="text" name="pemilik" class="form-control" value="<?= htmlspecialchars($edit_data['pemilik']) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Harga / Rentang Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?= htmlspecialchars($edit_data['harga']) ?>" placeholder="Rp 10.000 - Rp 50.000" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold small">Lokasi Produksi</label>
                                    <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($edit_data['lokasi']) ?>" placeholder="Dusun ... RT/RW ..." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Upload Gambar Baru (Opsional)</label>
                                    <input type="file" name="gambar_file" class="form-control" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold small">Deskripsi Produk</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($edit_data['deskripsi']) ?></textarea>
                                </div>
                                <div class="col-12 d-flex gap-2">
                                    <button type="submit" name="edit" class="btn btn-warning px-4"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                                    <a href="admin_umkm.php" class="btn btn-outline-secondary px-4">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tabel UMKM -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Produk & Pemilik</th>
                                    <th>Harga</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($r = mysqli_fetch_assoc($q_umkm)): ?>
                                    <tr>
                                        <td class="text-muted"><?= $no++ ?></td>
                                        <td><img src="<?= htmlspecialchars($r['gambar_url']) ?>" alt="" class="thumb-umkm" onerror="this.src='https://via.placeholder.com/70'"></td>
                                        <td>
                                            <div class="fw-bold text-primary"><?= htmlspecialchars($r['nama_produk']) ?></div>
                                            <div class="small text-muted"><i class="fa-solid fa-user me-1"></i> <?= htmlspecialchars($r['pemilik']) ?></div>
                                        </td>
                                        <td><span class="badge bg-success"><?= htmlspecialchars($r['harga']) ?></span></td>
                                        <td><small><?= htmlspecialchars($r['lokasi']) ?></small></td>
                                        <td>
                                            <a href="?edit=<?= $r['id'] ?>" class="btn btn-sm btn-outline-warning px-2" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-outline-danger px-2 btn-hapus-umkm" data-id="<?= $r['id'] ?>" data-nama="<?= htmlspecialchars($r['nama_produk'], ENT_QUOTES) ?>" title="Hapus"><i class="fa-solid fa-trash"></i></button>
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

    <!-- Modal Tambah UMKM -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header bg-light border-0">
                        <h5 class="modal-title fw-bold text-primary"><i class="fa-solid fa-store me-2"></i>Tambah Produk UMKM Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Nama Produk / Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="nama_produk" class="form-control bg-light" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Nama Pemilik <span class="text-danger">*</span></label>
                                <input type="text" name="pemilik" class="form-control bg-light" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted">Harga / Rentang Harga</label>
                                <input type="text" name="harga" class="form-control bg-light" placeholder="Rp 10.000 - Rp 50.000" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-muted">Lokasi Produksi</label>
                                <input type="text" name="lokasi" class="form-control bg-light" placeholder="Dusun ... RT/RW ..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Upload Foto Produk <span class="text-danger">*</span></label>
                                <input type="file" name="gambar_file" class="form-control bg-light" accept="image/*" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control bg-light" rows="4" placeholder="Jelaskan produk ini secara singkat..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm"><i class="fa-solid fa-save me-1"></i> Simpan UMKM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    const flash = document.getElementById('phpFlash');
    if (flash) {
        const t = flash.dataset.type;
        Swal.fire({
            icon: t === 'success' ? 'success' : (t === 'warning' ? 'warning' : 'error'),
            title: t === 'success' ? 'Berhasil!' : (t === 'warning' ? 'Dihapus!' : 'Gagal!'),
            text: flash.dataset.msg,
            timer: 2500, showConfirmButton: false, toast: true, position: 'top-end'
        });
    }
    document.querySelectorAll('.btn-hapus-umkm').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            Swal.fire({
                title: 'Hapus Produk UMKM?',
                html: `Produk <strong>${nama}</strong> akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) window.location.href = '?hapus=' + id;
            });
        });
    });
    </script>
</body>
</html>
