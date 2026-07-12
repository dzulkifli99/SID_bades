# 🏫 Panduan Penggunaan Sistem Absensi Sekolah (SMK AL-MALIKI)

Selamat datang di Sistem Absensi Modern. Sistem ini dirancang untuk memudahkan Bapak/Ibu Guru dan Staf TU dalam memantau kehadiran siswa secara real-time, baik melalui mesin Fingerprint, Kartu RFID, maupun QR Code.

---

## 📋 Daftar Isi
1. [Halaman Utama & Login](#1-halaman-utama--login)
2. [Dashboard (Layar Pantau)](#2-dashboard-layar-pantau)
3. [Monitoring Kehadiran (Datang & Pulang)](#3-monitoring-kehadiran-datang--pulang)
4. [Manajemen Data Siswa](#4-manajemen-data-siswa)
5. [Pengaturan Jadwal Libur](#5-pengaturan-jadwal-libur)
6. [Sinkronisasi Mesin Fingerprint](#6-sinkronisasi-mesin-fingerprint)
7. [Log Notifikasi WhatsApp](#7-log-notifikasi-whatsapp)
8. [Pengaturan Jam Kerja (Sistem Pintar)](#8-pengaturan-jam-kerja-sistem-pintar)
9. [Logout](#9-logout)

---

## 1. Halaman Utama & Login
*   **Akses:** Buka browser dan masukkan alamat sistem.
*   **Login:** Masukkan *Username* dan *Password* Anda. Pastikan menjaga kerahasiaan akun agar data absensi tetap aman.

## 2. Dashboard (Layar Pantau)
Ini adalah pusat informasi harian. Di sini Bapak/Ibu bisa melihat:
*   **Statistik Real-time:** Jumlah siswa yang Hadir, Terlambat, Izin/Sakit, dan Alpa pada hari ini.
*   **Grafik Kehadiran:** Gambaran persentase kehadiran secara visual.
*   **Data Terbaru:** Daftar siswa yang baru saja melakukan scan di mesin.

## 3. Monitoring Kehadiran (Datang & Pulang)
Halaman ini digunakan untuk melihat daftar detail siapa saja yang sudah atau belum absen.
*   **Filter Kelas:** Anda bisa memfilter tampilan berdasarkan kelas tertentu.
*   **Input Manual (Izin/Sakit):** Jika ada siswa yang mengirim surat atau kabar, TU bisa mengubah statusnya langsung:
    1. Klik pilihan status pada nama siswa.
    2. Pilih **Izin** atau **Sakit**.
    3. Masukkan **Keterangan** (misal: "Izin acara keluarga" atau "Sakit demam").
    4. Sistem akan otomatis mengirim WhatsApp ke wali murid mengabarkan status tersebut.

## 4. Manajemen Data Siswa
Digunakan untuk menambah, mengubah, atau menghapus data siswa. 
*   **Penting:** ID Siswa di sini harus **SAMA** dengan ID yang didaftarkan di mesin Fingerprint agar data bisa sinkron.

## 5. Pengaturan Jadwal Libur
Fitur ini memudahkan pengelolaan hari libur panjang (Semester, Lebaran, dll).
*   **Rentang Tanggal:** Bapak/Ibu cukup memasukkan tanggal mulai dan tanggal berakhir.
*   **Cakupan:** Bisa memilih libur untuk "Seluruh Sekolah" atau "Hanya Kelas Tertentu".
*   **Efek:** Selama tanggal libur, sistem tidak akan mengirim notifikasi Alpa kepada siswa.

## 6. Sinkronisasi Mesin Fingerprint
Tombol ini berfungsi untuk menarik data dari mesin fingerprint ke dalam sistem web.
*   **Tarik Data:** Klik "Sinkronkan Mesin" untuk mengambil log absen terbaru.
*   **Auto-Clear:** Setelah data berhasil ditarik, sistem akan **otomatis membersihkan memori mesin** agar mesin tidak lemot/penuh.
*   **Batas Waktu:** Sesuai kebijakan, mesin hanya akan menerima absen masuk maksimal 1 jam setelah batas masuk.

## 7. Log Notifikasi WhatsApp
Sistem ini dilengkapi WhatsApp Gateway otomatis.
*   **Status Pesan:** Anda bisa memantau pesan mana yang sudah terkirim, pending, atau gagal.
*   **Bersihkan Log:** Anda bisa menghapus seluruh riwayat pesan agar sistem tetap ringan.

## 8. Pengaturan Jam Kerja (Sistem Pintar)
Di sini TU bisa mengatur aturan main absensi:
*   **Jam Masuk:** Contoh 06:00 (Siswa mulai boleh absen).
*   **Batas Masuk:** Contoh 07:00 (Lewat dari jam ini dianggap Terlambat).
*   **Toleransi:** Contoh 15 menit (Memberikan waktu tambahan sebelum sistem mengirim notifikasi Alpa).
*   **Auto Alpa:** Jika siswa tidak absen hingga melewati batas toleransi, sistem akan otomatis memberi status **Alpa** dan mengirim WhatsApp ke orang tua pada jam tersebut (Misal jam 07:16).

## 9. Logout
Selalu klik tombol **Logout** di pojok kanan atas setelah selesai menggunakan sistem untuk memastikan akun Anda tidak disalahgunakan oleh orang lain.

---
*Dikembangkan untuk SMK AL-MALIKI Lumajang*