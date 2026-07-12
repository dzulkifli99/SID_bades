-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 05:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(10) NOT NULL,
  `id_siswa` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_datang` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status` enum('Hadir','Terlambat','Izin','Alpa') DEFAULT NULL,
  `last_scan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_siswa`, `tanggal`, `jam_datang`, `jam_pulang`, `status`, `last_scan`) VALUES
(1422, '25002', '2026-04-28', '18:03:30', NULL, 'Hadir', '2026-04-28 18:03:30'),
(1423, '25003', '2026-04-28', '18:06:55', NULL, 'Hadir', '2026-04-28 18:06:55'),
(1424, '25001', '2026-04-28', '18:30:04', NULL, 'Hadir', '2026-04-28 18:30:04'),
(1425, '25004', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1426, '25005', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1427, '25006', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1428, '25007', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1429, '25008', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1430, '25009', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1431, '25010', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1432, '25011', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1433, '25012', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1434, '25013', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1435, '25014', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1436, '25015', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1437, '25016', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1438, '25017', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1439, '25018', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1440, '25019', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1441, '25020', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1442, '25021', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1443, '25022', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1444, '25023', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1445, '25024', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1446, '25025', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1447, '25026', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1448, '25027', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1449, '25028', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1450, '25029', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1451, '25030', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1452, '25031', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1453, '25032', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1454, '25033', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1455, '25034', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1456, '25035', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1457, '25036', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1458, '25037', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1459, '25038', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1460, '25039', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1461, '25040', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1462, '25041', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1463, '25042', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1464, '25043', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1465, '25044', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1466, '25045', '2026-04-28', NULL, NULL, 'Alpa', NULL),
(1518, '25001', '2026-04-30', '08:10:21', NULL, 'Hadir', '2026-04-30 08:10:21'),
(1519, '25002', '2026-04-30', '08:10:29', NULL, 'Hadir', '2026-04-30 08:10:29'),
(1520, '25003', '2026-04-30', '08:10:32', NULL, 'Hadir', '2026-04-30 08:10:32'),
(1521, '25004', '2026-04-30', '08:10:36', NULL, 'Hadir', '2026-04-30 08:10:36'),
(1522, '25005', '2026-04-30', '08:10:40', NULL, 'Hadir', '2026-04-30 08:10:40'),
(1523, '25006', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1524, '25007', '2026-04-30', '08:12:26', NULL, 'Hadir', '2026-04-30 08:12:26'),
(1525, '25008', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1526, '25009', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1527, '25010', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1528, '25011', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1529, '25012', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1530, '25013', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1531, '25014', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1532, '25015', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1533, '25016', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1534, '25017', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1535, '25018', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1536, '25019', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1537, '25020', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1538, '25021', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1539, '25022', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1540, '25023', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1541, '25024', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1542, '25025', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1543, '25026', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1544, '25027', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1545, '25028', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1546, '25029', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1547, '25030', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1548, '25031', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1549, '25032', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1550, '25033', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1551, '25034', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1552, '25035', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1553, '25036', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1554, '25037', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1555, '25038', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1556, '25039', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1557, '25040', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1558, '25041', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1559, '25042', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1560, '25043', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1561, '25044', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1562, '25045', '2026-04-30', NULL, NULL, 'Alpa', NULL),
(1610, '25001', '2026-05-01', NULL, NULL, '', NULL),
(1611, '25026', '2026-05-02', NULL, NULL, '', NULL),
(1612, '25001', '2026-05-04', '09:44:03', NULL, 'Hadir', '2026-05-04 09:44:03'),
(1613, '25002', '2026-05-04', '09:44:06', NULL, 'Hadir', '2026-05-04 09:44:06'),
(1614, '25003', '2026-05-04', '09:44:09', NULL, 'Hadir', '2026-05-04 09:44:09'),
(1615, '25004', '2026-05-04', '09:44:21', NULL, 'Hadir', '2026-05-04 09:44:21'),
(1616, '25028', '2026-05-04', '09:44:26', NULL, 'Hadir', '2026-05-04 09:44:26'),
(1617, '25005', '2026-05-04', '09:44:30', NULL, 'Hadir', '2026-05-04 09:44:30'),
(1618, '25099', '2026-05-07', NULL, NULL, '', NULL),
(1619, '25100', '2026-05-07', NULL, NULL, '', NULL),
(1803, '25109', '2026-05-08', '03:51:02', NULL, 'Hadir', NULL),
(1804, '25099', '2026-05-08', '03:51:18', NULL, 'Terlambat', NULL),
(1805, '25112', '2026-05-08', '08:54:09', NULL, 'Hadir', NULL),
(1806, '25065', '2026-05-08', '08:54:18', NULL, 'Hadir', NULL),
(1807, '25068', '2026-05-08', '12:01:48', NULL, 'Hadir', NULL),
(1808, '25113', '2026-05-08', '18:22:05', NULL, 'Terlambat', NULL),
(1809, '25103', '2026-05-09', '21:25:43', NULL, 'Hadir', NULL),
(1810, '25099', '2026-05-10', '18:40:41', NULL, 'Terlambat', NULL),
(1811, '25101', '2026-05-10', '18:40:43', NULL, 'Terlambat', NULL),
(1812, '25104', '2026-05-10', '18:40:46', NULL, 'Izin', NULL),
(1813, '25106', '2026-05-10', '18:40:49', NULL, 'Terlambat', NULL),
(1814, '25067', '2026-05-10', '18:40:54', NULL, 'Hadir', NULL),
(1815, '25113', '2026-05-10', '18:40:56', NULL, 'Hadir', NULL),
(1816, '25110', '2026-05-10', '18:40:58', NULL, 'Hadir', NULL),
(1817, '25109', '2026-05-10', '18:41:00', NULL, 'Hadir', NULL),
(1818, '25063', '2026-05-10', '18:41:03', NULL, 'Hadir', NULL),
(1819, '25107', '2026-05-10', '18:41:06', NULL, 'Hadir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'hasby', '$2y$10$cxyzcHvocWMc.lLroqww2eP8SjZ7DkGg75Wd7NCFr2JYFZEQR1J8W'),
(2, 'ADMIN', '$2y$10$f0zft5nGHoMBwj/2JsSlrujN.Z7V7m6ZXM2mwHimcUISCHiovKLAy');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id_siswa` varchar(20) NOT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `nisn` varchar(30) DEFAULT NULL,
  `tempat_tgl_lahir` varchar(150) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nama` varchar(25) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id_siswa`, `nis`, `nisn`, `tempat_tgl_lahir`, `nik`, `alamat`, `nama`, `kelas`, `no_hp`) VALUES
('24001', NULL, NULL, NULL, NULL, NULL, 'ACHMAD SHOLEH ROMADHONI', '11 ATU', '085784880169'),
('24002', NULL, NULL, NULL, NULL, NULL, 'AFITA HOIRUN NISA', '11 ATU', '085784880169'),
('24003', NULL, NULL, NULL, NULL, NULL, 'Ahmad Abdul Haziz', '11 ATU', '085784880169'),
('24004', NULL, NULL, NULL, NULL, NULL, 'Ahmad Daud', '11 ATU', '085784880169'),
('24005', NULL, NULL, NULL, NULL, NULL, 'ALVINZA DWI PRASETYO', '11 ATU', '085784880169'),
('24006', NULL, NULL, NULL, NULL, NULL, 'ANAS MUBAROK MUSLIM', '11 ATU', '085784880169'),
('24007', NULL, NULL, NULL, NULL, NULL, 'Anisah Dwi Tunafsiah', '11 ATU', '085784880169'),
('24008', NULL, NULL, NULL, NULL, NULL, 'Fatoni Ibrahim', '11 ATU', '085784880169'),
('24009', NULL, NULL, NULL, NULL, NULL, 'LEO CHANDRA', '11 ATU', '085784880169'),
('24010', NULL, NULL, NULL, NULL, NULL, 'MUHAMAD ILHAM', '11 ATU', '085784880169'),
('24011', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD HILMI YAHYA', '11 ATU', '085784880169'),
('24012', NULL, NULL, NULL, NULL, NULL, 'SITI JAMILATUR RIZQIYAH', '11 ATU', '085784880169'),
('24013', NULL, NULL, NULL, NULL, NULL, 'VIRDA URSILATUR ROHMAH', '11 ATU', '085784880169'),
('24014', NULL, NULL, NULL, NULL, NULL, 'ALIFIA NOR AINI', '11 TKJ A', '085784880169'),
('24015', NULL, NULL, NULL, NULL, NULL, 'ANISA WILY', '11 TKJ A', '085784880169'),
('24016', NULL, NULL, NULL, NULL, NULL, 'Awaliya Shahrina Mauza Ma', '11 TKJ A', '085784880169'),
('24017', NULL, NULL, NULL, NULL, NULL, 'Ayu Lidia Safira', '11 TKJ A', '085784880169'),
('24018', NULL, NULL, NULL, NULL, NULL, 'Dian Putri Dwi Gisilawati', '11 TKJ A', '085784880169'),
('24019', NULL, NULL, NULL, NULL, NULL, 'DINI AYU SETYOWATI', '11 TKJ A', '085784880169'),
('24020', NULL, NULL, NULL, NULL, NULL, 'Faidatul Faiqoh', '11 TKJ A', '085784880169'),
('24021', NULL, NULL, NULL, NULL, NULL, 'FANI NURMALA', '11 TKJ A', '085784880169'),
('24022', NULL, NULL, NULL, NULL, NULL, 'Fara Idayu Niswatul Karim', '11 TKJ A', '085784880169'),
('24023', NULL, NULL, NULL, NULL, NULL, 'Fiya Agustin', '11 TKJ A', '085784880169'),
('24024', NULL, NULL, NULL, NULL, NULL, 'KHANSA NAURA HIKMAH', '11 TKJ A', '085784880169'),
('24025', NULL, NULL, NULL, NULL, NULL, 'MEGAWATI DIAH PERMATA', '11 TKJ A', '085784880169'),
('24026', NULL, NULL, NULL, NULL, NULL, 'Nayla Nuris Salma', '11 TKJ A', '085784880169'),
('24027', NULL, NULL, NULL, NULL, NULL, 'Naylun Najah', '11 TKJ A', '085784880169'),
('24028', NULL, NULL, NULL, NULL, NULL, 'NORA HALIMIA', '11 TKJ A', '085784880169'),
('24029', NULL, NULL, NULL, NULL, NULL, 'NUR HALIZA AMELIA', '11 TKJ A', '085784880169'),
('24030', NULL, NULL, NULL, NULL, NULL, 'Putri Auliatu Zahro', '11 TKJ A', '085784880169'),
('24031', NULL, NULL, NULL, NULL, NULL, 'RINDA DIAN LESTARI', '11 TKJ A', '085784880169'),
('24032', NULL, NULL, NULL, NULL, NULL, 'SELVI CHACHA NUR FITASARI', '11 TKJ A', '085784880169'),
('24033', NULL, NULL, NULL, NULL, NULL, 'suhriatul hasanah', '11 TKJ A', '085784880169'),
('24034', NULL, NULL, NULL, NULL, NULL, 'SUSI EKA JANIAR', '11 TKJ A', '085784880169'),
('24035', NULL, NULL, NULL, NULL, NULL, 'ZAHRANI NUR FAIZAH', '11 TKJ A', '085784880169'),
('24036', NULL, NULL, NULL, NULL, NULL, 'Ahmad Faerus Mufid', '11 TKJ B', '085784880169'),
('24037', NULL, NULL, NULL, NULL, NULL, 'AHMAD FAJAR AMRIANTO', '11 TKJ B', '085784880169'),
('24038', NULL, NULL, NULL, NULL, NULL, 'Ahmad Taufik Sayfudin', '11 TKJ B', '085784880169'),
('24039', NULL, NULL, NULL, NULL, NULL, 'Andika', '11 TKJ B', '085784880169'),
('24040', NULL, NULL, NULL, NULL, NULL, 'Arfan Rizqi Ramadhani', '11 TKJ B', '085784880169'),
('24041', NULL, NULL, NULL, NULL, NULL, 'bayu firmansyah', '11 TKJ B', '085784880169'),
('24042', NULL, NULL, NULL, NULL, NULL, 'DAMAI LINGGA WANA', '11 TKJ B', '085784880169'),
('24043', NULL, NULL, NULL, NULL, NULL, 'Daniel Cescf Abregas', '11 TKJ B', '085784880169'),
('24044', NULL, NULL, NULL, NULL, NULL, 'DENIS ARDIANSYAH', '11 TKJ B', '085784880169'),
('24045', NULL, NULL, NULL, NULL, NULL, 'FRIZTAMA BRIANT ARDIANSYA', '11 TKJ B', '085784880169'),
('24046', NULL, NULL, NULL, NULL, NULL, 'Heri Yanto', '11 TKJ B', '085784880169'),
('24047', NULL, NULL, NULL, NULL, NULL, 'IKHYA ULUM UDIN', '11 TKJ B', '085784880169'),
('24048', NULL, NULL, NULL, NULL, NULL, 'Irfan Efendi', '11 TKJ B', '085784880169'),
('24049', NULL, NULL, NULL, NULL, NULL, 'MARVELLINO EKA PRATAMA', '11 TKJ B', '085784880169'),
('24050', NULL, NULL, NULL, NULL, NULL, 'Maskut', '11 TKJ B', '085784880169'),
('24051', NULL, NULL, NULL, NULL, NULL, 'MOHAMMAD ROHMAN', '11 TKJ B', '085784880169'),
('24052', NULL, NULL, NULL, NULL, NULL, 'Muhamad Sahrul Ramadhan', '11 TKJ B', '085784880169'),
('24053', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD BADRUS SHOLEH', '11 TKJ B', '085784880169'),
('24054', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD ILYAS MAULANA', '11 TKJ B', '085784880169'),
('24055', NULL, NULL, NULL, NULL, NULL, 'Rifarga Fyohandika', '11 TKJ B', '085784880169'),
('24056', NULL, NULL, NULL, NULL, NULL, 'ZAYDAN ABDUL HALIM', '11 TKJ B', '085784880169'),
('24057', NULL, NULL, NULL, NULL, NULL, 'Amilus Sholehah', '11 DKV', '085784880169'),
('24058', NULL, NULL, NULL, NULL, NULL, 'Ana Melinda', '11 DKV', '085784880169'),
('24059', NULL, NULL, NULL, NULL, NULL, 'Aurel Firsya Oktavia', '11 DKV', '085784880169'),
('24060', NULL, NULL, NULL, NULL, NULL, 'CHELSILIA DECA ADINTIANTO', '11 DKV', '085784880169'),
('24061', NULL, NULL, NULL, NULL, NULL, 'CHELSY ANSYAH PUTRI BINTA', '11 DKV', '085784880169'),
('24062', NULL, NULL, NULL, NULL, NULL, 'DAHNIA HASOFA NOR HAFIDA', '11 DKV', '085784880169'),
('24063', NULL, NULL, NULL, NULL, NULL, 'ILHAM  ARIFIN', '11 DKV', '085784880169'),
('24064', NULL, NULL, NULL, NULL, NULL, 'JEAN TRAVIS', '11 DKV', '085784880169'),
('24065', NULL, NULL, NULL, NULL, NULL, 'Mohamad Syarul Arifin', '11 DKV', '085784880169'),
('24066', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD RAFI RULIYA PRAT', '11 DKV', '085784880169'),
('24067', NULL, NULL, NULL, NULL, NULL, 'Nur Faiqoh Nalini', '11 DKV', '085784880169'),
('24068', NULL, NULL, NULL, NULL, NULL, 'NURIL MAULIDIYAH', '11 DKV', '085784880169'),
('24069', NULL, NULL, NULL, NULL, NULL, 'REVINDRA EZY SAPUTRA', '11 DKV', '085784880169'),
('24070', NULL, NULL, NULL, NULL, NULL, 'RIA FAIQOTUL MALA', '11 DKV', '085784880169'),
('24071', NULL, NULL, NULL, NULL, NULL, 'Rigo Pratono', '11 DKV', '085784880169'),
('24072', NULL, NULL, NULL, NULL, NULL, 'RIZQIA SABILIL KHOIRO', '11 DKV', '085784880169'),
('24073', NULL, NULL, NULL, NULL, NULL, 'SHERINA SHEILA FEBIOLA', '11 DKV', '085784880169'),
('24074', NULL, NULL, NULL, NULL, NULL, 'SINDI', '11 DKV', '085784880169'),
('24075', NULL, NULL, NULL, NULL, NULL, 'Sindy Lailatul Fitria', '11 DKV', '085784880169'),
('24076', NULL, NULL, NULL, NULL, NULL, 'Tito Wahyu Ardiansyah', '11 DKV', '085784880169'),
('24077', NULL, NULL, NULL, NULL, NULL, 'TYAS YUSNIAR', '11 DKV', '085784880169'),
('24078', NULL, NULL, NULL, NULL, NULL, 'ULFA FEBRIANTIKA', '11 DKV', '085784880169'),
('24079', NULL, NULL, NULL, NULL, NULL, 'Wahyu Firmansyah', '11 DKV', '085784880169'),
('24080', NULL, NULL, NULL, NULL, NULL, 'Wisnu wardana Maulana Akb', '11 DKV', '085784880169'),
('24081', NULL, NULL, NULL, NULL, NULL, 'WULAN SUCI ROMADONI', '11 DKV', '085784880169'),
('24082', NULL, NULL, NULL, NULL, NULL, 'ADINDA FATIMATUS SOLIKHA', '11 DPB', '085784880169'),
('24083', NULL, NULL, NULL, NULL, NULL, 'AFIFAH NUR FARIDAH', '11 DPB', '085784880169'),
('24084', NULL, NULL, NULL, NULL, NULL, 'AINI MAGHFIROH', '11 DPB', '085784880169'),
('24085', NULL, NULL, NULL, NULL, NULL, 'AJENG PRATIWI', '11 DPB', '085784880169'),
('24086', NULL, NULL, NULL, NULL, NULL, 'Allya Eva Rahmawati', '11 DPB', '085784880169'),
('24087', NULL, NULL, NULL, NULL, NULL, 'Aura Nasya Violani', '11 DPB', '085784880169'),
('24088', NULL, NULL, NULL, NULL, NULL, 'DEVY NAYSHILATUL JANNAH', '11 DPB', '085784880169'),
('24089', NULL, NULL, NULL, NULL, NULL, 'DIAN ANUGRAH', '11 DPB', '085784880169'),
('24090', NULL, NULL, NULL, NULL, NULL, 'DINA PUTRI AULYA', '11 DPB', '085784880169'),
('24091', NULL, NULL, NULL, NULL, NULL, 'Dinda Dwi Agustin', '11 DPB', '085784880169'),
('24092', NULL, NULL, NULL, NULL, NULL, 'FAIZ MEILANI PUTRI', '11 DPB', '085784880169'),
('24093', NULL, NULL, NULL, NULL, NULL, 'HAURA AINI AL-FIRDAUSI', '11 DPB', '085784880169'),
('24094', NULL, NULL, NULL, NULL, NULL, 'Herlina', '11 DPB', '085784880169'),
('24095', NULL, NULL, NULL, NULL, NULL, 'Kiara Marsa Kamila', '11 DPB', '085784880169'),
('24096', NULL, NULL, NULL, NULL, NULL, 'LIA ANDRIANI', '11 DPB', '085784880169'),
('24097', NULL, NULL, NULL, NULL, NULL, 'NADA SAVAIRA RIZQIN', '11 DPB', '085784880169'),
('24098', NULL, NULL, NULL, NULL, NULL, 'Niken Ayuni Kharisma', '11 DPB', '085784880169'),
('24099', NULL, NULL, NULL, NULL, NULL, 'NORHOLIZA', '11 DPB', '085784880169'),
('24100', NULL, NULL, NULL, NULL, NULL, 'PUTRI ROMADHONI', '11 DPB', '085784880169'),
('24101', NULL, NULL, NULL, NULL, NULL, 'Putri Zahrani Aura Nadhit', '11 DPB', '085784880169'),
('24102', NULL, NULL, NULL, NULL, NULL, 'SALSA DWI ISPRIANTINA', '11 DPB', '085784880169'),
('24103', NULL, NULL, NULL, NULL, NULL, 'SEPTA RAMADHANI STYOWATI', '11 DPB', '085784880169'),
('24104', NULL, NULL, NULL, NULL, NULL, 'TAUFIQA RAMADANI', '11 DPB', '085784880169'),
('24105', NULL, NULL, NULL, NULL, NULL, 'YULIANI DATUL ALIYAH', '11 DPB', '085784880169'),
('24106', NULL, NULL, NULL, NULL, NULL, 'ZHAHROTUS SYITA', '11 DPB', '085784880169'),
('25001', NULL, NULL, NULL, NULL, NULL, 'ADITYA KURNIAWAN', '10 TKJ B', '085784880169'),
('25002', NULL, NULL, NULL, NULL, NULL, 'Afnan Nur Ghofur', '10 TKJ B', '085784880169'),
('25003', NULL, NULL, NULL, NULL, NULL, 'AHMAD ZAKARIA', '10 TKJ B', '085784880169'),
('25004', NULL, NULL, NULL, NULL, NULL, 'DEDI CANDRA WIJAYA', '10 TKJ B', '085784880169'),
('25005', NULL, NULL, NULL, NULL, NULL, 'Evan Septiyan Ramadhani', '10 TKJ B', '085784880169'),
('25006', NULL, NULL, NULL, NULL, NULL, 'FAREL EMARALDI DINATA', '10 TKJ B', '085784880169'),
('25007', NULL, NULL, NULL, NULL, NULL, 'Nafis Arifin', '10 TKJ B', '085784880169'),
('25008', NULL, NULL, NULL, NULL, NULL, 'KEVIN KURNIAWAN', '10 TKJ B', '085784880169'),
('25009', NULL, NULL, NULL, NULL, NULL, 'MAULANAFIZ AL RAFIDIN', '10 TKJ B', '085784880169'),
('25010', NULL, NULL, NULL, NULL, NULL, 'MOCH RAKA RADITYA PRATAMA', '10 TKJ B', '085784880169'),
('25011', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD AGUSTIAN FERDIAN', '10 TKJ B', '085784880169'),
('25012', NULL, NULL, NULL, NULL, NULL, 'Muhammad Ardin Ardiansyah', '10 TKJ B', '085784880169'),
('25013', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD FAREL AFIFUDIN', '10 TKJ B', '085784880169'),
('25014', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD NAJIVA', '10 TKJ B', '085784880169'),
('25015', NULL, NULL, NULL, NULL, NULL, 'MUKHAMMAD IQBAL GOZALI', '10 TKJ B', '085784880169'),
('25016', NULL, NULL, NULL, NULL, NULL, 'Putrawan', '10 TKJ B', '085784880169'),
('25017', NULL, NULL, NULL, NULL, NULL, 'Rahmad Mauludin', '10 TKJ B', '085784880169'),
('25018', NULL, NULL, NULL, NULL, NULL, 'RAMADANI', '10 TKJ B', '085784880169'),
('25019', NULL, NULL, NULL, NULL, NULL, 'Ridho Firmansyah', '10 TKJ B', '085784880169'),
('25020', NULL, NULL, NULL, NULL, NULL, 'Rohizul Kifli Jaelani', '10 TKJ B', '085784880169'),
('25021', NULL, NULL, NULL, NULL, NULL, 'Satrio Dwi Wahono', '10 TKJ B', '085784880169'),
('25022', NULL, NULL, NULL, NULL, NULL, 'SEPTIAN AGUNG PRASETYO', '10 TKJ B', '085784880169'),
('25023', NULL, NULL, NULL, NULL, NULL, 'TORIKUL FATA ZAIDAAN ARIE', '10 TKJ B', '085784880169'),
('25024', NULL, NULL, NULL, NULL, NULL, 'WAHYU ADI PRATAMA', '10 TKJ B', '085784880169'),
('25025', NULL, NULL, NULL, NULL, NULL, 'Andika', '10 TKJ B', '085784880169'),
('25026', NULL, NULL, NULL, NULL, NULL, 'ADINDA PUTRI NURLAILIN', '10 TKJ A', '085784880169'),
('25027', NULL, NULL, NULL, NULL, NULL, 'DEA APRILIA', '10 TKJ A', '085784880169'),
('25028', NULL, NULL, NULL, NULL, NULL, 'Dinda Uswatun Hasanah', '10 TKJ A', '085784880169'),
('25029', NULL, NULL, NULL, NULL, NULL, 'ELSI DINI ANANTA', '10 TKJ A', '085784880169'),
('25030', NULL, NULL, NULL, NULL, NULL, 'FARADINA AMIROTUL ADILAH', '10 TKJ A', '085784880169'),
('25031', NULL, NULL, NULL, NULL, NULL, 'FIKA RAHMAWATI', '10 TKJ A', '085784880169'),
('25032', NULL, NULL, NULL, NULL, NULL, 'FIRDAUSYAH SALSABILA', '10 TKJ A', '085784880169'),
('25033', NULL, NULL, NULL, NULL, NULL, 'Halimah Tusakdiyah', '10 TKJ A', '085784880169'),
('25034', NULL, NULL, NULL, NULL, NULL, 'HILWA SEPTIANA SAFITRI', '10 TKJ A', '085784880169'),
('25035', NULL, NULL, NULL, NULL, NULL, 'IMELIA HERNIATI', '10 TKJ A', '085784880169'),
('25036', NULL, NULL, NULL, NULL, NULL, 'LIDIA AMELIA', '10 TKJ A', '085784880169'),
('25037', NULL, NULL, NULL, NULL, NULL, 'NIKMATUL JANNAH', '10 TKJ A', '085784880169'),
('25038', NULL, NULL, NULL, NULL, NULL, 'Risa Lisdiana', '10 TKJ A', '085784880169'),
('25039', NULL, NULL, NULL, NULL, NULL, 'ROHMATULLAH', '10 TKJ A', '085784880169'),
('25040', NULL, NULL, NULL, NULL, NULL, 'Safira Ayu Lestari', '10 TKJ A', '085784880169'),
('25041', NULL, NULL, NULL, NULL, NULL, 'SITI NUR AISYAH', '10 TKJ A', '085784880169'),
('25042', NULL, NULL, NULL, NULL, NULL, 'SITI ROHMAIDA', '10 TKJ A', '085784880169'),
('25043', NULL, NULL, NULL, NULL, NULL, 'SUSANTI', '10 TKJ A', '085784880169'),
('25044', NULL, NULL, NULL, NULL, NULL, 'Umayro Uswatun Aninia', '10 TKJ A', '085784880169'),
('25045', NULL, NULL, NULL, NULL, NULL, 'WILDA AGUSTIANI', '10 TKJ A', '085784880169'),
('25046', NULL, NULL, NULL, NULL, NULL, 'ADINDA ZAHIRA', '10 DPB', '085784880169'),
('25047', NULL, NULL, NULL, NULL, NULL, 'ALFIRA SYAHRA PUTRI TUNGG', '10 DPB', '085784880169'),
('25048', NULL, NULL, NULL, NULL, NULL, 'ANGGRAINI ISTIQOMAH', '10 DPB', '085784880169'),
('25049', NULL, NULL, NULL, NULL, NULL, 'FAIQOTUN NASIROH', '10 DPB', '085784880169'),
('25050', NULL, NULL, NULL, NULL, NULL, 'FATIMAH BATUL KAREENA DIV', '10 DPB', '085784880169'),
('25051', NULL, NULL, NULL, NULL, NULL, 'INTAN NUR KOMARIA MAULIDI', '10 DPB', '085784880169'),
('25052', NULL, NULL, NULL, NULL, NULL, 'Kinanti Ayu Lestari', '10 DPB', '085784880169'),
('25053', NULL, NULL, NULL, NULL, NULL, 'LUTHFILLAH GHINA', '10 DPB', '085784880169'),
('25054', NULL, NULL, NULL, NULL, NULL, 'NABILA ZAHROTUS SYAFA\'AH', '10 DPB', '085784880169'),
('25055', NULL, NULL, NULL, NULL, NULL, 'NUR AINI CAHYATI', '10 DPB', '085784880169'),
('25056', NULL, NULL, NULL, NULL, NULL, 'NUR HIDAYAH PUTRI RAMADHA', '10 DPB', '085784880169'),
('25057', NULL, NULL, NULL, NULL, NULL, 'NURSAFIKA', '10 DPB', '085784880169'),
('25058', NULL, NULL, NULL, NULL, NULL, 'PUTRI ARVINA DAMAYANTI', '10 DPB', '085784880169'),
('25059', NULL, NULL, NULL, NULL, NULL, 'SILVI EKA RAHMAWATI', '10 DPB', '085784880169'),
('25060', NULL, NULL, NULL, NULL, NULL, 'TAZKIYAH ANNISA HANDOYO', '10 DPB', '085784880169'),
('25061', NULL, NULL, NULL, NULL, NULL, 'WULAN RAHMA PUTRI CAHYANI', '10 DPB', '085784880169'),
('25062', NULL, NULL, NULL, NULL, NULL, 'ZAHRA ULFIANA YULIANI', '10 DPB', '085784880169'),
('25063', NULL, NULL, NULL, NULL, NULL, 'ACHMAD NAUFFAL AXANDY', '10 DKV', '085784880169'),
('25064', NULL, NULL, NULL, NULL, NULL, 'AINUR RIDHO', '10 DKV', '085784880169'),
('25065', NULL, NULL, NULL, NULL, NULL, 'AMELIA MUKAROMATUL JANNAH', '10 DKV', '085784880169'),
('25066', NULL, NULL, NULL, NULL, NULL, 'ANDIKA ARYA UTAMA', '10 DKV', '085784880169'),
('25067', NULL, NULL, NULL, NULL, NULL, 'Anggi Dwi Agustin', '10 DKV', '085784880169'),
('25068', NULL, NULL, NULL, NULL, NULL, 'ANISA NUROSITA', '10 DKV', '085784880169'),
('25069', NULL, NULL, NULL, NULL, NULL, 'ARINI ATHIYATUL MAGHFIRAH', '10 DKV', '085784880169'),
('25070', NULL, NULL, NULL, NULL, NULL, 'BIMA RAMADANI SEPTIAWAN', '10 DKV', '085784880169'),
('25071', NULL, NULL, NULL, NULL, NULL, 'DALILLA FAUZIAH AWALINA', '10 DKV', '085784880169'),
('25072', NULL, NULL, NULL, NULL, NULL, 'Erlangga Saputra', '10 DKV', '085784880169'),
('25073', NULL, NULL, NULL, NULL, NULL, 'FAHAT ALI IBROHIM', '10 DKV', '085784880169'),
('25074', NULL, NULL, NULL, NULL, NULL, 'FAISAL YOKI PRATAMA', '10 DKV', '085784880169'),
('25075', NULL, NULL, NULL, NULL, NULL, 'FALENSIYA', '10 DKV', '085784880169'),
('25076', NULL, NULL, NULL, NULL, NULL, 'FARAH KHOIRIN NI\'MAH', '10 DKV', '085784880169'),
('25077', NULL, NULL, NULL, NULL, NULL, 'HILWA DZAKIATUSSHOLIHAH', '10 DKV', '085784880169'),
('25078', NULL, NULL, NULL, NULL, NULL, 'Humairotun Nisa', '10 DKV', '085784880169'),
('25079', NULL, NULL, NULL, NULL, NULL, 'HUMI HANIK FIFI YANTI', '10 DKV', '085784880169'),
('25080', NULL, NULL, NULL, NULL, NULL, 'KHIQMAH FAJARINA', '10 DKV', '085784880169'),
('25081', NULL, NULL, NULL, NULL, NULL, 'KUNDIYONO', '10 DKV', '085784880169'),
('25082', NULL, NULL, NULL, NULL, NULL, 'MAULITDIAH', '10 DKV', '085784880169'),
('25083', NULL, NULL, NULL, NULL, NULL, 'MITA KAMILA', '10 DKV', '085784880169'),
('25084', NULL, NULL, NULL, NULL, NULL, 'MOCH. FIRMAN', '10 DKV', '085784880169'),
('25085', NULL, NULL, NULL, NULL, NULL, 'Mochammad Evendy', '10 DKV', '085784880169'),
('25086', NULL, NULL, NULL, NULL, NULL, 'MUHAMAD HAIDAR KHOSIN', '10 DKV', '085784880169'),
('25087', NULL, NULL, NULL, NULL, NULL, 'Muhammad Akbar Rizki Rama', '10 DKV', '085784880169'),
('25088', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD FAUZAN', '10 DKV', '085784880169'),
('25089', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD ROSYKHUL FAHMI K', '10 DKV', '085784880169'),
('25090', NULL, NULL, NULL, NULL, NULL, 'NAFIS SALSABILAH', '10 DKV', '085784880169'),
('25091', NULL, NULL, NULL, NULL, NULL, 'Nahdlya Afkarina', '10 DKV', '085784880169'),
('25092', NULL, NULL, NULL, NULL, NULL, 'NUR AZIZAH RAMADHANI', '10 DKV', '085784880169'),
('25093', NULL, NULL, NULL, NULL, NULL, 'NUR SYAFIAH AMNI', '10 DKV', '085784880169'),
('25094', NULL, NULL, NULL, NULL, NULL, 'OKTAVIA DWI ANGGRAENI', '10 DKV', '085784880169'),
('25095', NULL, NULL, NULL, NULL, NULL, 'SELFIA DAVINA YUNIAR', '10 DKV', '085784880169'),
('25096', NULL, NULL, NULL, NULL, NULL, 'Siti Nur Amalina', '10 DKV', '085784880169'),
('25097', NULL, NULL, NULL, NULL, NULL, 'SOFHIA AYU PRATIWI', '10 DKV', '085784880169'),
('25098', NULL, NULL, NULL, NULL, NULL, 'Yeni Tamala', '10 DKV', '085784880169'),
('25099', NULL, NULL, NULL, NULL, NULL, 'DEWI FATMASARI', '10 ATU', '085784880169'),
('25100', NULL, NULL, NULL, NULL, NULL, 'DWI ANDIKA', '10 ATU', '085784880169'),
('25101', NULL, NULL, NULL, NULL, NULL, 'DWI ANDINI KURNIAWATI', '10 ATU', '085784880169'),
('25102', NULL, NULL, NULL, NULL, NULL, 'HIDAYATUL ANISAK', '10 ATU', '085784880169'),
('25103', NULL, NULL, NULL, NULL, NULL, 'ISMI AZIZAH', '10 ATU', '085784880169'),
('25104', NULL, NULL, NULL, NULL, NULL, 'KHOIRIAH', '10 ATU', '085784880169'),
('25105', NULL, NULL, NULL, NULL, NULL, 'MAR\'ATUS SHOLIHAH', '10 ATU', '085784880169'),
('25106', NULL, NULL, NULL, NULL, NULL, 'MOCHAMMAD REZA FERDIANSYA', '10 ATU', '085784880169'),
('25107', NULL, NULL, NULL, NULL, NULL, 'MOHAMAD GUNTUR', '10 ATU', '085784880169'),
('25108', NULL, NULL, NULL, NULL, NULL, 'MOHAMMAD FENDI', '10 ATU', '085784880169'),
('25109', NULL, NULL, NULL, NULL, NULL, 'MUHAMAD IQBAL', '10 ATU', '085784880169'),
('25110', NULL, NULL, NULL, NULL, NULL, 'MUHAMMAD BAGUS FIRMANSYAH', '10 ATU', '085784880169'),
('25111', NULL, NULL, NULL, NULL, NULL, 'ROHMAWATI', '10 ATU', '085784880169'),
('25112', NULL, NULL, NULL, NULL, NULL, 'TOMY KURNIAWAN', '10 ATU', '085784880169'),
('25113', NULL, NULL, NULL, NULL, NULL, 'UMAR ABDUL AZIZ', '10 ATU', '085784880169');

-- --------------------------------------------------------

--
-- Table structure for table `libur_kelas`
--

CREATE TABLE `libur_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_masuk` time NOT NULL,
  `batas_masuk` time NOT NULL,
  `toleransi_terlambat` int(11) DEFAULT 15,
  `jam_pulang` time NOT NULL,
  `batas_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `hari`, `jam_masuk`, `batas_masuk`, `toleransi_terlambat`, `jam_pulang`, `batas_pulang`) VALUES
(1, 'senin', '09:00:00', '10:00:00', 15, '14:00:00', '15:00:00'),
(2, 'selasa', '06:00:00', '07:00:00', 15, '14:30:00', '15:00:00'),
(3, 'rabu', '05:00:00', '06:00:00', 15, '08:00:00', '09:00:00'),
(4, 'kamis', '08:00:00', '09:00:00', 15, '14:00:00', '15:00:00'),
(5, 'jumat', '06:00:00', '07:00:00', 15, '14:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wa_queue`
--

CREATE TABLE `wa_queue` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wa_queue`
--

INSERT INTO `wa_queue` (`id`, `nomor`, `pesan`, `status`, `created_at`) VALUES
(7, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ACHMAD SHOLEH ROMADHONI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(8, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AFITA HOIRUN NISA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(9, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ahmad Abdul Haziz*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(10, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ahmad Daud*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(11, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ALVINZA DWI PRASETYO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(12, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ANAS MUBAROK MUSLIM*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(13, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Anisah Dwi Tunafsiah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(14, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Fatoni Ibrahim*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(15, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *LEO CHANDRA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(16, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMAD ILHAM*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(17, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD HILMI YAHYA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(18, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SITI JAMILATUR RIZQIYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(19, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *VIRDA URSILATUR ROHMAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(20, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ALIFIA NOR AINI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(21, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ANISA WILY*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(22, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Awaliya Shahrina Mauza Ma*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(23, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ayu Lidia Safira*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(24, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Dian Putri Dwi Gisilawati*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(25, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DINI AYU SETYOWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(26, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Faidatul Faiqoh*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(27, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FANI NURMALA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(28, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Fara Idayu Niswatul Karim*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(29, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Fiya Agustin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(30, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *KHANSA NAURA HIKMAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(31, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MEGAWATI DIAH PERMATA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(32, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Nayla Nuris Salma*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(33, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Naylun Najah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(34, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NORA HALIMIA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(35, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NUR HALIZA AMELIA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(36, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Putri Auliatu Zahro*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(37, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *RINDA DIAN LESTARI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(38, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SELVI CHACHA NUR FITASARI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(39, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *suhriatul hasanah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(40, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SUSI EKA JANIAR*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(41, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ZAHRANI NUR FAIZAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(42, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ahmad Faerus Mufid*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(43, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AHMAD FAJAR AMRIANTO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(44, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ahmad Taufik Sayfudin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(45, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Andika*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(46, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Arfan Rizqi Ramadhani*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(47, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *bayu firmansyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(48, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DAMAI LINGGA WANA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(49, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Daniel Cescf Abregas*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(50, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DENIS ARDIANSYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(51, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FRIZTAMA BRIANT ARDIANSYA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(52, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Heri Yanto*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(53, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *IKHYA ULUM UDIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(54, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Irfan Efendi*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(55, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MARVELLINO EKA PRATAMA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(56, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Maskut*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(57, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MOHAMMAD ROHMAN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(58, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Muhamad Sahrul Ramadhan*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(59, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD BADRUS SHOLEH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(60, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD ILYAS MAULANA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(61, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Rifarga Fyohandika*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(62, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ZAYDAN ABDUL HALIM*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(63, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Amilus Sholehah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(64, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ana Melinda*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(65, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Aurel Firsya Oktavia*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(66, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *CHELSILIA DECA ADINTIANTO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(67, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *CHELSY ANSYAH PUTRI BINTA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(68, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DAHNIA HASOFA NOR HAFIDA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(69, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ILHAM  ARIFIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(70, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *JEAN TRAVIS*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(71, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Mohamad Syarul Arifin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(72, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD RAFI RULIYA PRAT*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(73, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Nur Faiqoh Nalini*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(74, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NURIL MAULIDIYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(75, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *REVINDRA EZY SAPUTRA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(76, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *RIA FAIQOTUL MALA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(77, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Rigo Pratono*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(78, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *RIZQIA SABILIL KHOIRO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(79, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SHERINA SHEILA FEBIOLA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(80, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SINDI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(81, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Sindy Lailatul Fitria*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(82, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Tito Wahyu Ardiansyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(83, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *TYAS YUSNIAR*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(84, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ULFA FEBRIANTIKA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(85, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Wahyu Firmansyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(86, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Wisnu wardana Maulana Akb*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(87, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *WULAN SUCI ROMADONI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(88, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ADINDA FATIMATUS SOLIKHA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(89, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AFIFAH NUR FARIDAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(90, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AINI MAGHFIROH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(91, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AJENG PRATIWI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(92, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Allya Eva Rahmawati*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(93, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Aura Nasya Violani*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(94, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DEVY NAYSHILATUL JANNAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(95, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DIAN ANUGRAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(96, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DINA PUTRI AULYA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(97, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Dinda Dwi Agustin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(98, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FAIZ MEILANI PUTRI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(99, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *HAURA AINI AL-FIRDAUSI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(100, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Herlina*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(101, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Kiara Marsa Kamila*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(102, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *LIA ANDRIANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(103, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NADA SAVAIRA RIZQIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(104, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Niken Ayuni Kharisma*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(105, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NORHOLIZA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(106, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *PUTRI ROMADHONI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(107, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Putri Zahrani Aura Nadhit*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(108, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SALSA DWI ISPRIANTINA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(109, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SEPTA RAMADHANI STYOWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(110, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *TAUFIQA RAMADANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(111, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *YULIANI DATUL ALIYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(112, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ZHAHROTUS SYITA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(113, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ADITYA KURNIAWAN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(114, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Afnan Nur Ghofur*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(115, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *AHMAD ZAKARIA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(116, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DEDI CANDRA WIJAYA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(117, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Evan Septiyan Ramadhani*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(118, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FAREL EMARALDI DINATA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(119, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Nafis Arifin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(120, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *KEVIN KURNIAWAN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(121, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MAULANAFIZ AL RAFIDIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(122, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MOCH RAKA RADITYA PRATAMA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(123, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD AGUSTIAN FERDIAN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(124, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Muhammad Ardin Ardiansyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(125, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD FAREL AFIFUDIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(126, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD NAJIVA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(127, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUKHAMMAD IQBAL GOZALI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(128, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Putrawan*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(129, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Rahmad Mauludin*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(130, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *RAMADANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(131, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Ridho Firmansyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(132, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Rohizul Kifli Jaelani*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(133, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Satrio Dwi Wahono*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(134, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SEPTIAN AGUNG PRASETYO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(135, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *TORIKUL FATA ZAIDAAN ARIE*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(136, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *WAHYU ADI PRATAMA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:57'),
(137, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Andika*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(138, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ADINDA PUTRI NURLAILIN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(139, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DEA APRILIA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(140, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Dinda Uswatun Hasanah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(141, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ELSI DINI ANANTA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(142, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FARADINA AMIROTUL ADILAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(143, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FIKA RAHMAWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(144, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FIRDAUSYAH SALSABILA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(145, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Halimah Tusakdiyah*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(146, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *HILWA SEPTIANA SAFITRI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(147, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *IMELIA HERNIATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(148, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *LIDIA AMELIA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(149, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NIKMATUL JANNAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(150, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Risa Lisdiana*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(151, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ROHMATULLAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(152, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Safira Ayu Lestari*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(153, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SITI NUR AISYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(154, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SITI ROHMAIDA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(155, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SUSANTI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(156, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Umayro Uswatun Aninia*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(157, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *WILDA AGUSTIANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(158, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ADINDA ZAHIRA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(159, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ALFIRA SYAHRA PUTRI TUNGG*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(160, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ANGGRAINI ISTIQOMAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(161, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FAIQOTUN NASIROH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(162, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *FATIMAH BATUL KAREENA DIV*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(163, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *INTAN NUR KOMARIA MAULIDI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(164, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *Kinanti Ayu Lestari*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(165, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *LUTHFILLAH GHINA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(166, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NABILA ZAHROTUS SYAFA\'AH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(167, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NUR AINI CAHYATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(168, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NUR HIDAYAH PUTRI RAMADHA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(169, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *NURSAFIKA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(170, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *PUTRI ARVINA DAMAYANTI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(171, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *SILVI EKA RAHMAWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(172, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *TAZKIYAH ANNISA HANDOYO*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(173, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *WULAN RAHMA PUTRI CAHYANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(174, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ZAHRA ULFIANA YULIANI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(175, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DEWI FATMASARI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(176, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DWI ANDIKA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(177, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *DWI ANDINI KURNIAWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(178, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *HIDAYATUL ANISAK*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(179, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ISMI AZIZAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(180, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *KHOIRIAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(181, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MAR\'ATUS SHOLIHAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(182, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MOCHAMMAD REZA FERDIANSYA*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(183, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MOHAMAD GUNTUR*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(184, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MOHAMMAD FENDI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(185, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMAD IQBAL*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(186, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *MUHAMMAD BAGUS FIRMANSYAH*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(187, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *ROHMAWATI*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(188, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *TOMY KURNIAWAN*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58'),
(189, '085784880169', 'Assalamu\'alaikum Bapak/Ibu Wali Kelas,\n\nPemberitahuan Absensi:\nSiswa Anda: *UMAR ABDUL AZIZ*\nStatus: *Alpa* (Belum hadir hingga pukul 07:16)\n\nMohon konfirmasi keterangannya.\n— [SMK AL-MALIKI]', 'pending', '2026-05-08 00:17:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_absensi_siswa` (`id_siswa`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `NIS` (`id_siswa`);

--
-- Indexes for table `libur_kelas`
--
ALTER TABLE `libur_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wa_queue`
--
ALTER TABLE `wa_queue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1820;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `libur_kelas`
--
ALTER TABLE `libur_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wa_queue`
--
ALTER TABLE `wa_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `data` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nis` FOREIGN KEY (`id_siswa`) REFERENCES `data` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
