<?php
// Ambil data statistik jika belum ada
// Ambil data statistik desa
$q_stats = mysqli_query($koneksi, "SELECT * FROM statistik_desa LIMIT 1");
if ($q_stats && mysqli_num_rows($q_stats) > 0) {
    $row_stats = mysqli_fetch_assoc($q_stats);
    $penduduk_laki = $row_stats['jumlah_laki'];
    $penduduk_perempuan = $row_stats['jumlah_perempuan'];
    $jumlah_kk = $row_stats['jumlah_kk'];
    $jumlah_dusun = $row_stats['jumlah_dusun'];
} else {
    $penduduk_laki = 2145;
    $penduduk_perempuan = 2210;
    $jumlah_kk = 1420;
    $jumlah_dusun = 4;
}

$is_small = isset($stats_small) && $stats_small ? 'stats-small' : '';
?>
<style>
/* ── Statistik Mengambang (Floating Stats) ── */
.stats-floating-section {
    position: relative;
    z-index: 10;
    margin-top: -45px; /* Efek mengambang melintasi batas hero */
    padding-bottom: 40px;
    text-align: center;
}

.stats-floating-section.stats-small {
    margin-top: -30px;
    padding-bottom: 20px;
}

.stat-circle-wrap {
    display: inline-block;
    position: relative;
    width: 170px;
    height: 170px;
    margin: 0 15px 15px;
    border-radius: 50%;
    background: radial-gradient(circle, #ffffff 40%, #f1f5f9 100%);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15), inset 0 -5px 15px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #111;
    transition: transform 0.3s ease;
}
.stat-circle-wrap:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2), inset 0 -5px 15px rgba(0,0,0,0.05);
}
.stats-small .stat-circle-wrap {
    width: 120px;
    height: 120px;
    margin: 0 10px 10px;
}

/* Colored borders melingkar */
.stat-circle-wrap::before {
    content: '';
    position: absolute;
    top: -6px; left: -6px; right: -6px; bottom: -6px;
    border-radius: 50%;
    border: 6px solid transparent;
    z-index: 0;
}
.stat-circle-wrap.laki::before { border-top-color: #06b6d4; border-left-color: #06b6d4; }
.stat-circle-wrap.perempuan::before { border-top-color: #ec4899; border-right-color: #ec4899; }
.stat-circle-wrap.kk::before { border-bottom-color: #22c55e; border-right-color: #22c55e; }
.stat-circle-wrap.dusun::before { border-bottom-color: #f97316; border-left-color: #f97316; }

.stat-circle-content {
    position: relative;
    z-index: 1;
}
.stat-circle-content img {
    width: 45px;
    height: 45px;
    margin-bottom: 5px;
    filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
}
.stats-small .stat-circle-content img {
    width: 30px;
    height: 30px;
    margin-bottom: 2px;
}
.stat-circle-content h3 {
    font-size: 28px;
    font-weight: 800;
    margin: 0;
    line-height: 1;
    color: #000;
}
.stats-small .stat-circle-content h3 {
    font-size: 18px;
}
.stat-circle-content p {
    font-size: 13px;
    font-weight: 700;
    margin: 5px 0 0;
    text-transform: uppercase;
    color: #444;
}
.stats-small .stat-circle-content p {
    font-size: 10px;
    margin: 2px 0 0;
}

@media (max-width: 768px) {
    .stats-floating-section {
        margin-top: -35px;
    }
    .stat-circle-wrap {
        width: 140px;
        height: 140px;
        margin: 0 5px 15px;
    }
    .stat-circle-content h3 { font-size: 24px; }
    .stat-circle-content img { width: 35px; height: 35px; }
    
    .stats-small .stat-circle-wrap {
        width: 100px;
        height: 100px;
    }
}
</style>

<section class="stats-floating-section <?= $is_small ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 col-md-3 text-center mb-3 d-flex justify-content-center">
                <div class="stat-circle-wrap laki">
                    <div class="stat-circle-content">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Laki-laki">
                        <h3 class="counter" data-target="<?= $penduduk_laki ?>">0</h3>
                        <p>LAKI-LAKI</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center mb-3 d-flex justify-content-center">
                <div class="stat-circle-wrap perempuan">
                    <div class="stat-circle-content">
                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140047.png" alt="Perempuan">
                        <h3 class="counter" data-target="<?= $penduduk_perempuan ?>">0</h3>
                        <p>PEREMPUAN</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center mb-3 d-flex justify-content-center">
                <div class="stat-circle-wrap kk">
                    <div class="stat-circle-content">
                        <img src="https://cdn-icons-png.flaticon.com/512/6889/6889345.png" alt="KK">
                        <h3 class="counter" data-target="<?= $jumlah_kk ?>">0</h3>
                        <p>KK</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center mb-3 d-flex justify-content-center">
                <div class="stat-circle-wrap dusun">
                    <div class="stat-circle-content">
                        <img src="https://cdn-icons-png.flaticon.com/512/3710/3710297.png" alt="Dusun">
                        <h3 class="counter" data-target="<?= $jumlah_dusun ?>">0</h3>
                        <p>DUSUN</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Counter Animation
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            
            const rect = counter.getBoundingClientRect();
            if(rect.top < window.innerHeight && counter.innerText == '0') {
                updateCount();
            }
        });
    }
    
    window.addEventListener('scroll', animateCounters);
    animateCounters();
});
</script>
