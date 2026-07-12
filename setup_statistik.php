<?php
include "koneksi.php";

// Create table
$sql = "CREATE TABLE IF NOT EXISTS statistik_desa (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    jumlah_laki INT(11) NOT NULL,
    jumlah_perempuan INT(11) NOT NULL,
    jumlah_kk INT(11) NOT NULL,
    jumlah_dusun INT(11) NOT NULL
)";
if (mysqli_query($koneksi, $sql)) {
    echo "Table statistik_desa created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($koneksi) . "\n";
}

// Insert default values if empty
$cek = mysqli_query($koneksi, "SELECT * FROM statistik_desa");
if (mysqli_num_rows($cek) == 0) {
    mysqli_query($koneksi, "INSERT INTO statistik_desa (jumlah_laki, jumlah_perempuan, jumlah_kk, jumlah_dusun) VALUES (2145, 2210, 1420, 4)");
    echo "Default statistics inserted.\n";
}
