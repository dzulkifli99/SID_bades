<?php
include "koneksi.php";
echo "=== Database Tables ===\n";
$tables = mysqli_query($koneksi, "SHOW TABLES");
while ($r = mysqli_fetch_array($tables)) {
    $tbl = $r[0];
    $cnt = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as n FROM `$tbl`"))['n'];
    echo "$tbl => $cnt rows\n";
}
echo "\n=== Folder Assets ===\n";
$dirs = ['assets/img/berita', 'assets/img/umkm'];
foreach ($dirs as $d) {
    echo "$d: " . (is_dir($d) ? "EXISTS" : "NOT FOUND") . "\n";
}
echo "\n=== wisata-dampar folder ===\n";
echo is_dir("wisata-dampar") ? "EXISTS" : "NOT FOUND";
echo "\n";
