<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['warga_login'])) {
    header("Location: login_warga.php");
    exit();
}

$id_surat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nik_login = $_SESSION['warga_nik'];

// Ambil data surat beserta data penduduk
$query = "SELECT s.*, p.nama_lengkap, p.tempat_lahir, p.tanggal_lahir, p.jenis_kelamin, p.pekerjaan, p.agama, p.alamat, p.rt_rw 
          FROM layanan_surat s 
          JOIN penduduk p ON s.nik = p.nik 
          WHERE s.id_surat = $id_surat AND s.nik = '$nik_login' AND s.status = 'Selesai'";

$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    die("Surat tidak ditemukan atau belum selesai diproses.");
}

$data = mysqli_fetch_assoc($result);

// Format Tanggal Indonesia
$bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
$tgl_lahir_split = explode('-', $data['tanggal_lahir']);
$tgl_lahir_indo = $tgl_lahir_split[2] . ' ' . $bulan[(int)$tgl_lahir_split[1]] . ' ' . $tgl_lahir_split[0];

$tgl_sekarang = date('Y-m-d');
$tgl_sekarang_split = explode('-', $tgl_sekarang);
$tgl_surat_indo = $tgl_sekarang_split[2] . ' ' . $bulan[(int)$tgl_sekarang_split[1]] . ' ' . $tgl_sekarang_split[0];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Surat - <?= htmlspecialchars($data['jenis_surat']) ?></title>
    <!-- Library html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">

    <style>
        body {
            background-color: #525659;
            display: flex;
            justify-content: center;
            padding: 20px;
            font-family: "Times New Roman", Times, serif;
        }

        .a4-container {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .header-kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-kop h3,
        .header-kop h2,
        .header-kop p {
            margin: 0;
        }

        .header-kop h3 {
            font-size: 18px;
            font-weight: normal;
        }

        .header-kop h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .header-kop p {
            font-size: 14px;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 30px;
        }

        .judul-surat h4 {
            margin: 0;
            text-decoration: underline;
            font-size: 18px;
            text-transform: uppercase;
        }

        .judul-surat p {
            margin: 0;
            font-size: 14px;
        }

        .isi-surat {
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
        }

        .isi-surat .indent {
            text-indent: 40px;
        }

        table.biodata {
            width: 100%;
            margin-left: 40px;
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        table.biodata td {
            padding: 3px 0;
            vertical-align: top;
        }

        table.biodata td:first-child {
            width: 180px;
        }

        table.biodata td:nth-child(2) {
            width: 15px;
        }

        .ttd-box {
            width: 300px;
            float: right;
            text-align: center;
            margin-top: 50px;
            font-size: 16px;
        }

        .ttd-box .nama-kades {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Tombol download disembunyikan saat convert PDF */
        .controls {
            position: fixed;
            top: 20px;
            right: 20px;
        }

        .btn-download {
            background-color: #0f4c81;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-family: sans-serif;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="controls" id="controls">
        <button class="btn-download" onclick="unduhPDF()">Unduh PDF <svg style="width:16px; margin-left:5px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z" />
            </svg></button>
    </div>

    <!-- Area yang akan diconvert ke PDF -->
    <div class="a4-container" id="area-surat">
        <div class="header-kop">
            <h3>PEMERINTAH KABUPATEN LUMAJANG</h3>
            <h3>KECAMATAN PASIRIAN</h3>
            <h2>KANTOR KEPALA DESA BADES</h2>
            <p>Jalan Raya Bades No. 1 Kode Pos 67372</p>
        </div>

        <div class="judul-surat">
            <h4><?= htmlspecialchars($data['jenis_surat']) ?></h4>
            <p>Nomor: 470 / <?= str_pad($data['id_surat'], 3, '0', STR_PAD_LEFT) ?> / 427.910.15 / <?= date('Y') ?></p>
        </div>

        <div class="isi-surat">
            <p class="indent">Yang bertanda tangan di bawah ini, Kepala Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang, menerangkan dengan sebenarnya bahwa:</p>

            <table class="biodata">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><b><?= strtoupper(htmlspecialchars($data['nama_lengkap'])) ?></b></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['nik']) ?></td>
                </tr>
                <tr>
                    <td>Tempat, Tgl. Lahir</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['tempat_lahir']) ?>, <?= $tgl_lahir_indo ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['jenis_kelamin']) ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['agama']) ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['pekerjaan']) ?></td>
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($data['alamat']) ?> RT/RW <?= htmlspecialchars($data['rt_rw']) ?> Desa Bades</td>
                </tr>
            </table>

            <p class="indent">Orang tersebut di atas adalah benar-benar warga / penduduk yang berdomisili di Desa Bades. Surat keterangan ini dibuat dan diberikan kepadanya dengan keperluan:</p>

            <p style="text-align:center; font-weight:bold; text-decoration:underline; font-style:italic;">" <?= htmlspecialchars($data['keperluan']) ?> "</p>

            <p class="indent">Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya oleh pihak-pihak yang berkepentingan.</p>
        </div>

        <div class="ttd-box">
            Bades, <?= $tgl_surat_indo ?><br>
            Kepala Desa Bades
            <br>
            <div class="nama-kades">SAHID, S.A.P.</div>
        </div>
        <div style="clear:both;"></div>
    </div>

    <script>
        function unduhPDF() {
            // Sembunyikan tombol
            document.getElementById('controls').style.display = 'none';

            var element = document.getElementById('area-surat');
            var opt = {
                margin: 0,
                filename: 'Surat_<?= str_replace(" ", "_", $data['jenis_surat']) ?>_<?= $data['nik'] ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Proses download PDF
            html2pdf().set(opt).from(element).save().then(function() {
                // Tampilkan tombol kembali setelah download selesai
                document.getElementById('controls').style.display = 'block';
            });
        }

        // Opsional: Otomatis memicu fungsi download saat halaman terbuka
        // window.onload = function() { setTimeout(unduhPDF, 1000); }
    </script>
</body>

</html>