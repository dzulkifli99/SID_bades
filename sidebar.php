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
$q_nw = mysqli_query($koneksi, "SELECT COUNT(*) as n FROM warga_akun WHERE status_akun='Menunggu'");
$notif_warga = $q_nw ? mysqli_fetch_assoc($q_nw)['n'] : 0;
?>
<style>
    /* Admin Sidebar — shared across all admin pages */
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 240px;
        background: linear-gradient(180deg, #0c3460 0%, #0f4c81 60%, #1a6db5 100%);
        z-index: 200;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        transition: transform 0.3s;
    }

    .sidebar-brand {
        padding: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-brand img {
        width: 36px;
    }

    .sidebar-brand .brand-text {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }

    .sidebar-brand .brand-sub {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.5);
    }

    .sidebar-section {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.35);
        padding: 14px 16px 4px;
        font-weight: 700;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border-left: 3px solid transparent;
        transition: all 0.2s;
    }

    .sidebar-item i {
        width: 16px;
        text-align: center;
    }

    .sidebar-item:hover,
    .sidebar-item.active {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border-left-color: #fff;
    }

    .sidebar-item.danger {
        color: rgba(255, 150, 150, 0.85);
    }

    .sidebar-item.danger:hover {
        background: rgba(255, 100, 100, 0.1);
        color: #fca5a5;
    }

    .sidebar-badge {
        background: #ef4444;
        font-size: 10px;
        padding: 1px 7px;
        border-radius: 10px;
        margin-left: auto;
        color: #fff;
    }

    .sidebar-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.07);
        margin: 4px 16px;
    }

    /* Admin Main Layout */
    .admin-main {
        margin-left: 240px;
        min-height: 100vh;
        transition: opacity 0.12s ease;
    }

    .sidebar-badge.pulse {
        animation: sidebarBadgePulse 0.6s ease;
    }

    @keyframes sidebarBadgePulse {
        0% { transform: scale(1); }
        30% { transform: scale(1.35); }
        100% { transform: scale(1); }
    }

    .admin-topbar {
        background: #fff;
        padding: 12px 20px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .admin-topbar .page-title {
        font-weight: 700;
        font-size: 15px;
        color: #111;
    }

    .admin-topbar .user-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f1f5f9;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        color: #444;
    }

    .admin-topbar .user-pill i {
        color: #0f4c81;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 199;
    }

    .sidebar-overlay.show {
        display: block;
    }

    .sidebar-toggle {
        display: none;
    }

    @media (max-width: 991px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }

        .admin-sidebar.open {
            transform: translateX(0);
        }

        .admin-main {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: flex !important;
        }
    }
</style>

<?php include "komponen_splash.php"; ?>

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
    <a href="dashboard.php" class="sidebar-item <?= $current_page == 'dashboard.php' ? 'active' : '' ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>

    <div class="sidebar-section">Master Data</div>
    <a href="admin_penduduk.php" class="sidebar-item <?= $current_page == 'admin_penduduk.php' ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Data Penduduk</a>
    <a href="admin_akun_warga.php" class="sidebar-item <?= $current_page == 'admin_akun_warga.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-user-lock"></i> Akun Warga
        <span class="sidebar-badge" id="notifBadgeWarga" style="background:#f59e0b; <?= $notif_warga > 0 ? '' : 'display:none;' ?>"><?= $notif_warga ?></span>
    </a>
    <a href="admin_statistik.php" class="sidebar-item <?= $current_page == 'admin_statistik.php' ? 'active' : '' ?>"><i class="fa-solid fa-chart-pie"></i> Statistik Desa</a>
    <a href="admin_apbdes.php" class="sidebar-item <?= $current_page == 'admin_apbdes.php' ? 'active' : '' ?>"><i class="fa-solid fa-wallet"></i> APBDes</a>
    <a href="admin_demografi.php" class="sidebar-item <?= $current_page == 'admin_demografi.php' ? 'active' : '' ?>"><i class="fa-solid fa-people-group"></i> Data Kependudukan Lanjutan</a>
    <a href="admin_umkm.php" class="sidebar-item <?= $current_page == 'admin_umkm.php' ? 'active' : '' ?>"><i class="fa-solid fa-store"></i> Kelola UMKM</a>
    <a href="admin_struktur.php" class="sidebar-item <?= $current_page == 'admin_struktur.php' ? 'active' : '' ?>"><i class="fa-solid fa-sitemap"></i> Struktur Desa</a>

    <div class="sidebar-section">Layanan Warga</div>
    <a href="admin_surat.php" class="sidebar-item <?= $current_page == 'admin_surat.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-file-signature"></i> Persetujuan Surat
        <span class="sidebar-badge" id="notifBadgeSurat" style="<?= $notif_surat > 0 ? '' : 'display:none;' ?>"><?= $notif_surat ?></span>
    </a>
    <a href="admin_pengaduan.php" class="sidebar-item <?= $current_page == 'admin_pengaduan.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-comment-dots"></i> Kotak Pengaduan
        <span class="sidebar-badge" id="notifBadgePengaduan" style="<?= $notif_pengaduan > 0 ? '' : 'display:none;' ?>"><?= $notif_pengaduan ?></span>
    </a>

    <div class="sidebar-section">Konten Website</div>
    <a href="admin_berita.php" class="sidebar-item <?= $current_page == 'admin_berita.php' ? 'active' : '' ?>"><i class="fa-solid fa-newspaper"></i> Kelola Berita</a>
    <a href="admin_kegiatan.php" class="sidebar-item <?= $current_page == 'admin_kegiatan.php' ? 'active' : '' ?>"><i class="fa-solid fa-photo-film"></i> Pegumuman Desa</a>
    <a href="admin_momen.php" class="sidebar-item <?= $current_page == 'admin_momen.php' ? 'active' : '' ?>"><i class="fa-solid fa-images"></i> Momen Kegiatan Desa</a>
    <a href="admin_hero.php" class="sidebar-item <?= $current_page == 'admin_hero.php' ? 'active' : '' ?>"><i class="fa-solid fa-panorama"></i> Foto Hero/Slider</a>

    <div class="sidebar-section">Pengaturan</div>
    <a href="admin_akun.php" class="sidebar-item <?= $current_page == 'admin_akun.php' ? 'active' : '' ?>"><i class="fa-solid fa-key"></i> Kelola Akun Admin</a>
    <a href="admin_backup.php" class="sidebar-item <?= $current_page == 'admin_backup.php' ? 'active' : '' ?>"><i class="fa-solid fa-database"></i> Backup Database</a>

    <div class="sidebar-divider"></div>
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

    // Sidebar ini di-include di awal <body>, sebelum ".admin-main" ada di HTML —
    // jadi semua setup di bawah HARUS menunggu seluruh dokumen selesai di-parse
    // (DOMContentLoaded), kalau tidak document.querySelector('.admin-main') akan
    // selalu null karena elemen itu belum ada saat script ini pertama dieksekusi.
    document.addEventListener('DOMContentLoaded', function () {

    // ===== Navigasi antar menu admin tanpa reload penuh halaman (AJAX/pjax) =====
    // Hanya mengganti isi ".admin-main" + gaya & script khusus halaman tujuan;
    // sidebar & polling notifikasi di bawah tidak pernah ikut dimuat ulang.
    (function () {
        var mainEl = document.querySelector('.admin-main');
        if (!mainEl || !window.fetch || !window.history.pushState) return;

        // Sebagian halaman admin (mis. Data Penduduk/Akun Warga pakai DataTables,
        // yang keduanya butuh jQuery) memuat pustaka <script src> miliknya sendiri.
        // Supaya halaman itu tetap berfungsi walau dibuka lewat navigasi cepat ini,
        // catat pustaka yang SUDAH ada di halaman awal, lalu muat pustaka yang BELUM
        // ada secara berurutan sebelum menjalankan script khusus halaman tujuan.
        var loadedScriptSrcs = {};
        document.querySelectorAll('script[src]').forEach(function (s) {
            loadedScriptSrcs[s.getAttribute('src')] = true;
        });

        // Beberapa halaman admin (mis. modal "Detail"/"Edit") meletakkan markup
        // modal Bootstrap sebagai SIBLING setelah ".admin-main" (bukan di
        // dalamnya) supaya tidak ikut kepotong renderan awal — tapi pjax hanya
        // mengganti innerHTML ".admin-main", jadi markup itu TIDAK PERNAH ikut
        // termuat saat pindah halaman lewat klik sidebar (elemen modal jadi
        // hilang total dari DOM -> tombol yang membukanya terlihat "tidak
        // berfungsi", atau kalau kebetulan masih ada modal id sama nempel dari
        // halaman sebelumnya, isinya jadi basi/salah -> "kadang muncul kadang
        // tidak"). Wadah ini menampung ulang markup tsb tiap navigasi supaya
        // selalu sinkron dengan halaman yang sedang aktif.
        var extraContainer = document.createElement('div');
        extraContainer.id = 'pjaxExtraContent';
        mainEl.parentNode.insertBefore(extraContainer, mainEl.nextSibling);
        (function migrateInitialExtraSiblings() {
            var sib = extraContainer.nextSibling;
            while (sib) {
                var next = sib.nextSibling;
                if (sib.nodeType === 1 && sib.tagName !== 'SCRIPT') {
                    extraContainer.appendChild(sib);
                }
                sib = next;
            }
        })();

        function syncExtraContent(doc) {
            var html = '';
            doc.querySelectorAll('.admin-main ~ *:not(script)').forEach(function (el) {
                html += el.outerHTML;
            });
            extraContainer.innerHTML = html;
        }

        function loadExternalScripts(srcs, callback) {
            var toLoad = srcs.filter(function (src) { return !loadedScriptSrcs[src]; });
            if (toLoad.length === 0) { callback(); return; }

            var remaining = toLoad.length;
            function onOneDone() {
                remaining--;
                if (remaining === 0) callback();
            }

            // Semua script diunduh PARALEL (async=false bukan berarti sinkron, hanya
            // menjamin browser tetap MENGEKSEKUSI-nya sesuai urutan penambahan ke DOM
            // walau unduhannya paralel) — jauh lebih cepat daripada menunggu satu-satu
            // selesai baru mulai unduh berikutnya, penting supaya tombol yang baru aktif
            // setelah DataTables/jQuery siap tidak terasa "macet" beberapa detik saat
            // halaman dibuka lewat klik sidebar.
            toLoad.forEach(function (src) {
                var el = document.createElement('script');
                el.src = src;
                el.async = false;
                el.onload = function () { loadedScriptSrcs[src] = true; onOneDone(); };
                el.onerror = function () { loadedScriptSrcs[src] = true; onOneDone(); }; // tetap lanjut, jangan sampai macet total
                document.body.appendChild(el);
            });
        }

        function runPageScripts(doc) {
            // Script khusus tiap halaman selalu diletakkan setelah ".admin-main"
            // (sebelum </body>), jadi selector sibling ini tidak pernah menyentuh
            // script sidebar ini sendiri (yang letaknya sebelum ".admin-main").
            var externalSrcs = [];
            doc.querySelectorAll('.admin-main ~ script[src]').forEach(function (s) {
                externalSrcs.push(s.getAttribute('src'));
            });
            var inlineScripts = doc.querySelectorAll('.admin-main ~ script:not([src])');

            loadExternalScripts(externalSrcs, function () {
                // Dijalankan lewat eval TIDAK LANGSUNG (bentuk "(0, eval)(...)"), bukan
                // elemen <script> biasa ataupun new Function():
                // - beda dengan new Function(): function/var di dalamnya tetap nempel ke
                //   scope global, jadi tetap bisa dipanggil dari atribut HTML seperti
                //   onclick="togglePw(...)".
                // - beda dengan elemen <script>: deklarasi const/let di level atas (mis.
                //   "const flash = ...", pola yang dipakai hampir semua halaman admin
                //   untuk toast SweetAlert) TIDAK bentrok walau halaman yang sama dibuka
                //   berkali-kali — beberapa <script> tag classic berbagi satu lexical
                //   scope global yang sama sehingga const/let di dalamnya tidak boleh
                //   dideklarasikan ulang, sedangkan tiap panggilan eval mendapat scope
                //   tersendiri untuk deklarasi const/let level atasnya.
                inlineScripts.forEach(function (s) {
                    try {
                        (0, eval)(s.textContent);
                    } catch (err) { console.error('Gagal menjalankan script halaman:', err); }
                });
            });
        }

        function syncPageStyle(doc) {
            var pageStyle = doc.querySelector('head style');
            var content = pageStyle ? pageStyle.textContent : '';
            var target = document.getElementById('pjaxPageStyle');
            if (!target) {
                target = document.createElement('style');
                target.id = 'pjaxPageStyle';
                document.head.appendChild(target);
            }
            target.textContent = content;
        }

        function setActiveLink(url) {
            var file = url.split('?')[0].split('/').pop();
            document.querySelectorAll('.sidebar-item').forEach(function (a) {
                var href = (a.getAttribute('href') || '').split('?')[0].split('/').pop();
                a.classList.toggle('active', href !== '' && href === file);
            });
        }

        function loadPage(url, push) {
            mainEl.style.opacity = '0.35';
            fetch(url, { credentials: 'same-origin' })
                .then(function (res) {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.text().then(function (html) { return { html: html, finalUrl: res.url }; });
                })
                .then(function (data) {
                    var doc = new DOMParser().parseFromString(data.html, 'text/html');
                    var newMain = doc.querySelector('.admin-main');
                    if (!newMain) {
                        // Bukan halaman admin standar (misalnya sesi habis & dialihkan ke login) -> muat penuh
                        window.location.href = data.finalUrl;
                        return;
                    }
                    syncPageStyle(doc);
                    syncExtraContent(doc);
                    mainEl.innerHTML = newMain.innerHTML;
                    mainEl.style.opacity = '1';
                    var newTitle = doc.querySelector('title');
                    if (newTitle) document.title = newTitle.textContent;
                    setActiveLink(data.finalUrl);
                    closeSidebar();
                    if (push) history.pushState({ pjax: true }, '', data.finalUrl);
                    runPageScripts(doc);
                    window.scrollTo(0, 0);
                })
                .catch(function (err) {
                    console.error('Navigasi cepat gagal, memuat ulang halaman penuh:', err);
                    window.location.href = url;
                });
        }

        document.querySelectorAll('.sidebar-item').forEach(function (link) {
            if (link.target === '_blank' || link.classList.contains('danger')) return; // lewati "Lihat Website" & "Keluar"
            link.addEventListener('click', function (e) {
                var href = link.getAttribute('href');
                if (!href || href.charAt(0) === '#') return;
                e.preventDefault();
                if (link.classList.contains('active')) { closeSidebar(); return; }
                loadPage(href, true);
            });
        });

        window.addEventListener('popstate', function () {
            loadPage(location.href, false);
        });
    })();

    // ===== Notifikasi live tanpa reload: cek berkala permintaan surat/akun warga baru =====
    (function () {
        var badgeSurat = document.getElementById('notifBadgeSurat');
        var badgePengaduan = document.getElementById('notifBadgePengaduan');
        var badgeWarga = document.getElementById('notifBadgeWarga');
        var prevTotal = null;

        function updateBadge(el, count) {
            if (!el) return;
            var wasHidden = el.style.display === 'none';
            if (count > 0) {
                if (el.textContent != count && !wasHidden) {
                    el.classList.remove('pulse');
                    void el.offsetWidth; // restart animasi
                    el.classList.add('pulse');
                }
                el.textContent = count;
                el.style.display = '';
            } else {
                el.style.display = 'none';
            }
        }

        function checkNotif() {
            fetch('admin_notif_check.php', { credentials: 'same-origin' })
                .then(function (res) { return res.ok ? res.json() : null; })
                .then(function (data) {
                    if (!data || data.error) return;
                    updateBadge(badgeSurat, data.surat);
                    updateBadge(badgePengaduan, data.pengaduan);
                    updateBadge(badgeWarga, data.warga);

                    var total = data.surat + data.pengaduan + data.warga;
                    if (prevTotal !== null && total > prevTotal && window.Swal) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ada Permintaan Baru',
                            text: 'Ada surat/pengaduan/akun warga baru yang perlu diverifikasi.',
                            toast: true,
                            position: 'top-end',
                            timer: 4500,
                            showConfirmButton: false
                        });
                    }
                    prevTotal = total;
                })
                .catch(function () {});
        }

        checkNotif();
        setInterval(checkNotif, 15000);
    })();

    }); // akhir DOMContentLoaded
</script>