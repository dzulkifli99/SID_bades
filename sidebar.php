<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$username_ses = $_SESSION['username'] ?? 'Admin';
$current_page = basename($_SERVER['PHP_SELF']);

// Notif badge
include_once 'koneksi.php';
$q_ns = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM layanan_surat WHERE status='Menunggu'");
$notif_surat = $q_ns ? mysqli_fetch_assoc($q_ns)['n'] : 0;
$q_np = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM pengaduan WHERE status='Baru'");
$notif_pengaduan = $q_np ? mysqli_fetch_assoc($q_np)['n'] : 0;
?>
<style>
/* Admin Sidebar — shared across all admin pages */
.admin-sidebar {
    position: fixed; top: 0; left: 0; bottom: 0; width: 240px;
    background: linear-gradient(180deg, #0c3460 0%, #0f4c81 60%, #1a6db5 100%);
    z-index: 200; display: flex; flex-direction: column;
    overflow-y: auto; transition: transform 0.3s;
}
.sidebar-brand { padding: 16px; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 10px; }
.sidebar-brand img { width: 36px; }
.sidebar-brand .brand-text { font-size: 13px; font-weight: 700; color: #fff; line-height: 1.2; }
.sidebar-brand .brand-sub  { font-size: 10px; color: rgba(255,255,255,0.5); }
.sidebar-section { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.35); padding: 14px 16px 4px; font-weight: 700; }
.sidebar-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 18px; color: rgba(255,255,255,0.75);
    text-decoration: none; font-size: 13px; font-weight: 600;
    border-left: 3px solid transparent; transition: all 0.2s;
}
.sidebar-item i { width: 16px; text-align: center; }
.sidebar-item:hover, .sidebar-item.active { background: rgba(255,255,255,0.1); color: #fff; border-left-color: #fff; }
.sidebar-item.danger { color: rgba(255,150,150,0.85); }
.sidebar-item.danger:hover { background: rgba(255,100,100,0.1); color: #fca5a5; }
.sidebar-badge { background: #ef4444; font-size: 10px; padding: 1px 7px; border-radius: 10px; margin-left: auto; color: #fff; }

/* Admin Main Layout */
.admin-main { margin-left: 240px; min-height: 100vh; }
.admin-topbar {
    background: #fff; padding: 12px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex; justify-content: space-between; align-items: center;
    position: sticky; top: 0; z-index: 100;
}
.admin-topbar .page-title { font-weight: 700; font-size: 15px; color: #111; }
.sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 199; }
.sidebar-overlay.show { display: block; }
.sidebar-toggle { display: none; }

@media (max-width: 991px) {
    .admin-sidebar { transform: translateX(-100%); }
    .admin-sidebar.open { transform: translateX(0); }
    .admin-main { margin-left: 0; }
    .sidebar-toggle { display: flex !important; }
}
</style>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <img src="assets/img/logolumajang.png" alt="Logo">
        <div>
            <div class="brand-text">DESA BADES</div>
            <div class="brand-sub">Panel Admin SID</div>
        </div>
    </div>

    <div class="sidebar-section">Utama</div>
    <a href="dashboard.php" class="sidebar-item <?= $current_page=='dashboard.php'?'active':'' ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>

    <div class="sidebar-section">Master Data</div>
    <a href="admin_penduduk.php" class="sidebar-item <?= $current_page=='admin_penduduk.php'?'active':'' ?>"><i class="fa-solid fa-users"></i> Data Penduduk</a>
    <a href="admin_akun_warga.php" class="sidebar-item <?= $current_page=='admin_akun_warga.php'?'active':'' ?>"><i class="fa-solid fa-user-lock"></i> Akun Warga</a>
    <a href="admin_statistik.php" class="sidebar-item <?= $current_page=='admin_statistik.php'?'active':'' ?>"><i class="fa-solid fa-chart-pie"></i> Statistik Desa</a>
    <a href="admin_umkm.php" class="sidebar-item <?= $current_page=='admin_umkm.php'?'active':'' ?>"><i class="fa-solid fa-store"></i> Kelola UMKM</a>

    <div class="sidebar-section">Layanan Warga</div>
    <a href="admin_surat.php" class="sidebar-item <?= $current_page=='admin_surat.php'?'active':'' ?>">
        <i class="fa-solid fa-file-signature"></i> Persetujuan Surat
        <?php if($notif_surat>0): ?><span class="sidebar-badge"><?= $notif_surat ?></span><?php endif; ?>
    </a>
    <a href="admin_pengaduan.php" class="sidebar-item <?= $current_page=='admin_pengaduan.php'?'active':'' ?>">
        <i class="fa-solid fa-comment-dots"></i> Kotak Pengaduan
        <?php if($notif_pengaduan>0): ?><span class="sidebar-badge"><?= $notif_pengaduan ?></span><?php endif; ?>
    </a>

    <div class="sidebar-section">Konten</div>
    <a href="admin_berita.php" class="sidebar-item <?= $current_page=='admin_berita.php'?'active':'' ?>"><i class="fa-solid fa-newspaper"></i> Kelola Berita</a>

    <div class="sidebar-section">Akses Cepat</div>
    <a href="index.php" target="_blank" class="sidebar-item"><i class="fa-solid fa-earth-asia"></i> Lihat Website</a>
    <a href="logout.php" class="sidebar-item danger"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
</div>

<script>
function toggleSidebar() {
    document.getElementById('adminSidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
function closeSidebar() {
    document.getElementById('adminSidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('show');
}
</script>