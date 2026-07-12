<?php
include "koneksi.php";
$r = mysqli_query($koneksi, "SHOW COLUMNS FROM pengaduan LIKE 'nik'");
if (mysqli_num_rows($r) == 0) {
    mysqli_query($koneksi, "ALTER TABLE pengaduan ADD COLUMN nik VARCHAR(20) NULL AFTER nama");
    echo "Kolom nik berhasil ditambahkan.";
} else {
    echo "Kolom nik sudah ada.";
}
