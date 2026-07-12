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
    } else {
        $pesan = "Gagal memperbarui pengaduan.";
        $tipe = "danger";
    }
}

// Handle hapus
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id=" . (int)$_GET['hapus']);
    $pesan = "Pengaduan berhasil dihapus.";
    $tipe = "warning";
}

$filter = isset($_GET['status']) ? $_GET['status'] : '';
$where = $filter ? "WHERE status='" . mysqli_real_escape_string($koneksi, $filter) . "'" : '';
$q = mysqli_query($koneksi, "SELECT * FROM pengaduan $where ORDER BY tgl_kirim DESC");

$total_baru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as n FROM pengaduan WHERE status='Baru'"))['n'];
$total_all = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as n FROM pengaduan"))['n'];
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
        body { font-family: 'Open Sans', sans-serif; background: #f1f5f9; margin: 0; }
        .pesan-preview { max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .modal-pesan-box { background: #f8fafc; border-left: 4px solid #0f4c81; border-radius: 6px; padding: 12px 16px; font-size: 0.88rem; }
        .balasan-box { background: #f0fdf4; border-left: 4px solid #22c55e; border-radius: 6px; padding: 10px 14px; font-size: 0.85rem; }
        .stat-badge { display:inline-flex; align-items:center; gap:6px; background:#fff; border-radius:20px; padding:6px 16px; font-size:13px; font-weight:700; box-shadow:0 1px 4px rgba(0,0,0,0.08); }
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
            <!-- Flash message via PHP (hidden, diambil JS untuk SweetAlert) -->
            <?php if ($pesan): ?>
            <div id="phpFlash" data-type="<?= $tipe ?>" data-msg="<?= htmlspecialchars($pesan) ?>" style="display:none;"></div>
            <?php endif; ?>

            <!-- Stat summary -->
            <div class="d-flex gap-3 mb-4 flex-wrap">
                <span class="stat-badge">
                    <i class="fa-solid fa-inbox text-primary"></i> Total: <strong><?= $total_all ?></strong>
                </span>
                <span class="stat-badge">
                    <i class="fa-solid fa-circle text-danger"></i> Baru: <strong class="text-danger"><?= $total_baru ?></strong>
                </span>
            </div>

            <!-- Filter Tabs -->
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <a href="admin_pengaduan.php" class="btn btn-sm <?= !$filter ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill">Semua</a>
                <a href="?status=Baru" class="btn btn-sm <?= $filter == 'Baru' ? 'btn-danger' : 'btn-outline-danger' ?> rounded-pill"><i class="fa-solid fa-circle-exclamation me-1"></i>Baru</a>
                <a href="?status=Dibaca" class="btn btn-sm <?= $filter == 'Dibaca' ? 'btn-secondary' : 'btn-outline-secondary' ?> rounded-pill">Dibaca</a>
                <a href="?status=Ditindaklanjuti" class="btn btn-sm <?= $filter == 'Ditindaklanjuti' ? 'btn-success' : 'btn-outline-success' ?> rounded-pill">Ditindaklanjuti</a>
            </div>

            <!-- Tabel Pengaduan -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th>Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Isi Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Balasan</th>
                                    <th style="width:100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                if (mysqli_num_rows($q) > 0):
                                    while ($r = mysqli_fetch_assoc($q)):
                                        $bdg = ['Baru' => 'bg-danger', 'Dibaca' => 'bg-secondary', 'Ditindaklanjuti' => 'bg-success'][$r['status']] ?? 'bg-secondary';
                                        $icon = ['Pengaduan' => 'fa-triangle-exclamation text-danger', 'Kritik' => 'fa-thumbs-down text-warning', 'Saran' => 'fa-lightbulb text-success'][$r['kategori']] ?? 'fa-comment text-muted';
                                ?>
                                <tr>
                                    <td class="text-muted text-center"><?= $no++ ?></td>
                                    <td>
                                        <div class="fw-bold" style="font-size:13px;"><?= htmlspecialchars($r['nama']) ?></div>
                                        <?php if ($r['no_hp']): ?><small class="text-muted"><i class="fa-solid fa-phone fa-xs me-1"></i><?= htmlspecialchars($r['no_hp']) ?></small><?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="fa-solid <?= $icon ?> me-1"></i><?= htmlspecialchars($r['kategori']) ?>
                                        </span>
                                    </td>
                                    <td><div class="pesan-preview text-muted small"><?= htmlspecialchars($r['pesan']) ?></div></td>
                                    <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($r['tgl_kirim'])) ?></small></td>
                                    <td><span class="badge <?= $bdg ?> px-2 py-1"><?= $r['status'] ?></span></td>
                                    <td>
                                        <?php if ($r['balasan']): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:10px;"><i class="fa-solid fa-check-circle me-1"></i>Sudah dibalas</span>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:11px;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Balas (buka modal) -->
                                        <button class="btn btn-sm btn-outline-primary px-2 me-1 btn-balas"
                                            data-id="<?= $r['id'] ?>"
                                            data-nama="<?= htmlspecialchars($r['nama'], ENT_QUOTES) ?>"
                                            data-kategori="<?= htmlspecialchars($r['kategori'], ENT_QUOTES) ?>"
                                            data-pesan="<?= htmlspecialchars($r['pesan'], ENT_QUOTES) ?>"
                                            data-status="<?= htmlspecialchars($r['status'], ENT_QUOTES) ?>"
                                            data-balasan="<?= htmlspecialchars($r['balasan'] ?? '', ENT_QUOTES) ?>"
                                            data-tgl="<?= date('d/m/Y H:i', strtotime($r['tgl_kirim'])) ?>"
                                            title="Balas / Update Status">
                                            <i class="fa-solid fa-reply"></i>
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-sm btn-outline-danger px-2 btn-hapus"
                                            data-id="<?= $r['id'] ?>"
                                            data-nama="<?= htmlspecialchars($r['nama'], ENT_QUOTES) ?>"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile;
                                else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-inbox fa-2x mb-2 d-block opacity-25"></i>
                                        Belum ada pengaduan masuk.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Balas Pengaduan -->
    <div class="modal fade" id="modalBalas" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" style="font-size:16px;">
                        <i class="fa-solid fa-reply text-primary me-2"></i> Balas Pengaduan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="formBalas">
                    <div class="modal-body">
                        <!-- Info pelapor -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:42px;height:42px;background:#e8f0fe;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;color:#0f4c81;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="fw-bold" id="modal-nama" style="font-size:14px;"></div>
                                <div class="text-muted small" id="modal-meta"></div>
                            </div>
                        </div>

                        <!-- Isi Pesan -->
                        <div class="modal-pesan-box mb-3">
                            <div class="text-muted small fw-bold mb-1">ISI PESAN:</div>
                            <div id="modal-pesan" style="white-space:pre-wrap;"></div>
                        </div>

                        <!-- Balasan sebelumnya (jika ada) -->
                        <div id="balasan-lama-wrap" class="balasan-box mb-3" style="display:none;">
                            <div class="text-success small fw-bold mb-1"><i class="fa-solid fa-check-circle me-1"></i>BALASAN SEBELUMNYA:</div>
                            <div id="modal-balasan-lama" style="white-space:pre-wrap; font-size:0.88rem;"></div>
                        </div>

                        <input type="hidden" name="id" id="modal-id">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Update Status</label>
                                <select name="status" id="modal-status" class="form-select form-select-sm">
                                    <option value="Baru">Baru</option>
                                    <option value="Dibaca">Dibaca</option>
                                    <option value="Ditindaklanjuti">Ditindaklanjuti</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-muted">Balasan Admin <span class="text-muted fw-normal">(opsional)</span></label>
                                <textarea name="balasan" id="modal-balasan-input" class="form-control form-control-sm" rows="3" placeholder="Tulis balasan untuk pelapor..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="update" class="btn btn-sm btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Tampilkan SweetAlert dari PHP flash message
    const flash = document.getElementById('phpFlash');
    if (flash) {
        const type = flash.dataset.type === 'warning' ? 'warning' : (flash.dataset.type === 'danger' ? 'error' : 'success');
        Swal.fire({
            icon: type,
            title: type === 'success' ? 'Berhasil!' : (type === 'warning' ? 'Dihapus!' : 'Gagal!'),
            text: flash.dataset.msg,
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    // Tombol Balas — isi modal
    document.querySelectorAll('.btn-balas').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('modal-id').value = this.dataset.id;
            document.getElementById('modal-nama').textContent = this.dataset.nama;
            document.getElementById('modal-meta').textContent = this.dataset.kategori + '  •  ' + this.dataset.tgl;
            document.getElementById('modal-pesan').textContent = this.dataset.pesan;
            document.getElementById('modal-balasan-input').value = this.dataset.balasan;
            // Set status select
            const sel = document.getElementById('modal-status');
            for (let o of sel.options) o.selected = (o.value === this.dataset.status);
            // Tampilkan balasan lama jika ada
            const wrap = document.getElementById('balasan-lama-wrap');
            if (this.dataset.balasan.trim()) {
                wrap.style.display = 'block';
                document.getElementById('modal-balasan-lama').textContent = this.dataset.balasan;
            } else {
                wrap.style.display = 'none';
            }
            new bootstrap.Modal(document.getElementById('modalBalas')).show();
        });
    });

    // Tombol Hapus — SweetAlert confirm
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            Swal.fire({
                title: 'Hapus Pengaduan?',
                html: `Pengaduan dari <strong>${nama}</strong> akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = '?hapus=' + id;
                }
            });
        });
    });

    // Konfirmasi sebelum simpan di modal
    document.getElementById('formBalas').addEventListener('submit', function(e) {
        // biarkan submit normal, flash message akan muncul setelah reload
    });
    </script>
</body>

</html>