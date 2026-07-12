<?php
include "koneksi.php";

$sql = "CREATE TABLE IF NOT EXISTS umkm (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_produk VARCHAR(100) NOT NULL,
    pemilik VARCHAR(100) NOT NULL,
    deskripsi TEXT NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    harga VARCHAR(50) NOT NULL,
    gambar_url VARCHAR(255) NOT NULL,
    tgl_tambah TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($koneksi, $sql)) {
    echo "Table umkm created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($koneksi) . "\n";
}
