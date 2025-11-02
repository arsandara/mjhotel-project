<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel Mukti Jaya</title>
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
        WELCOME SECTION - JARAK DIKURANGI
        ========================= */
        .welcome-section {
            background: #fff;
            padding: 40px 5% 20px; /* Top 40px, Bottom cuma 20px biar ga terlalu jauh */
            text-align: center;
        }

        .welcome-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--brand);
            margin-bottom: 12px;
        }

        .welcome-section p {
            font-size: 1.2rem;
            color: #6b7280;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        /* =========================
        ROOM SECTION - JARAK ANTAR KATEGORI DIPERBESAR
        ========================= */
        .rooms { 
            padding: 30px 5% 60px; /* Top 30px (dekat welcome), Bottom 60px */
            background: #fff; 
        }

        .section-title { 
            text-align: center; 
            font-size: 2.5rem; 
            font-weight: 700; 
            color: #1f2937; 
            margin-bottom: 40px;
            margin-top: 60px; /* JARAK ANTAR KATEGORI KAMAR DIPERBESAR */
        }

        /* Kategori pertama ga perlu margin top */
        .section-title:first-of-type {
            margin-top: 0;
        }

        .room-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .room-card {
            background: #fff; 
            border: 1px solid #e5e7eb; 
            border-radius: 12px; 
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(16, 24, 40, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex; 
            flex-direction: column;
        }

        .room-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 12px 24px rgba(16, 24, 40, 0.12); 
        }

        .room-card-link { 
            text-decoration: none; 
            color: inherit; 
            display: block; 
        }

        .room-card img { 
            width: 100%; 
            height: 240px; 
            object-fit: cover; 
            display: block; 
        }

        .room-info { 
            padding: 24px; 
        }

        .room-info h4 { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #111827; 
            margin: 0 0 12px; 
        }

        .meta { 
            display: flex; 
            align-items: center; 
            gap: 6px; 
            font-size: 14px; 
            color: #6b7280; 
            margin-bottom: 16px; 
        }

        .icon-people { 
            width: 18px; 
            height: 18px; 
            flex: 0 0 18px;
            stroke: #065238;
        }

        .room-info strong { 
            font-size: 1.25rem; 
            font-weight: 800; 
            color: var(--brand); 
        }

        .room-info .per-night { 
            margin-left: 4px; 
            font-size: 13px; 
            color: #9ca3af; 
            font-weight: 500; 
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
            .room-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
            
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

            .welcome-section {
                padding: 35px 5% 18px;
            }

            .welcome-section h2 {
                font-size: 2.2rem;
                margin-bottom: 10px;
            }
            
            .welcome-section p {
                font-size: 1.1rem;
            }

            .rooms {
                padding: 25px 5% 50px;
            }
            
            .section-title {
                margin-bottom: 35px;
                margin-top: 50px;
            }

            .section-title:first-of-type {
                margin-top: 0;
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
            .room-grid { 
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .room-card img { 
                height: 200px; 
            }
            
            .section-title { 
                font-size: 2rem; 
                margin-bottom: 30px;
                margin-top: 45px;
            }

            .section-title:first-of-type {
                margin-top: 0;
            }

            .welcome-section {
                padding: 30px 5% 15px;
            }
            
            .welcome-section h2 {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }
            
            .welcome-section p {
                font-size: 1rem;
                line-height: 1.6;
            }

            .rooms {
                padding: 20px 5% 40px;
            }
            
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

            .welcome-section {
                padding: 25px 5% 12px;
            }

            .welcome-section h2 {
                font-size: 1.6rem;
                margin-bottom: 8px;
            }
            
            .welcome-section p {
                font-size: 0.9rem;
                line-height: 1.5;
            }
            
            .section-title {
                font-size: 1.75rem;
                margin-bottom: 25px;
                margin-top: 40px;
            }

            .section-title:first-of-type {
                margin-top: 0;
            }
            
            .rooms {
                padding: 18px 5% 35px;
            }
        }

        @media (max-width: 360px) {
            .hero-image {
                flex: 0 0 35%;
            }
            
            .hero-content h1 {
                font-size: 1.6rem;
            }

            .welcome-section {
                padding: 20px 5% 10px;
            }

            .welcome-section h2 {
                font-size: 1.4rem;
            }

            .section-title {
                margin-top: 35px;
            }

            .section-title:first-of-type {
                margin-top: 0;
            }
        }
    </style>
    </head>
    <body>
    <!-- Navbar (DIKECILKAN) -->
    <header class="navbar">
        <div class="logo-area">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Hotel" class="logo" />
        </div>

        <!-- Tombol hamburger -->
        <button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false">
            <span class="sr-only">Buka menu</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                <path d="M3 6h18M3 12h18M3 18h18" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <nav class="nav-menu" id="primary-nav">
            <a href="{{ url('/') }}" class="active">Home</a>
            <a href="{{ url('/reservation') }}">Reservasi</a>
            <a href="{{ url('/about') }}">Tentang</a>
        </nav>
    </header>
    

    <!-- Hero Section (DIKECILKAN & DISEDERHANAKAN) -->
    <section class="hero">
        <div class="hero-image">
            <img src="{{ asset('images/ataslanding.png') }}" alt="Hotel Mukti Jaya" />
        </div>
        <div class="hero-content">
            <h1>Hotel <span>Mukti Jaya</span></h1>
            <p>
                Tempat menginap nyaman dengan pelayanan ramah dan fasilitas lengkap
                untuk istirahat terbaik Anda.
            </p>
            <a href="{{ url('/reservation') }}" class="btn">Pesan Kamar Sekarang</a>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="welcome-container">
            <h2>Pilihan Kamar Kami</h2>
            <p>Berbagai tipe kamar dengan fasilitas terbaik untuk kenyamanan Anda</p>
        </div>
    </section>

    <!-- Room Section -->
    <main class="rooms">
        @php
            $groupedRooms = [
                'Suite' => $rooms->filter(fn($r) => stripos($r->room_type, 'suite') !== false),
                'Deluxe' => $rooms->filter(fn($r) => stripos($r->room_type, 'deluxe') !== false),
                'Superior' => $rooms->filter(fn($r) => stripos($r->room_type, 'superior') !== false),
                'Standard' => $rooms->filter(fn($r) => stripos($r->room_type, 'standard') !== false),
            ];
        @endphp

        @foreach($groupedRooms as $category => $categoryRooms)
            @if($categoryRooms->count() > 0)
            <h2 class="section-title">{{ $category }} Room</h2>
            <div class="room-grid">
                @foreach($categoryRooms as $room)
                <a href="{{ url('/rooms/' . $room->room_id) }}" class="room-card-link">
                    <div class="room-card">
                        @if($room->images->count() > 1)
                            <img src="{{ asset('images/rooms/' . $room->images[1]->image_path) }}" alt="{{ $room->room_name }}" />
                        @elseif($room->images->count() > 0)
                            <img src="{{ asset('images/rooms/' . $room->images->first()->image_path) }}" alt="{{ $room->room_name }}" />
                        @else
                            <img src="{{ asset('images/rooms/default-room.jpg') }}" alt="{{ $room->room_name }}" />
                        @endif
                        <div class="room-info">
                            <h4>{{ $room->room_name }}</h4>
                            <p class="meta">
                                <svg class="icon-people" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                {{ $room->room_capacity }} Orang
                            </p>
                            <strong>Rp {{ number_format($room->room_price, 0, ',', '.') }}</strong><span class="per-night">/malam</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        @endforeach
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

    <div class="footer-bottom">
        © 2025 Copyright Hotel Mukti Jaya, All right reserved.
    </div>

    <!-- JS -->
    <script>
        const toggle = document.querySelector(".nav-toggle");
        const menu = document.getElementById("primary-nav");
        const navbar = document.querySelector(".navbar");

        toggle.addEventListener("click", () => {
            const isOpen = menu.classList.toggle("open");
            toggle.setAttribute("aria-expanded", String(isOpen));
            document.documentElement.classList.toggle("nav-open", isOpen);
        });

        window.addEventListener("scroll", () => {
            navbar.classList.toggle("has-shadow", window.scrollY > 4);
        });
    </script>
</body>
</html>