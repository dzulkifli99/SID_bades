<?php
session_start();
include "koneksi.php";

$pesan = "";
$tipe = "";

if (isset($_POST['register'])) {
    $nik = trim($_POST['nik']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $pesan = "Password dan Konfirmasi Password tidak cocok!";
        $tipe = "danger";
    } else {
        // Cek apakah NIK terdaftar di database penduduk
        $stmt_cek_warga = mysqli_prepare($koneksi, "SELECT nama_lengkap FROM penduduk WHERE nik = ?");
        mysqli_stmt_bind_param($stmt_cek_warga, "s", $nik);
        mysqli_stmt_execute($stmt_cek_warga);
        mysqli_stmt_store_result($stmt_cek_warga);

        if (mysqli_stmt_num_rows($stmt_cek_warga) == 0) {
            $pesan = "Maaf, NIK Anda tidak terdaftar sebagai warga Desa Bades.";
            $tipe = "danger";
        } else {
            // Cek apakah akun sudah pernah dibuat
            $stmt_cek_akun = mysqli_prepare($koneksi, "SELECT nik FROM warga_akun WHERE nik = ?");
            mysqli_stmt_bind_param($stmt_cek_akun, "s", $nik);
            mysqli_stmt_execute($stmt_cek_akun);
            mysqli_stmt_store_result($stmt_cek_akun);

            if (mysqli_stmt_num_rows($stmt_cek_akun) > 0) {
                $pesan = "NIK ini sudah memiliki akun layanan mandiri. Silakan langsung login.";
                $tipe = "warning";
            } else {
                // Buat akun baru
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt_insert = mysqli_prepare($koneksi, "INSERT INTO warga_akun (nik, password_hash) VALUES (?, ?)");
                mysqli_stmt_bind_param($stmt_insert, "ss", $nik, $hash);
                
                if (mysqli_stmt_execute($stmt_insert)) {
                    $pesan = "Pendaftaran berhasil! Silakan login untuk menggunakan layanan.";
                    $tipe = "success";
                } else {
                    $pesan = "Terjadi kesalahan sistem saat mendaftar.";
                    $tipe = "danger";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Warga - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Open Sans', sans-serif;}
        .register-box { width: 100%; max-width: 450px; padding: 20px; }
        .card { border-radius: 10px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .brand-logo { width: 60px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="register-box">
        <div class="card p-4">
            <div class="text-center mb-4">
                <img src="assets/img/logolumajang.png" alt="Logo" class="brand-logo">
                <h4 class="fw-bold">Pendaftaran Layanan Mandiri</h4>
                <p class="text-muted small">Hanya untuk Warga Desa Bades</p>
            </div>
            
            <?php if($pesan != ""): ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: '<?= $tipe == "success" ? "success" : ($tipe == "warning" ? "warning" : "error") ?>',
                            title: '<?= $tipe == "success" ? "Berhasil!" : "Informasi" ?>',
                            text: '<?= $pesan ?>',
                            confirmButtonColor: '#0d6efd'
                        }).then((result) => {
                            <?php if($tipe == 'success' || $tipe == 'warning'): ?>
                            window.location.href = 'login_warga.php';
                            <?php endif; ?>
                        });
                    });
                </script>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" name="nik" class="form-control" placeholder="16 Digit NIK Anda" required>
                    <div class="form-text" style="font-size: 11px;">Sistem akan memvalidasi NIK dengan data Disdukcapil Desa.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Buat Kata Sandi (PIN)</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirm" class="form-control" placeholder="Ketik ulang kata sandi" required minlength="6">
                </div>
                <button type="submit" name="register" class="btn btn-primary w-100 fw-bold">Daftar Akun</button>
            </form>
            
            <div class="text-center mt-4">
                <span class="small text-muted">Sudah punya akun? <a href="login_warga.php" class="text-decoration-none fw-bold">Masuk di sini</a></span><br><br>
                <a href="layanan.php" class="small text-decoration-none text-secondary">&larr; Kembali ke halaman awal</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
