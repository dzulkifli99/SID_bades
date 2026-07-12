<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

// --- AJAX HANDLER ---
if (isset($_POST['ajax_action'])) {
    header('Content-Type: application/json');
    $action = $_POST['ajax_action'];

    if ($action == 'get_all') {
        $q = mysqli_query($koneksi, "SELECT w.*, p.nama_lengkap, p.rt_rw FROM warga_akun w JOIN penduduk p ON w.nik = p.nik ORDER BY w.created_at DESC");
        $data = [];
        while ($r = mysqli_fetch_assoc($q)) $data[] = $r;
        echo json_encode(['data' => $data]);
        exit;
    }

    if ($action == 'reset_password') {
        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
        $new_pass = $_POST['new_password'];
        $hash = password_hash($new_pass, PASSWORD_BCRYPT);

        if (mysqli_query($koneksi, "UPDATE warga_akun SET password_hash='$hash' WHERE nik='$nik'")) {
            echo json_encode(['status' => 'success', 'msg' => 'Password berhasil direset!']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Gagal reset password: ' . mysqli_error($koneksi)]);
        }
        exit;
    }

    if ($action == 'delete') {
        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
        if (mysqli_query($koneksi, "DELETE FROM warga_akun WHERE nik='$nik'")) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => mysqli_error($koneksi)]);
        }
        exit;
    }
}
// --- END AJAX HANDLER ---
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Warga - Admin Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                <span class="page-title"><i class="fa-solid fa-user-lock me-2 text-danger"></i> Kelola Akun Warga</span>
            </div>
            <div class="user-pill">
                <i class="fa-solid fa-user-tie"></i>
                <span class="d-none d-sm-inline"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>

        <div class="container-fluid p-4">
            <div class="alert alert-info py-2" style="font-size:13px;">
                <i class="fa-solid fa-circle-info me-2"></i> Di sini Admin dapat menghapus akun warga atau mereset password mereka jika lupa. (Pendaftaran akun dilakukan mandiri oleh warga).
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabelAkun" class="table table-hover align-middle w-100" style="font-size:13px;">
                            <thead class="table-light">
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>RT/RW</th>
                                    <th>Tgl Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let dt;
        $(document).ready(function() {
            dt = $('#tabelAkun').DataTable({
                ajax: {
                    url: 'admin_akun_warga.php',
                    type: 'POST',
                    data: {
                        ajax_action: 'get_all'
                    }
                },
                columns: [{
                        data: 'nik',
                        render: function(d) {
                            return '<code>' + d + '</code>';
                        }
                    },
                    {
                        data: 'nama_lengkap',
                        render: function(d) {
                            return '<div class="fw-bold">' + d + '</div>';
                        }
                    },
                    {
                        data: 'rt_rw'
                    },
                    {
                        data: 'created_at',
                        render: function(d) {
                            return d ? d.split(' ')[0] : '-';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-outline-warning px-2" onclick="resetPassword('${row.nik}')" title="Reset Password"><i class="fa-solid fa-key"></i></button>
                        <button class="btn btn-sm btn-outline-danger px-2" onclick="deleteAkun('${row.nik}')" title="Hapus Akun"><i class="fa-solid fa-trash"></i></button>
                    </div>`;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });

        async function resetPassword(nik) {
            const {
                value: newPass
            } = await Swal.fire({
                title: 'Reset Password',
                input: 'password',
                inputLabel: 'Masukkan Password Baru',
                inputPlaceholder: 'Minimal 6 karakter',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Simpan',
                inputValidator: (value) => {
                    if (!value || value.length < 6) return 'Password minimal 6 karakter!'
                }
            });

            if (newPass) {
                $.post('admin_akun_warga.php', {
                    ajax_action: 'reset_password',
                    nik: nik,
                    new_password: newPass
                }, function(res) {
                    if (res.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.msg,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire('Gagal', res.msg, 'error');
                    }
                }, 'json');
            }
        }

        function deleteAkun(nik) {
            Swal.fire({
                title: 'Hapus Akun Warga?',
                text: "Warga ini tidak akan bisa login lagi sebelum mendaftar ulang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Aksesnya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('admin_akun_warga.php', {
                        ajax_action: 'delete',
                        nik: nik
                    }, function(res) {
                        if (res.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            dt.ajax.reload(null, false);
                        } else {
                            Swal.fire('Gagal', res.msg, 'error');
                        }
                    }, 'json');
                }
            });
        }
    </script>
</body>

</html>