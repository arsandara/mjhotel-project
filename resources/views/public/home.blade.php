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
          --nav-h: 60px; /* DIKECILKAN */
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
           NAVBAR (DIKECILKAN)
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
            padding: 8px 5%; /* DIKECILKAN */
            transition: box-shadow 0.3s ease;
            height: var(--nav-h);
        }
        .navbar.has-shadow { box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); }
        .logo { 
            height: 40px; /* DIKECILKAN */
        }

        .nav-menu a {
          color: #fff; 
          text-decoration: none; 
          margin-left: 20px; /* DIKECILKAN */
          padding: 6px 14px; /* DIKECILKAN */
          border-radius: 6px; 
          font-weight: 500;
          font-size: 0.95rem; /* DIKECILKAN */
          transition: background 0.25s ease;
        }
        .nav-menu a:hover { background: rgba(255, 255, 255, 0.2); }
        .nav-menu .active { background: #fff; color: var(--brand); font-weight: 600; }

        .nav-toggle{ 
            display:none; 
            background:transparent; 
            border:0; 
            color:#fff; 
            padding:6px; /* DIKECILKAN */
            cursor:pointer; 
        }

        /* =========================
        HERO
        ========================= */
        .hero {
        display: flex; 
        align-items: center; 
        justify-content: center;
        background: var(--bg-soft);
        flex-wrap: nowrap;
        padding: 0;
        height: 450px;
        overflow: hidden;
        }

        .hero-image {
        flex: 0 0 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        }

        .hero-content {
        flex: 1;
        padding: 40px 80px 40px 60px;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        text-align: left;
        }

        .hero-content h1 {
        font-size: 3rem; 
        font-weight: 700; 
        color: #000; 
        margin-bottom: 14px; 
        line-height: 1.2;
        }

        .hero-content h1 span {
        color: var(--brand);
        }

        .hero-content p {
        color: #333; 
        margin-bottom: 24px; 
        line-height: 1.6; 
        font-size: 1rem;
        }

        .btn {
        display: inline-block; 
        background: var(--brand); 
        color: #fff; 
        padding: 12px 28px;
        text-decoration: none; 
        font-weight: 600; 
        border-radius: var(--radius);
        transition: background 0.25s ease, transform 0.2s ease;
        }

        .btn:hover { 
        background: var(--brand-dark); 
        transform: translateY(-1px); 
        }

        /* =========================
        WELCOME SECTION (CSS YANG HILANG DITAMBAHKAN)
        ========================= */
        .welcome-section {
          background: #fff;
          padding: 60px 5%;
          text-align: center;
        }

        .welcome-container {
          max-width: 1200px;
          margin: 0 auto;
        }

        .welcome-section h2 {
          font-size: 2.5rem;
          font-weight: 700;
          color: var(--brand);
          margin-bottom: 20px;
        }

        .welcome-section p {
          font-size: 1.2rem;
          color: #6b7280;
          line-height: 1.8;
          max-width: 700px;
          margin: 0 auto;
        }

        /* =========================
        ROOM SECTION (card)
        ========================= */
        .rooms { 
          padding: 60px 5%; 
          background: #fff; 
        }

        .section-title { 
          text-align: center; 
          font-size: 32px; 
          font-weight: 700; 
          color: #1f2937; 
          margin-bottom: 50px;
        }

        .room-grid {
          display: grid;
          grid-template-columns: repeat(2, 1fr);
          gap: 30px;
          max-width: 1200px;
          margin: 0 auto 60px auto;
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
          padding: 20px; 
        }

        .room-info h4 { 
          font-size: 18px; 
          font-weight: 700; 
          color: #111827; 
          margin: 0 0 10px; 
        }

        .meta { 
          display: flex; 
          align-items: center; 
          gap: 6px; 
          font-size: 14px; 
          color: #6b7280; 
          margin-bottom: 12px; 
        }

        .icon-people { 
          width: 18px; 
          height: 18px; 
          flex: 0 0 18px;
          stroke: #065238;
        }

        .room-info strong { 
          font-size: 20px; 
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
        FOOTER (FULL-WIDTH & rapi)
        ========================= */
        .footer{
          width:100%;
          background: var(--brand);
          color:#fff;
          padding: 48px 5%;
          display:grid;
          grid-template-columns: 260px 1fr;
          align-items:start;
          gap: 36px;
        }
        .footer-left{ 
          display:flex; 
          flex-direction:column; 
          align-items:center; 
        }
        .footer-logo{ 
          width:220px; 
          height:auto; 
          margin-bottom:12px; 
        }

        .footer-right{
          border-left:1px solid rgba(255,255,255,.25);
          padding-left:32px;
        }
        .footer-right h3{ 
          font-size:1.4rem; 
          margin-bottom:16px; 
          font-weight:700; 
        }

        /* kolom isi: grid auto-fit 3 kolom */
        .footer-columns{
          display:grid;
          grid-template-columns: repeat(3, minmax(220px, 1fr));
          gap:20px 28px;
        }
        .footer-col{
          text-align:justify;
          line-height:1.7;
          font-size:.95rem;
          color:#e5e5e5;
        }

        /* strip bawah tetap full */
        .footer-bottom{
          width:100%;
          text-align:center;
          font-size:.85rem;
          padding:14px;
          background:#044f32;
          color:#dcdcdc;
          border-top:1px solid #0d6841;
        }

        /* =========================
        RESPONSIVE
        ========================= */
        @media (max-width: 1024px) {
          .room-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
          }
          
          .hero {
            padding: 30px 5%;
            min-height: 350px;
          }
          .hero-image {
            max-width: 450px;
          }
          .hero-content {
            padding: 0 30px;
          }
          .hero-content h1 {
            font-size: 2rem;
          }

          .welcome-section h2 {
            font-size: 2.2rem;
          }
          .welcome-section p {
            font-size: 1.1rem;
          }
          
          .footer{ 
            grid-template-columns: 220px 1fr; 
            gap:28px; 
            padding: 40px clamp(16px, 5vw, 24px); 
          }
          .footer-right{ 
            padding-left:24px; 
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
            font-size: 24px; 
            margin-bottom: 30px; 
          }
          
          :root{ 
            --nav-h: 54px; /* DIKECILKAN */
          }
          body{ 
            padding-top: var(--nav-h); 
          }
          .nav-toggle{ 
            display:inline-flex; 
            margin-left:auto; 
          }
          .navbar{ 
            padding: 6px 16px; /* DIKECILKAN */
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
            padding: 10px 16px; /* DIKECILKAN */
            border-bottom: 1px solid rgba(255,255,255,.08);
            margin-left: 0; 
            border-radius: 0;
            font-size: 0.9rem; /* DIKECILKAN */
          }
          .nav-menu.open{ 
            max-height: 70vh; 
          }
          html.nav-open, html.nav-open body{ 
            overflow: hidden; 
          }

          .hero {
            height: auto;
            flex-wrap: nowrap;
            align-items: center;
            padding: 0;
        }
        
        .hero-image {
            flex: 0 0 55%;
            height: auto;
        }
        
        .hero-image img {
            max-width: 55vw;
            height: auto;
            object-fit: cover;
            border-radius: var(--radius);
        }
        
        .hero-content {
            flex: 1;
            min-width: 0;
            width: 45%;
            padding: 16px;
        }
        
        .hero-content h1 {
            font-size: clamp(22px, 7vw, 32px);
            line-height: 1.15;
        }
        
        .hero-content p {
            font-size: clamp(12px, 3.5vw, 14px);
        }
        
        .btn {
            padding: 10px 16px;
            font-size: clamp(12px, 3.6vw, 14px);
            border-radius: 10px;
        }

          .welcome-section {
            padding: 40px 5%;
          }
          .welcome-section h2 {
            font-size: 1.8rem;
          }
          .welcome-section p {
            font-size: 1rem;
          }

          .footer{ 
            grid-template-columns: 1fr; 
            text-align:center; 
            gap:20px; 
            padding:36px 16px; 
          }
          .footer-right{ 
            border:0; 
            padding-left:0; 
          }
          .footer-columns{ 
            grid-template-columns: 1fr; 
            gap:14px; 
          }
          .footer-col{ 
            text-align:left; 
          }
          .footer-left{ 
            align-items:center; 
          }
          .footer-logo{ 
            width:180px; 
          }
        }

        @media (max-width: 480px) {
          .hero-content h1 {
            font-size: 1.8rem;
          }
          .hero-content p {
            font-size: 0.9rem;
          }
          .welcome-section h2 {
            font-size: 1.5rem;
          }
          .welcome-section p {
            font-size: 0.9rem;
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
                        @if($room->images->count() > 0)
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