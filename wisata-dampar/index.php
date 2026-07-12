<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dampar Beach | Desa Bades</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f4c81;
            --accent: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
        }
        
        body { font-family: 'Outfit', sans-serif; background-color: var(--light); color: var(--dark); overflow-x: hidden; }
        h1, h2, h3, .serif { font-family: 'Playfair Display', serif; }
        
        /* Navbar */
        .navbar-dampar {
            background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 15px 0;
            transition: 0.3s;
        }
        .navbar-brand { font-weight: 800; font-size: 24px; color: var(--primary) !important; letter-spacing: 1px; }
        .lang-toggle {
            cursor: pointer; border: 2px solid var(--primary); padding: 5px 15px; 
            border-radius: 20px; font-weight: 600; color: var(--primary);
            transition: 0.3s;
        }
        .lang-toggle:hover { background: var(--primary); color: white; }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(to bottom, rgba(15,76,129,0.3), rgba(30,41,59,0.8)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80') center/cover fixed;
            display: flex; align-items: center; justify-content: center; text-align: center; color: white;
            padding-top: 60px;
        }
        .hero h1 { font-size: 5rem; font-weight: 800; text-shadow: 0 4px 15px rgba(0,0,0,0.4); margin-bottom: 20px; }
        .hero p { font-size: 1.3rem; font-weight: 300; max-width: 600px; margin: 0 auto 30px; }
        .btn-discover {
            background: var(--accent); color: white; padding: 12px 35px; border-radius: 30px;
            font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: 0.3s;
            box-shadow: 0 10px 20px rgba(245,158,11,0.3);
        }
        .btn-discover:hover { background: #d97706; color: white; transform: translateY(-3px); }
        
        /* Section Globals */
        section { padding: 90px 0; }
        .section-title { font-size: 2.5rem; color: var(--primary); margin-bottom: 20px; text-align: center; }
        .section-subtitle { text-align: center; color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto 50px; }
        
        /* Features/Activities */
        .activity-card {
            background: white; border-radius: 15px; padding: 30px; text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; height: 100%;
        }
        .activity-card:hover { transform: translateY(-10px); }
        .activity-icon { font-size: 40px; color: var(--accent); margin-bottom: 20px; }
        
        /* Gallery */
        .gallery-img { width: 100%; height: 250px; object-fit: cover; border-radius: 15px; transition: 0.4s; cursor: pointer; }
        .gallery-img:hover { transform: scale(1.03); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
        
        /* Info Box */
        .info-box {
            background: var(--primary); color: white; border-radius: 20px; padding: 40px;
            box-shadow: 0 20px 40px rgba(15,76,129,0.2);
        }
        .info-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; }
        .info-item i { font-size: 24px; color: var(--accent); margin-top: 3px; }
        
        /* Safety & FAQ */
        .accordion-button:not(.collapsed) { background-color: #f0f6ff; color: var(--primary); }
        
        /* Footer */
        footer { background: var(--dark); color: white; padding: 50px 0 20px; text-align: center; }
        .btn-whatsapp {
            display: inline-flex; align-items: center; gap: 10px; background: #25D366; color: white;
            padding: 12px 25px; border-radius: 30px; font-weight: 600; text-decoration: none; font-size: 1.1rem;
        }
        .btn-whatsapp:hover { background: #128C7E; color: white; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dampar fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-umbrella-beach me-2"></i>Dampar.</a>
            <div class="d-flex align-items-center gap-3 ms-auto">
                <a href="#booking" class="btn btn-dark rounded-pill px-4 d-none d-md-block t-book">Book Now</a>
                <div class="lang-toggle" onclick="toggleLanguage()" id="langBtn">ID <i class="fa-solid fa-globe ms-1"></i></div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero">
        <div class="container" data-aos="fade-up">
            <h1 class="t-hero-title">Discover The Black Sand Magic</h1>
            <p class="t-hero-sub">Experience the untouched beauty of Dampar Beach. Where dramatic cliffs meet the endless ocean in Lumajang, East Java.</p>
            <a href="#explore" class="btn-discover t-hero-btn">Explore Dampar</a>
        </div>
    </header>

    <!-- Intro -->
    <section id="explore">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title text-start t-intro-title">The Hidden Gem of Bades</h2>
                    <p class="lead t-intro-p1">Pantai Dampar menawarkan pesona unik dengan pasir hitam eksotis yang berkilau di bawah sinar matahari. Terletak di Desa Bades, pantai ini dikelilingi oleh tebing-tebing karang megah dan danau air tawar yang tenang.</p>
                    <p class="text-muted t-intro-p2">Berbeda dengan pantai selatan lainnya, Dampar memberikan perpaduan sempurna antara laut lepas dan muara sungai yang memungkinkan wisatawan untuk bersantai dengan aman.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1518098268026-4e89f1a2cd8e?auto=format&fit=crop&q=80" alt="Dampar Cliff" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Info Basics -->
    <section style="background: white;" id="booking">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-10" data-aos="zoom-in">
                    <div class="info-box">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h3 class="serif mb-4 t-info-title">Essential Information</h3>
                                <div class="info-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <div>
                                        <h5 class="t-info-hours">Operating Hours</h5>
                                        <p class="mb-0 opacity-75 t-info-hours-val">Everyday, 06:00 AM - 05:00 PM</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fa-solid fa-ticket"></i>
                                    <div>
                                        <h5 class="t-info-ticket">Ticket Price</h5>
                                        <p class="mb-0 opacity-75 t-info-ticket-val">Domestic: Rp 10.000 | Foreigners: Rp 25.000</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fa-solid fa-bed"></i>
                                    <div>
                                        <h5 class="t-info-stay">Accommodation</h5>
                                        <p class="mb-0 opacity-75 t-info-stay-val">Local homestays available starting from Rp 150.000/night.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="serif mb-4 t-info-loc">Location & Route</h3>
                                <p class="opacity-75 t-info-loc-desc">Located in Bades Village, Pasirian, Lumajang. Approximately 45 minutes drive from Lumajang city center. Accessible by car or motorcycle.</p>
                                <a href="https://maps.google.com" target="_blank" class="btn btn-outline-light rounded-pill mt-3 t-info-map"><i class="fa-solid fa-map-location-dot me-2"></i> Open in Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities -->
    <section>
        <div class="container">
            <h2 class="section-title t-act-title">Visitor Experience</h2>
            <p class="section-subtitle t-act-sub">Make the most out of your visit with these exciting activities at Dampar Beach.</p>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="activity-card">
                        <i class="fa-solid fa-camera activity-icon"></i>
                        <h4 class="fw-bold t-act1-title">Photography</h4>
                        <p class="text-muted t-act1-desc">Capture the stunning sunset against the dramatic cliffs and unique black sand.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="activity-card">
                        <i class="fa-solid fa-water activity-icon"></i>
                        <h4 class="fw-bold t-act2-title">Lake Canoeing</h4>
                        <p class="text-muted t-act2-desc">Rent a traditional boat and explore the calm freshwater lake right next to the beach.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="activity-card">
                        <i class="fa-solid fa-tent activity-icon"></i>
                        <h4 class="fw-bold t-act3-title">Camping</h4>
                        <p class="text-muted t-act3-desc">Set up your tent safely on the designated campsite and enjoy the starry night sky.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section style="background: white;">
        <div class="container">
            <h2 class="section-title t-gal-title">Breathtaking Views</h2>
            <div class="row g-3">
                <div class="col-md-6 col-lg-4"><img src="https://images.unsplash.com/photo-1520986606214-8b456906c813?auto=format&fit=crop&q=80" class="gallery-img"></div>
                <div class="col-md-6 col-lg-4"><img src="https://images.unsplash.com/photo-1544253303-34e8f192b0f2?auto=format&fit=crop&q=80" class="gallery-img"></div>
                <div class="col-md-6 col-lg-4"><img src="https://images.unsplash.com/photo-1621360841013-c76831f137e1?auto=format&fit=crop&q=80" class="gallery-img"></div>
            </div>
        </div>
    </section>

    <!-- FAQ & Safety -->
    <section>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title text-start t-safety-title"><i class="fa-solid fa-life-ring text-danger me-2"></i> Safety Guidelines</h2>
                    <div class="alert alert-warning border-0 shadow-sm mt-4">
                        <h5 class="fw-bold t-safe1-title">Swimming Restriction</h5>
                        <p class="mb-0 t-safe1-desc">Due to strong southern ocean currents, swimming in the open sea is strictly prohibited. You may safely play in the water at the river mouth/lake area.</p>
                    </div>
                    <div class="alert alert-info border-0 shadow-sm mt-3">
                        <h5 class="fw-bold t-safe2-title">Facilities Available</h5>
                        <p class="mb-0 t-safe2-desc">Public toilets, prayer rooms (Mushola), spacious parking, and local food stalls (Warung) serving fresh seafood.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="section-title text-start t-faq-title">Frequently Asked Questions</h2>
                    <div class="accordion mt-4" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded overflow-hidden">
                            <h2 class="accordion-header"><button class="accordion-button fw-bold t-faq1-q" type="button" data-bs-toggle="collapse" data-bs-target="#q1">Are pets allowed?</button></h2>
                            <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body t-faq1-a">Yes, you can bring your pets. Please make sure to clean up after them and keep them on a leash.</div></div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded overflow-hidden">
                            <h2 class="accordion-header"><button class="accordion-button fw-bold collapsed t-faq2-q" type="button" data-bs-toggle="collapse" data-bs-target="#q2">Is there any public transportation to get there?</button></h2>
                            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body t-faq2-a">Currently, there is no direct public transportation. We highly recommend renting a car or motorcycle from Lumajang city.</div></div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-2 rounded overflow-hidden">
                            <h2 class="accordion-header"><button class="accordion-button fw-bold collapsed t-faq3-q" type="button" data-bs-toggle="collapse" data-bs-target="#q3">Can I rent a tent there?</button></h2>
                            <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body t-faq3-a">Yes, some local operators provide tent rentals. However, during peak seasons, it is better to bring your own.</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Helpdesk / Footer -->
    <footer>
        <div class="container">
            <h2 class="serif mb-4 t-help-title">Need Assistance?</h2>
            <p class="mb-4 t-help-desc">Our English-speaking tourist helpdesk is ready to assist you via WhatsApp.</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn-whatsapp mb-5">
                <i class="fa-brands fa-whatsapp fa-lg"></i> <span class="t-help-btn">Contact Tourist Helpdesk</span>
            </a>
            
            <div class="border-top border-secondary pt-4 mt-4 text-center opacity-50 small">
                &copy; <?= date('Y') ?> Dampar Beach Tourism - Managed by Pokdarwis Desa Bades.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        // Multilingual Dictionary
        const dict = {
            'ID': {
                't-book': 'Pesan Tiket',
                't-hero-title': 'Keajaiban Pasir Hitam Dampar',
                't-hero-sub': 'Rasakan keindahan murni Pantai Dampar. Tempat bertemunya tebing megah dan lautan tanpa batas di Lumajang, Jawa Timur.',
                't-hero-btn': 'Jelajahi Dampar',
                't-intro-title': 'Permata Tersembunyi Desa Bades',
                't-intro-p1': 'Pantai Dampar menawarkan pesona unik dengan pasir hitam eksotis yang berkilau di bawah sinar matahari. Terletak di Desa Bades, pantai ini dikelilingi oleh tebing-tebing karang megah dan danau air tawar yang tenang.',
                't-intro-p2': 'Berbeda dengan pantai selatan lainnya, Dampar memberikan perpaduan sempurna antara laut lepas dan muara sungai (danau) yang memungkinkan wisatawan untuk bersantai dengan aman.',
                't-info-title': 'Informasi Penting',
                't-info-hours': 'Jam Operasional',
                't-info-hours-val': 'Setiap Hari, 06:00 - 17:00 WIB',
                't-info-ticket': 'Harga Tiket Masuk',
                't-info-ticket-val': 'Domestik: Rp 10.000 | Mancanegara: Rp 25.000',
                't-info-stay': 'Akomodasi',
                't-info-stay-val': 'Homestay warga tersedia mulai Rp 150.000/malam.',
                't-info-loc': 'Lokasi & Rute',
                't-info-loc-desc': 'Terletak di Desa Bades, Pasirian, Lumajang. Sekitar 45 menit berkendara dari pusat kota Lumajang. Dapat diakses dengan mobil atau motor.',
                't-info-map': 'Buka di Google Maps',
                't-act-title': 'Pengalaman Pengunjung',
                't-act-sub': 'Maksimalkan kunjungan Anda dengan aktivitas seru di Pantai Dampar.',
                't-act1-title': 'Fotografi',
                't-act1-desc': 'Abadikan matahari terbenam yang memukau dengan latar belakang tebing megah dan pasir hitam yang unik.',
                't-act2-title': 'Susur Danau',
                't-act2-desc': 'Sewa perahu tradisional dan jelajahi danau air tawar yang tenang tepat di sebelah pantai.',
                't-act3-title': 'Berkemah',
                't-act3-desc': 'Dirikan tenda Anda dengan aman di area perkemahan dan nikmati langit malam bertabur bintang.',
                't-gal-title': 'Pemandangan Memukau',
                't-safety-title': 'Panduan Keamanan',
                't-safe1-title': 'Larangan Berenang di Laut',
                't-safe1-desc': 'Karena arus laut selatan yang kuat, berenang di laut lepas dilarang keras. Anda bisa bermain air dengan aman di area danau/muara.',
                't-safe2-title': 'Fasilitas Tersedia',
                't-safe2-desc': 'Toilet umum, Mushola, area parkir luas, dan deretan warung kuliner lokal yang menyajikan hidangan laut segar.',
                't-faq-title': 'Pertanyaan Umum (FAQ)',
                't-faq1-q': 'Apakah boleh membawa hewan peliharaan?',
                't-faq1-a': 'Ya, Anda boleh membawa hewan peliharaan. Pastikan untuk membersihkan kotorannya dan menjaganya agar tidak mengganggu.',
                't-faq2-q': 'Apakah ada kendaraan umum ke sana?',
                't-faq2-a': 'Saat ini belum ada transportasi umum langsung. Kami sangat menyarankan untuk menyewa mobil atau motor dari pusat kota Lumajang.',
                't-faq3-q': 'Apakah bisa menyewa tenda di sana?',
                't-faq3-a': 'Ya, beberapa warga lokal menyediakan penyewaan tenda. Namun saat musim liburan, sebaiknya membawa tenda sendiri.',
                't-help-title': 'Butuh Bantuan?',
                't-help-desc': 'Layanan bantuan wisatawan kami siap membantu Anda melalui WhatsApp (Bisa Bahasa Inggris/Indonesia).',
                't-help-btn': 'Hubungi Helpdesk Wisata'
            },
            'EN': {
                't-book': 'Book Now',
                't-hero-title': 'Discover The Black Sand Magic',
                't-hero-sub': 'Experience the untouched beauty of Dampar Beach. Where dramatic cliffs meet the endless ocean in Lumajang, East Java.',
                't-hero-btn': 'Explore Dampar',
                't-intro-title': 'The Hidden Gem of Bades',
                't-intro-p1': 'Dampar Beach offers a unique charm with its exotic black sand that sparkles under the sun. Located in Bades Village, the beach is surrounded by majestic cliffs and a calm freshwater lake.',
                't-intro-p2': 'Unlike other southern beaches, Dampar provides a perfect blend of the open sea and a river mouth (lake), allowing tourists to relax safely in the water.',
                't-info-title': 'Essential Information',
                't-info-hours': 'Operating Hours',
                't-info-hours-val': 'Everyday, 06:00 AM - 05:00 PM',
                't-info-ticket': 'Ticket Price',
                't-info-ticket-val': 'Domestic: Rp 10.000 | Foreigners: Rp 25.000',
                't-info-stay': 'Accommodation',
                't-info-stay-val': 'Local homestays available starting from Rp 150.000/night.',
                't-info-loc': 'Location & Route',
                't-info-loc-desc': 'Located in Bades Village, Pasirian, Lumajang. Approximately 45 minutes drive from Lumajang city center. Accessible by car or motorcycle.',
                't-info-map': 'Open in Google Maps',
                't-act-title': 'Visitor Experience',
                't-act-sub': 'Make the most out of your visit with these exciting activities at Dampar Beach.',
                't-act1-title': 'Photography',
                't-act1-desc': 'Capture the stunning sunset against the dramatic cliffs and unique black sand.',
                't-act2-title': 'Lake Canoeing',
                't-act2-desc': 'Rent a traditional boat and explore the calm freshwater lake right next to the beach.',
                't-act3-title': 'Camping',
                't-act3-desc': 'Set up your tent safely on the designated campsite and enjoy the starry night sky.',
                't-gal-title': 'Breathtaking Views',
                't-safety-title': 'Safety Guidelines',
                't-safe1-title': 'Swimming Restriction',
                't-safe1-desc': 'Due to strong southern ocean currents, swimming in the open sea is strictly prohibited. You may safely play in the water at the river mouth/lake area.',
                't-safe2-title': 'Facilities Available',
                't-safe2-desc': 'Public toilets, prayer rooms (Mushola), spacious parking, and local food stalls (Warung) serving fresh seafood.',
                't-faq-title': 'Frequently Asked Questions',
                't-faq1-q': 'Are pets allowed?',
                't-faq1-a': 'Yes, you can bring your pets. Please make sure to clean up after them and keep them on a leash.',
                't-faq2-q': 'Is there any public transportation to get there?',
                't-faq2-a': 'Currently, there is no direct public transportation. We highly recommend renting a car or motorcycle from Lumajang city.',
                't-faq3-q': 'Can I rent a tent there?',
                't-faq3-a': 'Yes, some local operators provide tent rentals. However, during peak seasons, it is better to bring your own.',
                't-help-title': 'Need Assistance?',
                't-help-desc': 'Our English-speaking tourist helpdesk is ready to assist you via WhatsApp.',
                't-help-btn': 'Contact Tourist Helpdesk'
            }
        };

        let currentLang = 'EN';
        
        function toggleLanguage() {
            currentLang = currentLang === 'EN' ? 'ID' : 'EN';
            document.getElementById('langBtn').innerHTML = currentLang === 'EN' ? 'ID <i class="fa-solid fa-globe ms-1"></i>' : 'EN <i class="fa-solid fa-globe ms-1"></i>';
            
            // Translate all elements with class starting with 't-'
            for (let key in dict[currentLang]) {
                let els = document.getElementsByClassName(key);
                for (let i = 0; i < els.length; i++) {
                    els[i].innerHTML = dict[currentLang][key];
                }
            }
        }
    </script>
</body>
</html>
