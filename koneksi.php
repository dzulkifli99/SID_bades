<?php

// Timezone WIB — wajib ada agar jam tidak maju/mundur
date_default_timezone_set('Asia/Jakarta');

$koneksi = mysqli_connect("localhost", "root", "", "sid_bades");

// Hanya jalankan kode ini JIKA tombol login sudah diklik
