<style>
/* ══════════════════════════════════════════
   HERO SECTION — Mobile-First, SID Standard
   ══════════════════════════════════════════ */

/* ── Full carousel hero untuk desktop ── */
.hero-section {
    position: relative;
    overflow: hidden;
    height: 380px;
}

.hero-section .carousel,
.hero-section .carousel-inner,
.hero-section .carousel-item {
    height: 100%;
}

.hero-section .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6);
}

/* ── Overlay teks di tengah carousel ── */
.hero-overlay {
    position: absolute;
    inset: 0;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    background: linear-gradient(to bottom, rgba(10,40,80,0.35) 0%, rgba(10,40,80,0.55) 100%);
}

.hero-overlay img.logo-desa {
    width: 72px;
    margin-bottom: 10px;
    filter: drop-shadow(0 3px 6px rgba(0,0,0,0.4));
}

.hero-overlay h1 {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    text-shadow: 1px 2px 8px rgba(0,0,0,0.7);
    margin-bottom: 4px;
    letter-spacing: 1px;
}

.hero-overlay p {
    font-size: 14px;
    color: rgba(255,255,255,0.92);
    text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
    margin-bottom: 18px;
}

.hero-buttons .btn {
    font-size: 13px;
    padding: 7px 18px;
    border-radius: 25px;
    margin: 3px 4px;
    font-weight: 600;
    border-width: 1.5px;
    backdrop-filter: blur(4px);
}

.hero-buttons .btn-outline-light:hover {
    background: rgba(255,255,255,0.15);
}

/* ── Carousel caption (tersembunyi, teks sudah di overlay) ── */
.hero-section .carousel-caption {
    display: none !important;
}

/* ── Responsive Mobile ── */
@media (max-width: 576px) {
    .hero-section {
        height: 300px;
    }
    .hero-overlay h1 {
        font-size: 20px;
    }
    .hero-overlay p {
        font-size: 12px;
        margin-bottom: 12px;
    }
    .hero-overlay img.logo-desa {
        width: 55px;
        margin-bottom: 8px;
    }
    .hero-buttons .btn {
        font-size: 12px;
        padding: 6px 14px;
    }
}
</style>

<section class="hero-section">
    <!-- Carousel Foto Desa -->
    <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100" data-bs-interval="4500">
                <img src="https://assets.promediateknologi.id/crop/0x0:0x0/1200x0/webp/photo/p1/882/2023/09/03/WhatsApp-Image-2023-09-03-at-194902-2548912262.jpeg" class="d-block w-100" alt="Karnaval Budaya Desa Bades">
            </div>
            <div class="carousel-item h-100" data-bs-interval="4500">
                <img src="https://humas.polri.go.id/api/article-files/viewer/1000482179_605919.jpg" class="d-block w-100" alt="Pelayanan Kependudukan">
            </div>
            <div class="carousel-item h-100" data-bs-interval="4500">
                <img src="https://cdn.antaranews.com/cache/1200x800/2024/01/12/WhatsApp_Image_2024-01-12_at_10_36_34_AM.jpg" class="d-block w-100" alt="Potensi Pertanian Bades">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Overlay Teks — Selalu Terlihat -->
    <div class="hero-overlay">
        <img src="assets/img/logolumajang.png" alt="Logo Desa Bades" class="logo-desa">
        <h1>DESA BADES</h1>
        <p>Kecamatan Pasirian, Kabupaten Lumajang &mdash; Jawa Timur</p>
        <div class="hero-buttons">
            <a href="profil.php" class="btn btn-outline-light"><i class="fa-solid fa-address-card me-1"></i> Profil</a>
            <a href="pemerintahan.php" class="btn btn-outline-light"><i class="fa-solid fa-users me-1"></i> Pemerintahan</a>
            <a href="layanan.php" class="btn btn-light text-primary fw-bold"><i class="fa-solid fa-hand-holding-heart me-1"></i> Layanan</a>
        </div>
    </div>
</section>
