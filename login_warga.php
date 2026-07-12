<?php
session_start();
include "koneksi.php";

$pesan = "";

if (isset($_POST['login'])) {
    $nik = trim($_POST['nik']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($koneksi, "SELECT w.password_hash, p.nama_lengkap FROM warga_akun w JOIN penduduk p ON w.nik = p.nik WHERE w.nik = ?");
    mysqli_stmt_bind_param($stmt, "s", $nik);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['warga_login'] = true;
            $_SESSION['warga_nik'] = $nik;
            $_SESSION['warga_nama'] = $row['nama_lengkap'];
            header("Location: dashboard_warga.php");
            exit();
        } else {
            $pesan = "Password yang Anda masukkan salah.";
        }
    } else {
        $pesan = "Akun tidak ditemukan. Pastikan Anda sudah mendaftar.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Layanan Mandiri - Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f4c81; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Open Sans', sans-serif;}
        .login-box { width: 100%; max-width: 400px; padding: 20px; }
        .card { border-radius: 10px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .brand-logo { width: 70px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="card p-4">
            <div class="text-center mb-4">
                <img src="assets/img/logolumajang.png" alt="Logo" class="brand-logo">
                <h4 class="fw-bold text-dark">Portal Warga</h4>
                <p class="text-muted small">Layanan Mandiri Desa Bades</p>
            </div>
            
            <?php if($pesan != ""): ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: '<?= $pesan ?>',
                            confirmButtonColor: '#0f4c81'
                        });
                    });
                </script>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Kata Sandi (PIN)</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Sandi" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 fw-bold" style="background-color: #0f4c81; border: none;">Masuk</button>
            </form>
            
            <div class="text-center mt-4">
                <span class="small text-muted">Belum memiliki akses? <a href="register_warga.php" class="text-decoration-none fw-bold" style="color: #0f4c81;">Daftar Akun</a></span><br><br>
                <a href="layanan.php" class="small text-decoration-none text-secondary">&larr; Kembali ke halaman awal</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
