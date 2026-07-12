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
        $q = mysqli_query($koneksi, "SELECT * FROM penduduk ORDER BY nama_lengkap ASC");
        $data = [];
        while ($r = mysqli_fetch_assoc($q)) $data[] = $r;
        echo json_encode(['data' => $data]);
        exit;
    }

    if ($action == 'add' || $action == 'edit') {
        $nik = mysqli_real_escape_string($koneksi, trim($_POST['nik']));
        $no_kk = mysqli_real_escape_string($koneksi, trim($_POST['no_kk']));
        $nama_lengkap = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
        $tempat_lahir = mysqli_real_escape_string($koneksi, trim($_POST['tempat_lahir']));
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));
        $rt_rw = mysqli_real_escape_string($koneksi, trim($_POST['rt_rw']));
        $agama = mysqli_real_escape_string($koneksi, trim($_POST['agama']));
        $status_perkawinan = mysqli_real_escape_string($koneksi, trim($_POST['status_perkawinan']));
        $pekerjaan = mysqli_real_escape_string($koneksi, trim($_POST['pekerjaan']));

        $old_nik = isset($_POST['old_nik']) ? $_POST['old_nik'] : '';

        if ($action == 'add') {
            // Cek NIK duplikat
            $cek = mysqli_query($koneksi, "SELECT nik FROM penduduk WHERE nik='$nik'");
            if (mysqli_num_rows($cek) > 0) {
                echo json_encode(['status' => 'error', 'msg' => 'NIK sudah terdaftar!']);
                exit;
            }
            $query = "INSERT INTO penduduk (nik, no_kk, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, agama, status_perkawinan, pekerjaan) 
                      VALUES ('$nik', '$no_kk', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$rt_rw', '$agama', '$status_perkawinan', '$pekerjaan')";
        } else {
            if ($nik != $old_nik) {
                $cek = mysqli_query($koneksi, "SELECT nik FROM penduduk WHERE nik='$nik'");
                if (mysqli_num_rows($cek) > 0) {
                    echo json_encode(['status' => 'error', 'msg' => 'NIK sudah digunakan oleh warga lain!']);
                    exit;
                }
            }
            $query = "UPDATE penduduk SET nik='$nik', no_kk='$no_kk', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', alamat='$alamat', rt_rw='$rt_rw', agama='$agama', status_perkawinan='$status_perkawinan', pekerjaan='$pekerjaan' WHERE nik='$old_nik'";
        }

        if (mysqli_query($koneksi, $query)) {
            echo json_encode(['status' => 'success', 'msg' => 'Data penduduk berhasil disimpan!']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Database error: ' . mysqli_error($koneksi)]);
        }
        exit;
    }

    if ($action == 'delete') {
        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
        // Pastikan tidak ada akun warga terkait, atau hapus juga
        mysqli_query($koneksi, "DELETE FROM warga_akun WHERE nik='$nik'");
        if (mysqli_query($koneksi, "DELETE FROM penduduk WHERE nik='$nik'")) {
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
    <title>Data Penduduk - Admin Desa Bades</title>
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
                <span class="page-title"><i class="fa-solid fa-users me-2 text-primary"></i> Master Data Penduduk</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm" onclick="showAddModal()">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Data
                </button>
                <div class="user-pill d-none d-md-flex">
                    <i class="fa-solid fa-user-tie"></i>
                    <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                </div>
            </div>
        </div>

        <div class="container-fluid p-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabelPenduduk" class="table table-hover align-middle w-100" style="font-size:13px;">
                            <thead class="table-light">
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>L/P</th>
                                    <th>Alamat</th>
                                    <th>Agama</th>
                                    <th>Pekerjaan</th>
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

    <!-- Modal Form -->
    <div class="modal fade" id="modalForm" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form id="formPenduduk">
                    <div class="modal-header border-bottom-0 bg-light">
                        <h5 class="modal-title fw-bold" id="modalTitle">Tambah Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4">
                        <input type="hidden" name="ajax_action" id="ajax_action" value="add">
                        <input type="hidden" name="old_nik" id="old_nik">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" id="nik" class="form-control form-control-sm" required pattern="\d{16}" title="Harus 16 digit angka">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nomor KK <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control form-control-sm" required pattern="\d{16}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-sm" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold text-muted">Alamat (Jalan/Dusun)</label>
                                <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">RT/RW</label>
                                <input type="text" name="rt_rw" id="rt_rw" class="form-control form-control-sm" placeholder="Contoh: 001/002" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Agama</label>
                                <select name="agama" id="agama" class="form-select form-select-sm" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Status Perkawinan</label>
                                <select name="status_perkawinan" id="status_perkawinan" class="form-select form-select-sm" required>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3 bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm" id="btnSave">
                            <i class="fa-solid fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
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
            // Initialize DataTables via AJAX
            dt = $('#tabelPenduduk').DataTable({
                ajax: {
                    url: 'admin_penduduk.php',
                    type: 'POST',
                    data: {
                        ajax_action: 'get_all'
                    }
                },
                columns: [{
                        data: 'nik'
                    },
                    {
                        data: 'nama_lengkap',
                        render: function(data, type, row) {
                            return '<div class="fw-bold">' + data + '</div>';
                        }
                    },
                    {
                        data: 'jenis_kelamin',
                        render: function(data) {
                            return data == 'Laki-laki' ? 'L' : 'P';
                        }
                    },
                    {
                        data: 'alamat',
                        render: function(data, type, row) {
                            return data + ' RT/RW ' + row.rt_rw;
                        }
                    },
                    {
                        data: 'agama'
                    },
                    {
                        data: 'pekerjaan'
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-outline-primary px-2" onclick='editData(${JSON.stringify(row)})' title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-outline-danger px-2" onclick="deleteData('${row.nik}')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </div>`;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            // Handle Form Submit
            $('#formPenduduk').on('submit', function(e) {
                e.preventDefault();
                $('#btnSave').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...');

                $.ajax({
                    url: 'admin_penduduk.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        $('#btnSave').prop('disabled', false).html('<i class="fa-solid fa-save me-1"></i> Simpan Data');
                        if (res.status == 'success') {
                            $('#modalForm').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            dt.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.msg
                            });
                        }
                    },
                    error: function() {
                        $('#btnSave').prop('disabled', false).html('<i class="fa-solid fa-save me-1"></i> Simpan Data');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Sistem',
                            text: 'Terjadi kesalahan pada server.'
                        });
                    }
                });
            });
        });

        function showAddModal() {
            $('#formPenduduk')[0].reset();
            $('#ajax_action').val('add');
            $('#old_nik').val('');
            $('#modalTitle').html('Tambah Data Penduduk');
            $('#modalForm').modal('show');
        }

        function editData(row) {
            $('#formPenduduk')[0].reset();
            $('#ajax_action').val('edit');
            $('#old_nik').val(row.nik);
            $('#modalTitle').html('Edit Data Penduduk');

            // Fill data
            $('#nik').val(row.nik);
            $('#no_kk').val(row.no_kk);
            $('#nama_lengkap').val(row.nama_lengkap);
            $('#tempat_lahir').val(row.tempat_lahir);
            $('#tanggal_lahir').val(row.tanggal_lahir);
            $('#jenis_kelamin').val(row.jenis_kelamin);
            $('#alamat').val(row.alamat);
            $('#rt_rw').val(row.rt_rw);
            $('#agama').val(row.agama);
            $('#status_perkawinan').val(row.status_perkawinan);
            $('#pekerjaan').val(row.pekerjaan);

            $('#modalForm').modal('show');
        }

        function deleteData(nik) {
            Swal.fire({
                title: 'Hapus Penduduk?',
                text: "Data yang dihapus tidak bisa dikembalikan, akun warga (jika ada) juga akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'admin_penduduk.php',
                        type: 'POST',
                        data: {
                            ajax_action: 'delete',
                            nik: nik
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                dt.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.msg
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>