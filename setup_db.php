<?php
include "koneksi.php";

echo "<pre>";

// Tabel berita
$sql = "CREATE TABLE IF NOT EXISTS berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT NOT NULL,
    gambar_url VARCHAR(500),
    kategori VARCHAR(100) DEFAULT 'Umum',
    penulis VARCHAR(100) DEFAULT 'Admin Desa',
    tgl_publikasi DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Publikasi','Draft') DEFAULT 'Publikasi'
)";
mysqli_query($koneksi, $sql) ? print("✅ Tabel berita OK\n") : print("❌ "  . mysqli_error($koneksi) . "\n");

// Tabel pengaduan
$sql = "CREATE TABLE IF NOT EXISTS pengaduan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20),
    kategori ENUM('Pengaduan','Kritik','Saran') DEFAULT 'Pengaduan',
    pesan TEXT NOT NULL,
    status ENUM('Baru','Dibaca','Ditindaklanjuti') DEFAULT 'Baru',
    balasan TEXT NULL,
    tgl_kirim DATETIME DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($koneksi, $sql) ? print("✅ Tabel pengaduan OK\n") : print("❌ " . mysqli_error($koneksi) . "\n");

// Seed berita perdana
$cek = mysqli_query($koneksi, "SELECT id FROM berita LIMIT 1");
if (mysqli_num_rows($cek) == 0) {
    $berita = [
        ["Karnaval Budaya HUT RI Desa Bades Pasirian, Suguhkan Tari Tradisional Hingga Cerita Rakyat",
         "Pemerintah Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang sukses menggelar Karnaval Budaya dalam rangka memperingati Hari Ulang Tahun (HUT) Kemerdekaan Republik Indonesia. Acara yang berlangsung meriah ini diikuti oleh ribuan warga dari berbagai dusun.\n\nKarnaval tahun ini mengusung tema \"Melestarikan Budaya Lokal di Era Modernisasi\". Kepala Desa Bades, Bpk. Sahid, S.A.P., secara langsung melepas rombongan peserta karnaval di garis start yang berlokasi di lapangan desa setempat.\n\n\"Kegiatan ini bukan hanya sekadar perayaan kemerdekaan, tetapi juga menjadi ajang silaturahmi akbar bagi seluruh warga Desa Bades. Melalui karnaval budaya ini, kita harapkan generasi muda tidak melupakan akar budaya dan kesenian tradisional yang kita miliki,\" ujar Bpk. Sahid dalam sambutannya.\n\nSepanjang rute yang melintasi jalan raya utama desa, penonton disuguhi berbagai penampilan spektakuler. Ada kesenian Tari Godril khas Lumajang, teatrikal perjuangan pahlawan kemerdekaan, hingga parade hasil bumi.",
         "https://assets.promediateknologi.id/crop/0x0:0x0/1200x0/webp/photo/p1/882/2023/09/03/WhatsApp-Image-2023-09-03-at-194902-2548912262.jpeg",
         "Sosial & Budaya", "2026-07-05 10:00:00"],
        ["Penyaluran Bantuan Langsung Tunai (BLT) Dana Desa Tahap III Berjalan Lancar",
         "Pemerintah Desa Bades kembali menyalurkan Bantuan Langsung Tunai (BLT) Dana Desa tahap III kepada warga yang berhak menerima. Penyaluran berlangsung di Balai Desa Bades dan dipantau langsung oleh Kepala Desa beserta perangkat desa.\n\nProses penyaluran berjalan tertib dan lancar. Warga penerima manfaat diminta membawa Kartu Tanda Penduduk (KTP) dan kartu penerima BLT sebagai syarat pencairan. Total penerima BLT-DD di Desa Bades pada tahap ini sebanyak 120 Keluarga Penerima Manfaat (KPM).\n\nKepala Desa Sahid, S.A.P. berharap bantuan ini dapat meringankan beban ekonomi warga dan digunakan sebaik mungkin untuk kebutuhan dasar keluarga.",
         "https://humas.polri.go.id/api/article-files/viewer/1000482179_605919.jpg",
         "Pemerintahan", "2026-07-10 09:00:00"],
        ["Kerja Bakti Bersih Saluran Air Warga Dusun Purut Sambut Musim Penghujan",
         "Dalam rangka mengantisipasi datangnya musim penghujan, warga Dusun Purut bersama Babinsa setempat menggelar kegiatan Kerja Bakti Massal membersihkan saluran drainase dan gorong-gorong yang tersumbat.\n\nKegiatan yang berlangsung serentak ini melibatkan puluhan warga dari berbagai RT/RW. Babinsa Desa Bades turut berbaur bersama warga mengangkat sampah dan lumpur yang menyumbat saluran air.\n\nKegiatan gotong royong ini merupakan bentuk nyata kebersamaan masyarakat Desa Bades. Diharapkan dengan normalnya aliran air di saluran drainase, risiko banjir dan genangan air saat musim hujan dapat diminimalisir.",
         "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo9MqcAhMd2i138Af6DLtZwk0RJ-KZWRgpLwiuo-3qqig3SDtDfHGPItg&s=10",
         "Infrastruktur", "2026-07-08 08:00:00"],
        ["Pelantikan Perangkat Desa Bades Hasil Seleksi Penjaringan 2025",
         "Pemerintah Desa Bades secara resmi melantik perangkat desa hasil seleksi penjaringan dan penyaringan yang telah dilaksanakan. Pelantikan dipimpin langsung oleh Kepala Desa Bades, Bpk. Sahid, S.A.P., yang dihadiri oleh Camat Pasirian dan tokoh masyarakat setempat.\n\nPerangkat desa yang dilantik pada kesempatan tersebut antara lain: Ibu Umi Habibah sebagai Kaur Keuangan, Bpk. Choirul Fahmi sebagai Kaur Perencanaan, dan Bpk. Moh. Irfan Maulana sebagai Kepala Dusun Tabon.\n\nKepala Desa berpesan agar para perangkat yang baru dilantik dapat segera beradaptasi dan memberikan pelayanan terbaik kepada masyarakat Desa Bades.",
         "https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop",
         "Pemerintahan", "2025-09-15 10:00:00"],
    ];
    
    foreach ($berita as $b) {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO berita (judul, konten, gambar_url, kategori, tgl_publikasi) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $b[0], $b[1], $b[2], $b[3], $b[4]);
        mysqli_stmt_execute($stmt);
    }
    echo "✅ Data berita perdana berhasil dimasukkan (4 artikel)\n";
} else {
    echo "ℹ️ Data berita sudah ada, dilewati.\n";
}

echo "\nSetup CMS selesai!\n";
echo "</pre>";
?>
