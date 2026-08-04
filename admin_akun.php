<?php
include "koneksi.php";
if (!isset($_SESSION["is_login"])) { header("Location: login.php"); exit(); }

$pesan = $tipe = "";

// Handle ubah username & password
if (isset($_POST['update_akun'])) {
    verify_csrf_token();

    $username_baru = trim($_POST['username_baru']);
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $password_konfirmasi = $_POST['password_konfirmasi'];

    // Ambil data admin saat ini menggunakan Prepared Statement
    $cur_user = $_SESSION['username'];
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM admin WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $cur_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if (!$admin) {
        $pesan = "Akun tidak ditemukan."; $tipe = "danger";
    } elseif (!password_verify($password_lama, $admin['password'])) {
        $pesan = "Password lama tidak sesuai!"; $tipe = "danger";
    } elseif ($password_baru !== $password_konfirmasi) {
        $pesan = "Konfirmasi password baru tidak cocok!"; $tipe = "danger";
    } elseif (!empty($password_baru) && strlen($password_baru) < 8) {
        $pesan = "Password baru minimal 8 karakter!"; $tipe = "danger";
    } elseif (!empty($username_baru) && $username_baru !== $cur_user) {
        // Cek username baru tidak dipakai
        $cek_stmt = mysqli_prepare($koneksi, "SELECT id FROM admin WHERE username=?");
        mysqli_stmt_bind_param($cek_stmt, "s", $username_baru);
        mysqli_stmt_execute($cek_stmt);
        mysqli_stmt_store_result($cek_stmt);
        if (mysqli_stmt_num_rows($cek_stmt) > 0) {
            $pesan = "Username sudah digunakan oleh akun lain!"; $tipe = "danger";
        } else {
            if (!empty($password_baru)) {
                $hash = password_hash($password_baru, PASSWORD_BCRYPT);
                $upd = mysqli_prepare($koneksi, "UPDATE admin SET username=?, password=? WHERE username=?");
                mysqli_stmt_bind_param($upd, "sss", $username_baru, $hash, $cur_user);
            } else {
                $upd = mysqli_prepare($koneksi, "UPDATE admin SET username=? WHERE username=?");
                mysqli_stmt_bind_param($upd, "ss", $username_baru, $cur_user);
            }
            mysqli_stmt_execute($upd);
            $_SESSION['username'] = $username_baru;
            $pesan = "Akun berhasil diperbarui!"; $tipe = "success";
        }
    } elseif (!empty($password_baru)) {
        $hash = password_hash($password_baru, PASSWORD_BCRYPT);
        $upd = mysqli_prepare($koneksi, "UPDATE admin SET password=? WHERE username=?");
        mysqli_stmt_bind_param($upd, "ss", $hash, $cur_user);
        mysqli_stmt_execute($upd);
        $pesan = "Password berhasil diubah!"; $tipe = "success";
    } else {
        $pesan = "Tidak ada perubahan yang disimpan."; $tipe = "info";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Admin - SID Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { font-family:'Open Sans',sans-serif; background:#f1f5f9; margin:0; }
        .form-card { background:#fff; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); padding:32px; }
        .pw-toggle { cursor:pointer; position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#888; }
        .pw-wrap { position:relative; }
    </style>
</head>
<body>
<?php include "sidebar.php"; ?>
<div class="admin-main">
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm sidebar-toggle border-0" onclick="toggleSidebar()"><i class="fa-solid fa-bars fa-lg text-primary"></i></button>
            <span class="page-title"><i class="fa-solid fa-key me-2 text-primary"></i> Kelola Akun Admin</span>
        </div>
        <div class="user-pill">
            <i class="fa-solid fa-user-tie"></i>
            <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>
    </div>

    <div class="container-fluid p-4">
        <?php if ($pesan): ?>
        <div id="phpFlash" data-type="<?= $tipe ?>" data-msg="<?= htmlspecialchars($pesan) ?>" style="display:none;"></div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Info Akun -->
                <div class="form-card mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#0f4c81,#1a6db5);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff;">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:16px;"><?= htmlspecialchars($_SESSION['username']) ?></div>
                            <div class="text-muted small">Administrator Sistem · Desa Bades</div>
                        </div>
                    </div>

                    <form method="POST" id="formAkun">
                        <?= csrf_field(); ?>
                        <h6 class="fw-bold text-muted border-bottom pb-2 mb-3" style="font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">
                            <i class="fa-solid fa-pen me-1"></i> Ubah Username
                        </h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Username Baru <span class="text-muted fw-normal">(kosongkan jika tidak diubah)</span></label>
                            <input type="text" name="username_baru" class="form-control" 
                                   placeholder="<?= htmlspecialchars($_SESSION['username']) ?>"
                                   value="<?= htmlspecialchars($_SESSION['username']) ?>">
                        </div>

                        <h6 class="fw-bold text-muted border-bottom pb-2 mb-3 mt-4" style="font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">
                            <i class="fa-solid fa-lock me-1"></i> Ubah Password
                        </h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Saat Ini <span class="text-danger">*</span></label>
                            <div class="pw-wrap">
                                <input type="password" name="password_lama" id="pwLama" class="form-control pe-5" placeholder="Masukkan password saat ini" required>
                                <span class="pw-toggle" onclick="togglePw('pwLama',this)"><i class="fa-solid fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Baru <span class="text-muted fw-normal">(min. 8 karakter, kosongkan jika tidak diubah)</span></label>
                            <div class="pw-wrap">
                                <input type="password" name="password_baru" id="pwBaru" class="form-control pe-5" placeholder="Masukkan password baru" minlength="8">
                                <span class="pw-toggle" onclick="togglePw('pwBaru',this)"><i class="fa-solid fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                            <div class="pw-wrap">
                                <input type="password" name="password_konfirmasi" id="pwKonfirmasi" class="form-control pe-5" placeholder="Ulangi password baru" minlength="8">
                                <span class="pw-toggle" onclick="togglePw('pwKonfirmasi',this)"><i class="fa-solid fa-eye"></i></span>
                            </div>
                        </div>

                        <button type="submit" name="update_akun" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                            <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>


                <!-- Tips keamanan -->
                <div class="alert alert-info border-0 shadow-sm" style="border-radius:12px; font-size:13px;">
                    <i class="fa-solid fa-shield-halved me-2"></i>
                    <strong>Tips Keamanan:</strong> Gunakan password minimal 8 karakter, kombinasi huruf kapital, angka, dan simbol.
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function togglePw(id, el) {
    const input = document.getElementById(id);
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    el.innerHTML = isPassword ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
}

const flash = document.getElementById('phpFlash');
if (flash) {
    const t = flash.dataset.type;
    Swal.fire({
        icon: t === 'success' ? 'success' : (t === 'danger' ? 'error' : 'info'),
        title: t === 'success' ? 'Berhasil!' : (t === 'danger' ? 'Gagal!' : 'Info'),
        text: flash.dataset.msg,
        toast: true,
        position: 'top-end',
        timer: 3000,
        showConfirmButton: false
    });
}

document.getElementById('formAkun').addEventListener('submit', function(e) {
    const pwBaru = document.querySelector('input[name="password_baru"]').value;
    const pwKonfirmasi = document.querySelector('input[name="password_konfirmasi"]').value;
    if (pwBaru && pwBaru !== pwKonfirmasi) {
        e.preventDefault();
        Swal.fire({ icon:'error', title:'Password Tidak Cocok', text:'Konfirmasi password baru tidak sesuai.' });
    }
});
</script>
</body>
</html>
