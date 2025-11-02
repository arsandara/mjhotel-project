<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        /* =========================
           Reset, Font & Variables
        ========================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
          --brand: #0E4C2F;
          --brand-dark: #08341F;
          --bg: #f1f5f9;
          --bg-soft: #D9E8EF;
          --text: #111827;
          --radius: 10px;
          --shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
          --nav-h: 60px;
        }
        html, body { height: 100%; }
        body {
          font-family: "Geist", sans-serif;
          color: var(--text);
          background: var(--bg);
          padding-top: var(--nav-h);
          line-height: 1.5;
        }

        .sr-only{
          position:absolute; width:1px; height:1px; padding:0; margin:-1px;
          overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0;
        }

        /* =========================
           NAVBAR
        ========================= */
        .navbar {
            position: fixed; 
            top: 0; 
            left: 0; 
            right: 0; 
            z-index: 9999;
            background: var(--brand);
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 8px 5%;
            transition: box-shadow 0.3s ease;
            height: var(--nav-h);
        }
        .navbar.has-shadow { box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); }
        .logo { 
            height: 40px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .nav-menu a {
          color: #fff; 
          text-decoration: none; 
          margin-left: 20px;
          padding: 6px 14px;
          border-radius: 6px; 
          font-weight: 500;
          font-size: 0.95rem;
          transition: background 0.25s ease;
        }
        .nav-menu a:hover { background: rgba(255, 255, 255, 0.2); }
        .nav-menu .active { background: #fff; color: var(--brand); font-weight: 600; }

        .nav-toggle{ 
            display:none; 
            background:transparent; 
            border:0; 
            color:#fff; 
            padding:6px;
            cursor:pointer; 
        }

        /* =========================
           HERO SECTION
        ========================= */
        .hero {
            display: flex; 
            align-items: stretch;
            background: var(--bg-soft);
            height: 500px;
            overflow: hidden;
        }

        .hero-image {
            flex: 0 0 55%;
            position: relative;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 25%;
        }

        .hero-content {
            flex: 0 0 45%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .hero-content h1 {
            font-size: 3rem; 
            font-weight: 700; 
            color: #000; 
            margin-bottom: 16px; 
            line-height: 1.1;
        }

        .hero-content h1 span {
            color: var(--brand);
        }

        .hero-content p {
            color: #333; 
            margin-bottom: 32px; 
            line-height: 1.6; 
            font-size: 1.1rem;
            max-width: 500px;
        }

        .btn {
            display: inline-block; 
            background: var(--brand); 
            color: #fff; 
            padding: 14px 32px;
            text-decoration: none; 
            font-weight: 600; 
            border-radius: var(--radius);
            transition: background 0.25s ease, transform 0.2s ease;
            font-size: 1rem;
        }

        .btn:hover { 
            background: var(--brand-dark); 
            transform: translateY(-2px); 
        }

        /* =========================
           MAIN CONTENT - TENTANG
        ========================= */
        main {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .about-section {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 40px;
            margin-bottom: 50px;
        }

        .about-section p {
            margin-bottom: 20px;
            text-align: justify;
            color: #111827;
            line-height: 1.7;
        }

        .about-section .first-line {
            font-size: 1.1rem;
        }

        .about-section .first-line b {
            font-size: 1.4rem;
            font-weight: 800;
            color: #000;
        }

        /* =========================
        FACILITIES SECTION
        ========================= */
        .facilities-section {
            margin-bottom: 50px;
        }

        .section-title {
            text-align: left;
            font-size: 1.4rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .left-large {
            grid-row: span 2;
            height: calc(280px * 2 + 20px);
        }

        .right-small {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 280px 280px;
            gap: 20px;
            height: calc(280px * 2 + 20px);
        }

        .facility-item {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: var(--shadow);
            background: #fff;
            height: 100%;
        }

        .facility-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .facility-item figcaption {
            position: absolute;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-align: center;
            text-shadow: 0 2px 0 rgba(0, 0, 0, 0.6), 0 0 6px rgba(0, 0, 0, 0.35),
            0 0 14px rgba(0, 0, 0, 0.25);
            padding: 2px 8px;
            border-radius: 8px;
            white-space: nowrap;
        }

        /* Responsive untuk facilities */
        @media (max-width: 768px) {
            .facilities-grid {
                grid-template-columns: 1fr;
            }
            .left-large,
            .right-small {
                height: auto;
            }
            .right-small {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
            }
            .facility-item {
                height: 260px;
            }
        }

        @media (max-width: 600px) {
            .right-small {
                grid-template-columns: 1fr;
            }
            .facility-item {
                height: 240px;
            }
        }

        /* =========================
           LOCATION SECTION
        ========================= */
        .location-section {
            margin-bottom: 50px;
        }

        .map-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: 0;
            display: block;
        }

        .location-info {
            padding: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .location-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }

        .location-info p {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        /* =========================
           FOOTER
        ========================= */
        .footer{
            width:100%;
            background: var(--brand);
            color:#fff;
            padding: 60px 5%;
            display:grid;
            grid-template-columns: 260px 1fr;
            align-items:start;
            gap: 40px;
        }
        .footer-left{ 
            display:flex; 
            flex-direction:column; 
            align-items:center; 
        }
        .footer-logo{ 
            width:220px; 
            height:auto; 
            margin-bottom:16px; 
        }

        .footer-right{
            border-left:1px solid rgba(255,255,255,.25);
            padding-left:40px;
        }
        .footer-right h3{ 
            font-size:1.5rem; 
            margin-bottom:20px; 
            font-weight:700; 
        }

        .footer-columns{
            display:grid;
            grid-template-columns: repeat(3, minmax(220px, 1fr));
            gap:24px 32px;
        }
        .footer-col{
            text-align:justify;
            line-height:1.7;
            font-size:1rem;
            color:#e5e5e5;
        }

        .footer-bottom{
            width:100%;
            text-align:center;
            font-size:.85rem;
            padding:16px;
            background:#044f32;
            color:#dcdcdc;
            border-top:1px solid #0d6841;
        }

        /* =========================
           RESPONSIVE DESIGN
        ========================= */
        @media (max-width: 1200px) {
            .hero-content {
                padding: 40px;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 1024px) {
            .hero {
                height: 450px;
            }
            
            .hero-content {
                padding: 40px 30px;
            }
            
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .hero-content p {
                font-size: 1rem;
            }

            .about-section {
                padding: 30px;
            }

            .footer{ 
                grid-template-columns: 220px 1fr; 
                gap:32px; 
                padding: 50px 5%; 
            }
            
            .footer-right{ 
                padding-left:32px; 
            }
            
            .footer-logo{ 
                width:200px; 
            }
            
            .footer-columns{ 
                grid-template-columns: repeat(2, 1fr); 
            }
        }

        @media (max-width: 768px) {
            /* Navigation Mobile */
            :root{ 
                --nav-h: 54px;
            }
            
            body{ 
                padding-top: var(--nav-h); 
            }
            
            .nav-toggle{ 
                display: inline-flex; 
                margin-left: auto; 
            }
            
            .navbar{ 
                padding: 6px 16px;
            }
            
            .nav-menu{
                position: fixed; 
                top: var(--nav-h); 
                left: 0; 
                right: 0;
                background: var(--brand);
                display: flex; 
                flex-direction: column; 
                gap: 0;
                max-height: 0; 
                overflow: hidden;
                transition: max-height .3s ease;
                border-top: 1px solid rgba(255,255,255,.15);
            }
            
            .nav-menu a{
                color: #fff; 
                text-decoration: none;
                padding: 12px 16px;
                border-bottom: 1px solid rgba(255,255,255,.08);
                margin-left: 0; 
                border-radius: 0;
                font-size: 0.95rem;
            }
            
            .nav-menu.open{ 
                max-height: 70vh; 
            }
            
            html.nav-open, html.nav-open body{ 
                overflow: hidden; 
            }

            /* Hero Mobile */
            .hero {
                height: auto;
                min-height: 400px;
                flex-direction: column;
            }
            
            .hero-image {
                flex: 0 0 45%;
                width: 100%;
            }
            
            .hero-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            .hero-content {
                flex: 1;
                width: 100%;
                padding: 40px 20px;
                text-align: center;
                align-items: center;
            }
            
            .hero-content h1 {
                font-size: 2rem;
                text-align: center;
            }
            
            .hero-content p {
                text-align: center;
                font-size: 1rem;
            }

            /* Main Content Mobile */
            main {
                margin: 40px auto;
                padding: 0 15px;
            }

            .about-section {
                padding: 25px;
            }

            .section-title {
                font-size: 2rem;
                margin-bottom: 30px;
            }

            .facilities-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .footer{ 
                grid-template-columns: 1fr; 
                text-align:center; 
                gap:30px; 
                padding:40px 5%; 
            }
            
            .footer-right{ 
                border:0; 
                padding-left:0; 
            }
            
            .footer-columns{ 
                grid-template-columns: 1fr; 
                gap:20px; 
            }
            
            .footer-col{ 
                text-align:center; 
            }
            
            .footer-left{ 
                align-items:center; 
            }
            
            .footer-logo{ 
                width:180px; 
            }
        }

        @media (max-width: 480px) {
            .hero {
                min-height: 350px;
            }
            
            .hero-image {
                flex: 0 0 40%;
            }
            
            .hero-content {
                padding: 30px 15px;
            }
            
            .hero-content h1 {
                font-size: 1.8rem;
                margin-bottom: 12px;
            }
            
            .hero-content p {
                font-size: 0.9rem;
                margin-bottom: 24px;
            }
            
            .btn {
                padding: 12px 24px;
                font-size: 0.9rem;
            }

            .about-section {
                padding: 20px;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .location-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <img src="{{ asset('images/logo.png') }}" alt="Hotel Mukti Jaya" class="logo" />
        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
            ☰
        </button>
        <div class="nav-menu" id="navMenu">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/reservasi') }}">Reservasi</a>
            <a href="{{ url('/tentang') }}" class="active">Tentang</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-image">
            <img src="{{ asset('images/ataslanding.png') }}" alt="Hotel Mukti Jaya" />
        </div>
        <div class="hero-content">
            <h1>Tentang <span>Kami</span></h1>
            <p>Mengenal lebih dekat Hotel Mukti Jaya - akomodasi nyaman dengan pelayanan terbaik di Purwokerto.</p>
            <a href="{{ url('/reservasi') }}" class="btn">Pesan Kamar Sekarang</a>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        <!-- About Section -->
        <section class="about-section">
            <p class="first-line">
                <b>Hotel Mukti Jaya</b> merupakan hotel rekomendasi untuk Anda,
                seorang backpacker yang tak hanya mengutamakan bujet, tapi juga
                kenyamanan saat beristirahat setelah menempuh petualangan seharian
                penuh.
            </p>
            <p>
                Bagi Anda yang menginginkan kualitas pelayanan oke dengan harga yang
                ramah di kantong, Hotel Mukti Jaya adalah pilihan yang tepat. Karena
                meski murah, akomodasi ini menyediakan fasilitas memadai dan pelayanan
                yang tetap terjaga mutunya. Hotel Mukti Jaya memiliki segala fasilitas
                penunjang bisnis untuk Anda dan kolega.
            </p>
            <p>
                Hotel Mukti Jaya adalah tempat bermalam yang tepat bagi Anda yang
                berlibur bersama keluarga. Nikmati segala fasilitas hiburan untuk Anda
                dan keluarga.
            </p>
            <p>
                Jika Anda berniat menginap dalam jangka waktu yang lama, Hotel Mukti
                Jaya adalah pilihan tepat. Berbagai fasilitas yang tersedia dan
                kualitas pelayanan yang baik akan membuat Anda merasa sedang berada di
                rumah sendiri.
            </p>
            <p>
                Menikmati perjalanan sendiri adalah hal yang menyenangkan. Untuk
                menginap, Hotel Mukti Jaya adalah pilihan pas bagi Anda yang
                membutuhkan waktu sendiri setelah puas berkeliling kota.
            </p>
            <p>
                Hotel Mukti Jaya adalah pilihan tepat bagi Anda yang ingin menginap di
                kota Purwokerto Selatan dengan harga yang terjangkau.
            </p>
            <p>
                Resepsionis siap 24 jam untuk melayani proses check-in, check-out dan
                kebutuhan Anda yang lain. Jangan ragu untuk menghubungi resepsionis,
                kami siap melayani Anda.
            </p>
            <p>
                Terdapat restoran yang menyajikan menu lezat ala Hotel Mukti Jaya
                khusus untuk Anda.
            </p>
            <p>
                WiFi tersedia di seluruh area publik properti untuk membantu Anda
                tetap terhubung dengan keluarga dan teman.
            </p>
            <p>
                Hotel Mukti Jaya adalah pilihan tepat bagi Anda yang mengutamakan
                kenyamanan beristirahat tanpa menguras kantong.
            </p>
        </section>

       <!-- Facilities Section -->
        <section class="facilities-section">
            <h2 class="section-title">Servis & Fasilitas</h2>
            <div class="facilities-grid">
                @if(isset($facilities) && count($facilities) > 0)
                    <!-- Gambar pertama (besar di kiri) -->
                    <div class="left-large">
                        <figure class="facility-item">
                            <img src="{{ url('images/' . $facilities[0]->facility_image) }}" 
                                alt="{{ $facilities[0]->facility_name }}"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/600x580/0E4C2F/FFFFFF?text={{ urlencode($facilities[0]->facility_name) }}';" />
                            <figcaption>{{ $facilities[0]->facility_name }}</figcaption>
                        </figure>
                    </div>
                    
                    <!-- 4 gambar kecil di kanan (grid 2x2) -->
                    <div class="right-small">
                        @for($i = 1; $i < min(5, count($facilities)); $i++)
                        <figure class="facility-item">
                            <img src="{{ url('images/' . $facilities[$i]->facility_image) }}" 
                                alt="{{ $facilities[$i]->facility_name }}"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/300x280/0E4C2F/FFFFFF?text={{ urlencode($facilities[$i]->facility_name) }}';" />
                            <figcaption>{{ $facilities[$i]->facility_name }}</figcaption>
                        </figure>
                        @endfor
                    </div>
                @else
                    <p>Data fasilitas sedang tidak tersedia.</p>
                @endif
            </div>
        </section>

        <!-- Location Section -->
        <section class="location-section">
            <h2 class="section-title">Lokasi Kami</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.034873767071!2d109.25438!3d-7.43573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea9dcfdf7d1%3A0x2291b1f94044e531!2sHotel%20Mukti%20Jaya!5e0!3m2!1sid!2sid!4v1730080000000"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="location-info">
                    <h3>Hotel Mukti Jaya</h3>
                    <p><strong>Alamat:</strong></p>
                    <p>Jl. Gerilya No.118, Windusara, Karangklesem,</p>
                    <p>Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53144</p>
                    <p><strong>Telepon:</strong> (021) 123-4567</p>
                    <p><strong>Email:</strong> info@hotelmuktijaya.com</p>
                </div>
            </div>
        </section>
    </main>

     <!-- Footer -->
    <footer class="footer">
        <div class="footer-left">
            <img src="{{ asset('images/logo.png') }}" alt="Hotel Mukti Jaya" class="footer-logo" />
        </div>
        <div class="footer-right">
            <h3>Hotel Mukti Jaya</h3>
            <div class="footer-columns">
                <div class="footer-col">
                    <p>
                        Berlokasi di jantung Kota Purwokerto, Hotel Mukti Jaya
                        menghadirkan suasana menginap yang nyaman, bersih, dan aman dengan
                        harga terjangkau. Kami berkomitmen memberikan pelayanan ramah dan
                        fasilitas modern untuk pengalaman menginap yang menyenangkan.
                    </p>
                </div>
                <div class="footer-col">
                    <p>
                        Tersedia berbagai tipe kamar, mulai dari Standard hingga Suite,
                        lengkap dengan Wi-Fi, TV LED, AC, air panas, dan layanan kamar 24
                        jam. Semua dirancang untuk kenyamanan dan kepuasan tamu.
                    </p>
                </div>
                <div class="footer-col">
                    <p>
                        Dengan lokasi strategis dekat stasiun, terminal, dan pusat kota,
                        Hotel Mukti Jaya menjadi pilihan tepat bagi wisatawan maupun
                        pebisnis yang mencari penginapan nyaman dan hangat di Purwokerto.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');
        const body = document.body;

        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('open');
            body.classList.toggle('nav-open');
        });

        // Navbar Shadow on Scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('has-shadow');
            } else {
                navbar.classList.remove('has-shadow');
            }
        });

        // Close mobile menu when clicking on links
        const navLinks = document.querySelectorAll('.nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('open');
                body.classList.remove('nav-open');
            });
        });
    </script>
</body>
</html>