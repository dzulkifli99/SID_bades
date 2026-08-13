<style>
    /* ── Footer ── */
    .footer {
        position: relative;
        background-color: #1a2226;
        background-image: linear-gradient(135deg, rgba(15, 76, 129, 0.92) 0%, rgba(12, 58, 42, 0.9) 100%), url('assets/img/dampar.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ccc;
        padding: 10px 0 8px;
        font-size: 12px;
        margin-top: 10px;
        border-top: 4px solid #0f4c81;
    }

    .footer .footer-brand {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 14px;
        position: relative;
        padding-bottom: 8px;
    }

    .footer .footer-brand::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background-color: #0f4c81;
    }

    .footer p {
        line-height: 1.6;
    }

    .footer ul {
        padding: 0;
        list-style: none;
    }

    .footer ul li {
        margin-bottom: 7px;
    }

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
        color: #fff;
    }

    .social-links {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
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

    /* ── Watermark "DESA BADES" (satu teks besar, berjalan ke kiri di tengah footer) ── */
    .footer-watermark {
        position: absolute;
        top: 50%;
        left: 0;
        white-space: nowrap;
        font-size: clamp(30px, 5vw, 80px);
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.1);
        -webkit-text-stroke: 1.5px rgba(255, 255, 255, 0.4);
        text-stroke: 1.5px rgba(255, 255, 255, 0.4);
        pointer-events: none;
        z-index: 0;
        animation: watermark-walk 24s linear infinite;
    }

    @keyframes watermark-walk {
        from {
            transform: translateY(-50%) translateX(100vw);
        }

        to {
            transform: translateY(-50%) translateX(-120%);
        }
    }

    @media (max-width: 768px) {
        .footer-watermark {
            letter-spacing: 2px;
        }
    }

    .footer-bottom {
        background-color: #111;
        padding: 12px 0;
        color: #888;
        font-size: 12px;
        text-align: center;
    }

    .footer-bottom strong {
        color: #aaa;
    }
</style>

<footer class="footer" style="overflow:hidden;">
    <span class="footer-watermark">DESA BADES KECAMATAN PASIRIAN KABUPATEN LUMAJANG</span>
    <div class="container" style="position:relative; z-index:1;">
        <div class="row">
            <!-- Tentang -->
            <div class="col-lg-4 mb-0" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-2">
                    <img src="assets/img/logolumajang.png" alt="Logo Desa" style="width: 36px; margin-right: 10px;">
                    <div>
                        <div class="mb-0 footer-brand" style="border:none; padding:0;">DESA BADES</div>
                    </div>
                </div>
                <p class="mb-2" style="font-size:13px; line-height:1.4;">Sistem Informasi Desa (SID) Bades, Kecamatan Pasirian, Kabupaten Lumajang. Media komunikasi dan transparansi pemerintah desa untuk masyarakat.</p>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> Jl. Raya Bades No. 1, Pasirian, Lumajang 67372</li>
                    <li><i class="fa-solid fa-phone"></i> Kantor Desa: (0334) 123456</li>
                    <li><i class="fa-solid fa-envelope"></i> pemdes@bades.desa.id</li>
                </ul>
                <div class="social-links">
                    <a href="https://www.instagram.com/kimbimagatra/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@desa_bades" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@desa_bades" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>





        </div>
    </div>
</footer>

<div class="footer-bottom">
    <div class="container">
        &copy; <?= date('Y') ?> <strong>Pemerintah Desa Bades</strong>. Hak Cipta Dilindungi.<br>
    </div>
</div>

<!-- AOS JS (Bootstrap JS sudah dimuat oleh komponen_navbar.php) -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    }
</script>