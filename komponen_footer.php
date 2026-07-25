<style>
    /* ── Footer ── */
    .footer {
        background-color: #1a2226;
        color: #ccc;
        padding: 60px 0 30px;
        font-size: 14px;
        margin-top: 50px;
        border-top: 4px solid #0f4c81;
    }

    .footer h4 {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer h4::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background-color: #0f4c81;
    }

    .footer p { line-height: 1.6; }

    .footer ul {
        padding: 0;
        list-style: none;
    }

    .footer ul li { margin-bottom: 12px; }

    .footer ul li a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer ul li a:hover {
        color: #fff;
        padding-left: 5px;
    }

    .footer ul li i {
        margin-right: 8px;
        color: #0f4c81;
    }

    .social-links {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-links a:hover {
        background-color: #0f4c81;
        transform: translateY(-3px);
    }

    .footer-bottom {
        background-color: #111;
        padding: 20px 0;
        color: #888;
        font-size: 13px;
        text-align: center;
    }

    .footer-bottom strong { color: #aaa; }
</style>

<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Tentang -->
            <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-3">
                    <img src="assets/img/logolumajang.png" alt="Logo Desa" style="width: 50px; margin-right: 15px;">
                    <div>
                        <h4 class="mb-0" style="border:none; padding:0;">DESA BADES</h4>
                    </div>
                </div>
                <p>Sistem Informasi Desa (SID) Bades, Kecamatan Pasirian, Kabupaten Lumajang. Media komunikasi dan transparansi pemerintah desa untuk masyarakat.</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/kimbimagatra/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@desa_bades" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@desa_bades" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                <h4>Kontak &amp; Keamanan Desa</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> Jl. Raya Bades No. 1, Pasirian, Lumajang 67372</li>
                    <li><i class="fa-solid fa-phone"></i> Kantor Desa: (0334) 123456</li>
                    <li><i class="fa-solid fa-envelope"></i> pemdes@bades.desa.id</li>
                    <li><i class="fa-solid fa-user-shield"></i> <strong style="color:#ccc;">Babinkamtibmas:</strong> Bripda Apriliando Shandi N.</li>
                    <li><i class="fa-solid fa-person-military-pointing"></i> <strong style="color:#ccc;">Babinsa:</strong> Sertu Moh. Rohim</li>
                    <li><i class="fa-regular fa-clock"></i> Senin – Jumat: 08.00 – 15.00 WIB</li>
                </ul>
            </div>

            <!-- APBDes Ringkasan -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
                <h4>Transparansi APBDes 2025</h4>
                <ul>
                    <li><i class="fa-solid fa-sack-dollar text-info"></i> Pendapatan: <strong style="color:#fff;">Rp 2,82 M</strong></li>
                    <li><i class="fa-solid fa-cart-shopping text-success"></i> Belanja: <strong style="color:#fff;">Rp 2,45 M</strong></li>
                    <li><i class="fa-solid fa-piggy-bank text-warning"></i> SiLPA: <strong style="color:#fff;">Rp 55,6 Jt</strong></li>
                </ul>
                <a href="apbdes.php" class="btn btn-sm btn-outline-light rounded-pill mt-1" style="font-size:12px;">
                    <i class="fa-solid fa-receipt me-1"></i> Lihat Rincian Lengkap
                </a>
            </div>

        </div>
    </div>
</footer>

<div class="footer-bottom">
    <div class="container">
        &copy; <?= date('Y') ?> <strong>Pemerintah Desa Bades</strong>. Hak Cipta Dilindungi.<br>
        Sistem Informasi Desa Bades
    </div>
</div>

<!-- AOS JS (Bootstrap JS sudah dimuat oleh komponen_navbar.php) -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 800, once: true, offset: 50 });
    }
</script>