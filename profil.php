<?php
session_start();
include "koneksi.php";

// Query untuk mendapatkan data Kades
$q_kades = mysqli_query($koneksi, "SELECT nama, foto FROM struktur_desa WHERE kategori='kepala_desa' LIMIT 1");
$data_kades = mysqli_fetch_assoc($q_kades);
$nama_kades = $data_kades['nama'] ?? 'SAHID, S.A.P.';

// Data Monografi Desa (diupdate dari admin_demografi.php)
$mono = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM monografi_desa ORDER BY id DESC LIMIT 1"));
if (!$mono) {
    $mono = [
        'bulan_data'=>'Mei','tahun_data'=>'2026','tipologi_desa'=>'Pertanian','tingkat_perkembangan'=>'Mandiri','luas_wilayah'=>'44,63 KM²',
        'jumlah_rt'=>58,'jumlah_rw'=>12,'batas_utara'=>'Desa Pasirian','batas_timur'=>'Desa Bagu','batas_barat'=>'Desa Gondoruso','batas_selatan'=>'Samudra Hindia',
        'agama_islam'=>11967,'agama_kristen'=>111,
        'pend_sd'=>1200,'pend_sltp'=>700,'pend_slta'=>500,'pend_diploma'=>50,'pend_sarjana'=>250,'pend_pasca'=>20,
        'kesehatan_puskesmas'=>1,'kesehatan_pustu'=>1,'kesehatan_ponkendes'=>1,
        'kerja_tni_polri_pns'=>7,'kerja_petani'=>5551,'kerja_buruh_tani'=>622,'kerja_nelayan'=>130,'kerja_wiraswasta'=>927,'kerja_karyawan_swasta'=>725,
        'ibadah_masjid'=>7,'ibadah_musholah'=>73,'ibadah_gereja'=>2,
        'kembang_lahir'=>7,'kembang_mati'=>10,'kembang_pindah_datang'=>15,'kembang_pindah_keluar'=>11,'kembang_nikah'=>6,
        'fas_paud'=>2,'fas_tk'=>6,'fas_sd'=>6,'fas_smp'=>1,'fas_sma'=>1,
    ];
}

// Jumlah KK / Laki-laki / Perempuan bersumber dari statistik_desa (sinkron dengan beranda)
$stat_desa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM statistik_desa LIMIT 1"));
$mono_jml_laki = $stat_desa['jumlah_laki'] ?? 5823;
$mono_jml_perempuan = $stat_desa['jumlah_perempuan'] ?? 6292;
$mono_jml_kk = $stat_desa['jumlah_kk'] ?? 3987;
$mono_jml_penduduk = $mono_jml_laki + $mono_jml_perempuan;

function n_id($n) { return number_format((float)$n, 0, ',', '.'); }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Desa Bades</title>
    <link rel="icon" href="assets/img/logolumajang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .top-bar {
            background-color: #0f4c81;
            color: #fff;
            font-size: 13px;
            padding: 8px 0;
        }

        .top-bar a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }

        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }

        .navbar-brand .brand-title {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            margin: 0;
            line-height: 1.2;
        }

        .navbar-brand .brand-subtitle {
            font-size: 12px;
            color: #666;
            margin: 0;
        }

        .nav-item .nav-link {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 15px;
            text-transform: uppercase;
        }

        .nav-item .nav-link:hover,
        .nav-item .nav-link.active {
            color: #0f4c81;
        }

        .page-header {
            background: #0f4c81;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .footer {
            background-color: #222;
            color: #ccc;
            padding: 40px 0 20px;
            font-size: 13px;
            margin-top: 50px;
        }

        .footer h4 {
            color: #fff;
            font-size: 16px;
            margin-bottom: 20px;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }

        .footer ul {
            padding: 0;
            list-style: none;
        }

        .footer ul li {
            margin-bottom: 8px;
        }

        .footer ul li a {
            color: #ccc;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: #fff;
        }

        .footer-bottom {
            background-color: #111;
            padding: 15px 0;
            color: #888;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php include "komponen_navbar.php"; ?>
    <?php include "komponen_hero.php";
    ?>

    <?php $stats_small = true;
    include "komponen_stats.php";
    ?>
    <div class="container mt-5 mb-5">
        <!-- Sambutan Kepala Desa di Tengah Atas dengan layout berdampingan -->
        <div class="row justify-content-center mb-5" data-aos="zoom-in">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="border-bottom pb-3 mb-4 text-center">
                            </>Sambutan Kepala Desa</h4>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <img src="assets/img/struktur/kades.png" alt="Foto Kepala Desa" class="img-fluid rounded-circle border border-4 border-primary shadow" style="width: 200px; height: 200px; object-fit: cover;">
                                <h5 class="mt-3 fw-bold text-dark mb-1"><?= htmlspecialchars($nama_kades) ?></h5>
                                <p class="text-muted small mb-0">Kepala Desa Bades</p>
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 p-md-4 bg-light rounded border-start border-4 border-primary shadow-sm" style="font-size: 15.5px; line-height: 1.8;">
                                    <p class="mb-0" style="font-style: italic; color: #475569;">
                                        "Assalamu'alaikum Warahmatullahi Wabarakatuh.<br><br>
                                        Selamat datang di website resmi Desa Bades. Kami berharap website ini dapat menjadi jembatan informasi dan mempermudah pelayanan bagi seluruh masyarakat Desa Bades. Mari bersama-sama membangun desa yang kita cintai agar lebih maju, sejahtera, dan bermartabat."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Sejarah Desa Bades</h4>
                        <p style="line-height:1.7; text-align:justify;">Desa Bades memiliki sejarah panjang yang diwarnai oleh semangat gotong royong dan kebersamaan masyarakatnya. Awalnya, desa ini merupakan kawasan pertanian yang subur dengan aliran air yang melimpah, menjadikannya tempat bermukim yang ideal bagi pendatang dari berbagai daerah.</p>
                        <p style="line-height:1.7; text-align:justify;">Hingga kini, Desa Bades terus berkembang menjadi desa yang maju, mandiri, dan berbudaya dengan tetap mempertahankan kearifan lokal yang telah diwariskan secara turun-temurun.</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-bullseye text-primary me-2"></i>Visi & Misi Desa Bades</h4>
                        <h5 class="fw-bold text-dark mb-2">Visi</h5>
                        <p class="fs-6 p-3 bg-light rounded border-start border-4 border-primary" style="font-style: italic; color: #0f4c81;">"Mewujudkan Masyarakat Desa Bades yang Religius, Cerdas, Mandiri, Sejahtera, dan Bermartabat."</p>
                        <h5 class="fw-bold text-dark mt-4 mb-3">Misi</h5>
                        <ol style="line-height: 1.8; font-size: 14.5px;" class="ps-3 text-secondary">
                            <li class="mb-2">Meningkatkan kegiatan keagamaan.</li>
                            <li class="mb-2">Memberikan rasa aman,nyaman,dan tentram kepada masyarakt desa bades.</li>
                            <li class="mb-2">Meningkatkan kinerja dan pelayanan aparat desa yang berkualitas, profesional,prima dan transparan.</li>
                            <li class="mb-2">Mengembangkan perekonomian desa melalui UMKM, BUMDes dan Usaha lainnya serta pengembangan minat dan bakat.</li>
                            <li class="mb-2">Meningkatkan program pendidikan, kesehatan, sosial budaya, pertanian, dan lembaga kemanusiaan.</li>
                            <li class="mb-2">Meningkatkan program pendidikan, kesehatan, sosial budaya, pertanian, dan lembaga kemanusiaan.</li>
                        </ol>
                    </div>
                </div>

                <!-- Card Monografi -->
                <div class="card border-0 shadow-sm rounded-0 mb-4" data-aos="fade-up">
                    <div class="card-header bg-primary text-white p-3">
                        <h4 class="mb-0 text-white"><i class="fa-solid fa-chart-bar me-2"></i>Monografi Desa Bades</h4>
                        <small class="text-white-50">Keadaan Pada Bulan: <?= htmlspecialchars(strtoupper($mono['bulan_data'])) ?> | Tahun: <?= htmlspecialchars($mono['tahun_data']) ?></small>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Data Wilayah -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">1. Data Wilayah & Administrasi</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td width="55%">Tipologi Desa</td>
                                        <td>: <?= htmlspecialchars($mono['tipologi_desa']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Perkembangan</td>
                                        <td>: <?= htmlspecialchars($mono['tingkat_perkembangan']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Luas Wilayah</td>
                                        <td>: <?= htmlspecialchars($mono['luas_wilayah']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah RT</td>
                                        <td>: <?= (int)$mono['jumlah_rt'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah RW</td>
                                        <td>: <?= (int)$mono['jumlah_rw'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Batas Utara</td>
                                        <td>: <?= htmlspecialchars($mono['batas_utara']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Batas Timur</td>
                                        <td>: <?= htmlspecialchars($mono['batas_timur']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Batas Barat</td>
                                        <td>: <?= htmlspecialchars($mono['batas_barat']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Batas Selatan</td>
                                        <td>: <?= htmlspecialchars($mono['batas_selatan']) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Data Kependudukan -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">2. Data Kependudukan & Agama</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td width="55%">Jumlah Kepala Keluarga</td>
                                        <td>: <?= n_id($mono_jml_kk) ?> KK</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Penduduk</td>
                                        <td>: <?= n_id($mono_jml_penduduk) ?> Jiwa</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">a. Laki-Laki</td>
                                        <td>: <?= n_id($mono_jml_laki) ?> Jiwa</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Perempuan</td>
                                        <td>: <?= n_id($mono_jml_perempuan) ?> Jiwa</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-semibold text-dark mt-2 d-inline-block">Agama / Keyakinan:</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">a. Islam</td>
                                        <td>: <?= n_id($mono['agama_islam']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Kristen</td>
                                        <td>: <?= n_id($mono['agama_kristen']) ?> Orang</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Tingkat Pendidikan & Fasilitas Kesehatan -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">3. Pendidikan & Kesehatan</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td colspan="2" class="fw-semibold text-dark">Tingkat Pendidikan:</td>
                                    </tr>
                                    <tr>
                                        <td width="55%" class="ps-3 text-secondary">a. SD</td>
                                        <td>: <?= n_id($mono['pend_sd']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. SLTP</td>
                                        <td>: <?= n_id($mono['pend_sltp']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. SLTA</td>
                                        <td>: <?= n_id($mono['pend_slta']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">d. Diploma</td>
                                        <td>: <?= n_id($mono['pend_diploma']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">e. Sarjana</td>
                                        <td>: <?= n_id($mono['pend_sarjana']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">f. Pasca Sarjana</td>
                                        <td>: <?= n_id($mono['pend_pasca']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-semibold text-dark mt-2 d-inline-block">Fasilitas Kesehatan:</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">a. Puskesmas</td>
                                        <td>: <?= n_id($mono['kesehatan_puskesmas']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Pustu</td>
                                        <td>: <?= n_id($mono['kesehatan_pustu']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. Ponkendes</td>
                                        <td>: <?= n_id($mono['kesehatan_ponkendes']) ?> Buah</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Pekerjaan & Prasarana -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">4. Pekerjaan & Prasarana Ibadah</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td colspan="2" class="fw-semibold text-dark">Pekerjaan:</td>
                                    </tr>
                                    <tr>
                                        <td width="55%" class="ps-3 text-secondary">a. TNI/POLRI/PNS</td>
                                        <td>: <?= n_id($mono['kerja_tni_polri_pns']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Petani</td>
                                        <td>: <?= n_id($mono['kerja_petani']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. Buruh Tani</td>
                                        <td>: <?= n_id($mono['kerja_buruh_tani']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">d. Nelayan</td>
                                        <td>: <?= n_id($mono['kerja_nelayan']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">e. Wiraswasta</td>
                                        <td>: <?= n_id($mono['kerja_wiraswasta']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">f. Karyawan Swasta</td>
                                        <td>: <?= n_id($mono['kerja_karyawan_swasta']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw-semibold text-dark mt-2 d-inline-block">Prasarana Ibadah:</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">a. Masjid</td>
                                        <td>: <?= n_id($mono['ibadah_masjid']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Musholah</td>
                                        <td>: <?= n_id($mono['ibadah_musholah']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. Gereja</td>
                                        <td>: <?= n_id($mono['ibadah_gereja']) ?> Buah</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Perkembangan Penduduk & Fasilitas Pendidikan -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">5. Perkembangan Penduduk</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td width="55%" class="ps-3 text-secondary">a. Kelahiran</td>
                                        <td>: <?= n_id($mono['kembang_lahir']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. Kematian</td>
                                        <td>: <?= n_id($mono['kembang_mati']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. Pindah Datang</td>
                                        <td>: <?= n_id($mono['kembang_pindah_datang']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">d. Pindah Keluar</td>
                                        <td>: <?= n_id($mono['kembang_pindah_keluar']) ?> Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">e. Nikah</td>
                                        <td>: <?= n_id($mono['kembang_nikah']) ?> Orang</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 text-primary fw-bold" style="font-size: 16px;">6. Fasilitas Pendidikan</h5>
                                <table class="table table-sm table-borderless mb-0" style="font-size: 14.5px;">
                                    <tr>
                                        <td width="55%" class="ps-3 text-secondary">a. PAUD</td>
                                        <td>: <?= n_id($mono['fas_paud']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">b. TK/RA</td>
                                        <td>: <?= n_id($mono['fas_tk']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">c. SD/MI</td>
                                        <td>: <?= n_id($mono['fas_sd']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">d. SMP/MTs</td>
                                        <td>: <?= n_id($mono['fas_smp']) ?> Buah</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 text-secondary">e. SMA/MA</td>
                                        <td>: <?= n_id($mono['fas_sma']) ?> Buah</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "komponen_footer.php"; ?>
</body>

</html>