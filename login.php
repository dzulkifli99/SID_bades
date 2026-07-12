<?php
include "koneksi.php";
session_start();

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
    exit();
}

$pesan_swal = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']) ?? '';
    $password = $_POST['password'] ?? '';

    $q = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($koneksi, $q);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if (password_verify($password, $data['password'])) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $pesan_swal = 'Password yang Anda masukkan salah!';
        }
    } else {
        $pesan_swal = 'Username tidak ditemukan!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login Admin - SID Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(15, 76, 129, 0.2);
            width: 100%;
            max-width: 900px;
            display: flex;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .login-brand {
            flex: 1;
            background: linear-gradient(135deg, #0c3460 0%, #0f4c81 50%, #1a6db5 100%);
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            position: relative;
        }
        
        .login-brand::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://assets.promediateknologi.id/crop/0x0:0x0/1200x0/webp/photo/p1/882/2023/09/03/WhatsApp-Image-2023-09-03-at-194902-2548912262.jpeg') center/cover;
            opacity: 0.15;
            mix-blend-mode: overlay;
        }

        .login-form-side {
            flex: 1;
            padding: 50px;
            background: white;
            position: relative;
            z-index: 10;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 18px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(15, 76, 129, 0.1);
            border-color: #0f4c81;
            background: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0f4c81 0%, #1a6db5 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(15, 76, 129, 0.4);
            background: linear-gradient(135deg, #0c3460 0%, #0f4c81 100%);
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                margin: 20px;
            }

            .login-brand {
                padding: 40px 20px;
            }

            .login-form-side {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card animate__animated animate__zoomIn">
        <div class="login-brand">
            <div class="animate__animated animate__fadeInDown animate__delay-1s" style="position:relative; z-index:2;">
                <img src="assets/img/logolumajang.png" alt="Logo Lumajang" width="95" class="mb-4" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));">
                <h2 class="fw-bold mb-2">SID DESA BADES</h2>
                <p class="opacity-75 fw-300">Sistem Informasi Desa Terpadu<br>Kecamatan Pasirian, Lumajang</p>
            </div>
        </div>
        <div class="login-form-side">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-dark" style="color: #0f4c81 !important;">Panel Admin</h3>
                <p class="text-muted">Gunakan akses admin desa untuk masuk</p>
            </div>

            <form action="" method="post">
                <div class="mb-4">
                    <label class="form-label small fw-bold text-uppercase text-muted">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fa-solid fa-user" style="color: #0f4c81;"></i></span>
                        <input type="text" name="username" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label small fw-bold text-uppercase text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fa-solid fa-lock" style="color: #0f4c81;"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                    MASUK KE SISTEM <i class="fa-solid fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-5">
                <a href="index.php" class="text-decoration-none text-muted small"><i class="fa-solid fa-house me-1"></i> Kembali ke Beranda Warga</a>
                <br>
                <small class="text-muted mt-2 d-inline-block">&copy; <?= date('Y') ?> Pemerintah Desa Bades</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if ($pesan_swal): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: '<?= $pesan_swal ?>',
            confirmButtonColor: '#0f4c81',
            confirmButtonText: 'Coba Lagi'
        });
    </script>
    <?php endif; ?>
</body>

</html>