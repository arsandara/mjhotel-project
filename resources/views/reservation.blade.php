<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reservasi | Hotel Mukti Jaya</title>
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
        --ctrl-h: 44px;
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
            min-height: 600px;        /* hero fleksibel */
            overflow: hidden;
        }

        .hero-image {
            flex: 1;
            height: 100%;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;        /* gambar selalu penuh */
            object-position: center; 
            display: block;           /* hilangkan gap bawah */
        }

        .hero-content {
            flex: 1; 
            padding: 20px 0; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: flex-start; 
            max-width: 600px;
        }

        .hero-content h1 {
            font-size: 2.8rem; 
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
            margin-bottom: 28px; 
            line-height: 1.6; 
            font-size: 1.05rem;
            max-width: 500px;
        }

        .btn {
            display: inline-block; 
            background: var(--brand); 
            color: #fff; 
            padding: 14px 32px;
            text-decoration: none; 
            font-weight: 700; 
            border-radius: var(--radius);
            transition: transform 0.2s ease, background 0.25s ease;
            font-size: 1rem;
        }

        .btn:hover { 
            background: var(--brand-dark); 
            transform: translateY(-2px); 
        }

        .btn:focus-visible { 
            outline: 3px solid #fff; 
            outline-offset: 2px; 
        }

        /* =========================
        SEARCH SECTION
        ========================= */
        .search-section {
            background: #fff;
            padding: 40px 5%;
        }

        .search-wrap {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr) 180px;
            column-gap: 20px;
            row-gap: 12px;
            align-items: end;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .input {
            display: flex;
            align-items: center;
            height: var(--ctrl-h);
            padding: 0 16px;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: var(--radius);
            transition: all 0.2s;
        }

        .input:focus-within {
            background: #fff;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(14, 76, 47, 0.1);
        }

        .input input,
        .input select {
            border: 0;
            outline: 0;
            width: 100%;
            background: transparent;
            color: #111827;
            font-size: 14px;
            font-weight: 500;
        }

        .input select {
            cursor: pointer;
        }

        .btn-check {
            height: var(--ctrl-h);
            background: var(--brand);
            color: #fff;
            border: 0;
            padding: 0 24px;
            font-weight: 700;
            cursor: pointer;
            border-radius: var(--radius);
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-check:hover {
            background: var(--brand-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 76, 47, 0.3);
        }

        /* =========================
        FILTER SECTION
        ========================= */
        .filter-section {
            background: #fff;
            padding: 0 5% 20px;
        }

        .filter-wrap {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .chip {
            border: 1px solid var(--brand);
            background: #fff;
            color: #0f172a;
            padding: 10px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: var(--radius);
            transition: all 0.2s ease;
        }

        .chip:hover {
            background: #f8fafc;
        }

        .chip.active {
            background: var(--brand);
            color: #fff;
            font-weight: 600;
        }

        /* =========================
        RESULT INFO
        ========================= */
        .result-section {
            background: #fff;
            padding: 20px 5% 40px;
        }

        .result-info {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .result-info h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text);
        }

        .badge {
            font-size: 14px;
            color: var(--brand);
            background: #f0fdf4;
            border: 1px solid var(--brand);
            padding: 10px 16px;
            border-radius: var(--radius);
            font-weight: 600;
        }

        /* =========================
        ROOMS SECTION (NEW LAYOUT)
        ========================= */
        .rooms-section { 
            padding: 0 5% 60px;
            background: #fff; 
        }

        .rooms-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .room-card {
            background: #fff; 
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .room-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 12px 24px rgba(16, 24, 40, 0.12); 
        }

        .room-image {
            width: 100%;
            height: 260px;
        }

        .room-image img { 
            width: 100%; 
            height: 100%;
            object-fit: cover; 
            display: block; 
        }

        .room-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px;
            background: #fff;
        }

        .room-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .room-info h3 { 
            font-size: 22px; 
            font-weight: 800; 
            color: #111827; 
            margin: 0;
        }

        .meta { 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-size: 14px; 
            color: #475569; 
            margin: 0;
        }

        .icon-people { 
            width: 22px; 
            height: 22px; 
            display: inline-block;
            flex: 0 0 22px;
            stroke: #065238;
        }

        .room-price { 
            font-size: 22px; 
            font-weight: 800; 
            color: var(--brand);
            margin: 0;
        }

        .room-price .per-night { 
            margin-left: 6px; 
            font-size: 14px; 
            color: #6b7280; 
            font-weight: 500; 
        }

        .btn-primary {
            background: var(--brand);
            color: #fff;
            border: 0;
            padding: 12px 18px;
            font-weight: 700;
            cursor: pointer;
            border-radius: var(--radius);
            transition: all 0.2s ease;
            font-size: 14px;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: var(--brand-dark);
            transform: translateY(-1px);
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
        EMPTY STATE
        ========================= */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            max-width: 500px;
            margin: 40px auto;
        }

        .empty-state img {
            max-width: 250px;
            margin-bottom: 32px;
            opacity: 0.8;
        }

        .empty-state h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #111827;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.6;
            max-width: 400px;
            margin: 0 auto;
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
            .search-wrap {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .btn-check {
                grid-column: 1 / -1;
                width: 200px;
                justify-self: start;
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
            /* Room Card Mobile */
            .room-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            
            .btn-primary {
                width: 100%;
            }
            
            /* Search Mobile */
            .search-wrap {
                grid-template-columns: 1fr;
            }
            
            .btn-check {
                width: 100%;
                grid-column: auto;
            }
            
            .result-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .result-info h2 {
                font-size: 1.75rem;
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
                min-height: 360px; 
                flex-direction: row; 
                flex-wrap: nowrap; 
                align-items: center; 
                justify-content: center; 
                gap: clamp(12px, 2vw, 24px); 
            }
            .hero-image { 
                flex: 0 0 55%; 
            }
            .hero-image img { 
                display: block; 
                width: 100%; 
                height: 100%; 
                min-height: 360px; 
                object-fit: cover; 
                object-position: center; 
            }
            .hero-content { 
                flex: 0 0 45%; 
                padding: 20px 16px; 
                text-align: left; 
                align-items: flex-start; 
            }
            .hero-content h1 { 
                font-size: clamp(22px, 7vw, 32px); 
                line-height: 1.15; 
                margin-bottom: 12px; 
            }
            .hero-content p { 
                font-size: clamp(12px, 3.5vw, 14px); 
                margin-bottom: 18px; 
            }
            .btn { 
                padding: 10px 16px; 
                font-size: clamp(12px, 3.6vw, 14px); 
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
            .empty-state {
                padding: 60px 20px;
                margin: 30px auto;
            }
            
            .empty-state img {
                max-width: 200px;
                margin-bottom: 24px;
            }
            
            .empty-state h3 {
                font-size: 1.5rem;
            }
            
            .empty-state p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                min-height: 350px;
            }
            
            .hero-content {
                padding: 30px 15px;
            }
            
            .hero-content h1 {
                font-size: 1.8rem;
                margin-bottom: 12px;
            }
            
            .hero-content p {
                font-size: 0.95rem;
                margin-bottom: 24px;
            }
            
            .btn {
                padding: 12px 24px;
                font-size: 0.95rem;
            }

            .search-section {
                padding: 30px 5%;
            }

            .search-wrap {
                padding: 20px;
            }

            .filter-wrap {
                gap: 8px;
            }

            .chip {
                padding: 8px 12px;
                font-size: 13px;
            }

            .result-info h2 {
                font-size: 1.5rem;
            }

            .badge {
                font-size: 13px;
                padding: 8px 12px;
            }

            .rooms-section {
                padding: 0 5% 40px;
            }

            .rooms-container {
                gap: 20px;
            }

            .room-image {
                height: 200px;
            }

            .room-info h3 {
                font-size: 20px;
            }

            .room-price {
                font-size: 20px;
            }

            .btn-primary {
                padding: 11px 16px;
            }
            .empty-state {
                padding: 40px 16px;
                margin: 20px auto;
            }
            
            .empty-state img {
                max-width: 160px;
                margin-bottom: 20px;
            }
            
            .empty-state h3 {
                font-size: 1.3rem;
            }
            
            .empty-state p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .hero-image {
                flex: 0 0 35%;
            }
            
            .hero-content h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('reservation') }}" class="active">Reservasi</a>
            <a href="{{ url('/about') }}">Tentang</a>
        </nav>
    </header>

    <!-- Hero Section -->
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
            <a href="#search-section" class="btn">Cari Kamar Tersedia</a>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section" id="search-section">
        <form id="reservasi" class="search-wrap">
            @csrf
            <div class="field">
                <label class="label" for="checkin">Check In</label>
                <div class="input">
                    <input type="date" id="checkin" required />
                </div>
            </div>
            <div class="field">
                <label class="label" for="checkout">Check Out</label>
                <div class="input">
                    <input type="date" id="checkout" required />
                </div>
            </div>
            <div class="field">
                <label class="label" for="persons">Jumlah Tamu</label>
                <div class="input">
                    <select id="persons" aria-label="Jumlah tamu">
                        <option value="1">01 Person</option>
                        <option value="2" selected>02 Person</option>
                        <option value="3">03 Person</option>
                        <option value="4">04 Person</option>
                    </select>
                </div>
            </div>
            <button class="btn-check" type="submit">Cari Kamar Tersedia</button>
        </form>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="filter-wrap" id="filterChips">
            <button type="button" class="chip active" data-filter="all">Semua Kamar</button>
            <button type="button" class="chip" data-filter="Suite Room">Suite Room</button>
            <button type="button" class="chip" data-filter="Deluxe Room">Deluxe Room</button>
            <button type="button" class="chip" data-filter="Superior Room">Superior Room</button>
            <button type="button" class="chip" data-filter="Standard Room">Standard Room</button>
        </div>
    </section>

    <!-- Result Info -->
    <section class="result-section">
        <div class="result-info">
            <h2>Daftar Kamar Tersedia</h2>
            <span class="badge" id="resultCount">Memuat kamar...</span>
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="rooms-section">
        <div class="rooms-container" id="roomsList">
            <!-- Room cards akan diisi oleh JavaScript -->
        </div>
    </section>

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

    <!-- JavaScript -->
    <script>
        // Base URL untuk API
        const BASE_URL = '{{ url("/") }}'.replace(/^http:/, 'https:');

        // ========== FUNGSI UTAMA ==========
        function formatPrice(price) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
        }

        function sortRoomsByCategoryAndPrice(rooms) {
            const categoryOrder = {
                'Suite Room': 1,
                'Deluxe Room': 2, 
                'Superior Room': 3,
                'Standard Room': 4
            };
            
            return rooms.sort((a, b) => {
                const categoryA = categoryOrder[a.room_booking_type] || 5;
                const categoryB = categoryOrder[b.room_booking_type] || 5;
                
                if (categoryA !== categoryB) {
                    return categoryA - categoryB;
                }
                
                return b.room_booking_price - a.room_booking_price;
            });
        }

        async function loadRooms() {
            try {
                console.log('Loading rooms from:', `${BASE_URL}/api/available-rooms`);
                
                const response = await fetch(`${BASE_URL}/api/available-rooms`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Rooms data received:', data);
                
                window.allRooms = sortRoomsByCategoryAndPrice(data.rooms || []);
                renderRooms(window.allRooms);
                updateRoomCount(window.allRooms.length);
                
            } catch (error) {
                console.error('Error loading rooms:', error);
                
                // Fallback ke dummy data
                window.allRooms = sortRoomsByCategoryAndPrice(fallbackRooms);
                renderRooms(window.allRooms);
                updateRoomCount(window.allRooms.length);
                
                showTemporaryMessage('Menggunakan data contoh', 'info');
            }
        }

        // Fungsi untuk render kamar
        function renderRooms(rooms) {
            const roomsContainer = document.getElementById('roomsList');
            
            if (rooms.length === 0) {
                roomsContainer.innerHTML = `
                    <div class="empty-state">
                        <img src="/images/emptystate.png" alt="Kamar Tidak Tersedia" />
                        <h3>Wah, kamar kami sedang penuh!</h3>
                        <p>Silakan cek tanggal lain atau filter kategori yang berbeda untuk melihat ketersediaan kamar.</p>
                    </div>
                `;
                return;
            }

            const roomsHTML = rooms.map(room => `
                <div class="room-card" 
                    data-type="${room.room_booking_type}" 
                    data-room="${room.room_booking_name}"
                    data-price="${room.room_booking_price}">
                    <div class="room-image">
                        <img src="/images/${room.room_booking_image || 'default-room.jpg'}" 
                            alt="${room.room_booking_name}" 
                            onerror="this.src='/images/default-room.jpg'"/>
                    </div>
                    <div class="room-content">
                        <div class="room-info">
                            <h3>${room.room_booking_name}</h3>
                            <p class="meta">
                                <svg class="icon-people" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                ${room.room_booking_capacity}
                            </p>
                            <div class="room-price">
                                ${formatPrice(room.room_booking_price)}<span class="per-night">/malam</span>
                            </div>
                        </div>
                        <button class="btn-primary book-btn" type="button" data-room-id="${room.room_booking_id}">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            `).join('');

            roomsContainer.innerHTML = roomsHTML;
            attachBookingHandlers();
        }

        function updateRoomCount(count) {
            const resultCount = document.getElementById('resultCount');
            if (count === 0) {
                resultCount.textContent = 'Tidak ada kamar tersedia';
            } else {
                resultCount.textContent = `${count} kamar tersedia`;
            }
        }

        // Di file reservation.blade.php - bagian attachBookingHandlers
        function attachBookingHandlers() {
            document.querySelectorAll('.book-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const roomId = this.getAttribute('data-room-id');
                    const roomCard = this.closest('.room-card');
                    
                    const checkin = document.getElementById('checkin')?.value || '';
                    const checkout = document.getElementById('checkout')?.value || '';
                    const personsSel = document.getElementById('persons');
                    const persons = personsSel ? personsSel.value : '2';
                    
                    // ✅ VALIDASI TANGGAL
                    if (!checkin || !checkout) {
                        alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu');
                        return;
                    }
                    
                    const checkinDate = new Date(checkin);
                    const checkoutDate = new Date(checkout);
                    
                    if (checkoutDate <= checkinDate) {
                        alert('Tanggal check-out harus setelah tanggal check-in');
                        return;
                    }
                    
                    const roomName = roomCard.querySelector('h3')?.textContent?.trim() || 'Kamar';
                    const priceText = roomCard.querySelector('.room-price')?.textContent || '0';
                    const price = parseInt(priceText.replace(/\D/g, '')) || 0;
                    
                    // ✅ PERBAIKAN: Gunakan variabel `price` yang sudah didefinisikan
                    window.location.href = `{{ route('booking.review') }}?room_id=${roomId}&room=${encodeURIComponent(roomName)}&price=${price}&checkin=${checkin}&checkout=${checkout}&persons=${persons}`;
                });
            });
        }
        function showTemporaryMessage(message, type = 'info') {
            const messageDiv = document.createElement('div');
            messageDiv.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                z-index: 10000;
                max-width: 400px;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                background: ${type === 'warning' ? '#f59e0b' : '#3b82f6'};
            `;
            messageDiv.textContent = message;
            
            document.body.appendChild(messageDiv);
            
            setTimeout(() => {
                messageDiv.remove();
            }, 4000);
        }

        // Filter functionality
        function setupFilters() {
            document.querySelectorAll('#filterChips .chip').forEach(chip => {
                chip.addEventListener('click', function() {
                    document.querySelectorAll('#filterChips .chip').forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    const activeFilter = this.getAttribute('data-filter');
                    applyFilters(activeFilter);
                });
            });
        }

        function applyFilters(activeFilter) {
            let filteredRooms;
            
            if (activeFilter === "all") {
                filteredRooms = window.allRooms;
            } else {
                filteredRooms = window.allRooms
                    .filter(room => room.room_booking_type === activeFilter)
                    .sort((a, b) => b.room_booking_price - a.room_booking_price);
            }
            
            renderRooms(filteredRooms);
            updateRoomCount(filteredRooms.length);
            
            if (filteredRooms.length > 0) {
                document.getElementById('roomsList').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Date validation
        function setupDateValidation() {
            const toISO = (d) => d.toISOString().slice(0, 10);
            const addDays = (d, n) => {
                const x = new Date(d);
                x.setDate(x.getDate() + n);
                return x;
            };
            
            const checkin = document.getElementById('checkin');
            const checkout = document.getElementById('checkout');
            const today = new Date();
            const isoToday = toISO(today);
            
            checkin.min = isoToday;
            checkin.value = isoToday;
            checkout.min = checkin.value;
            checkout.value = toISO(addDays(today, 1));
            
            checkin.addEventListener('change', () => {
                if (checkin.value < isoToday) checkin.value = isoToday;
                checkout.min = checkin.value;
                if (checkout.value < checkin.value) checkout.value = checkin.value;
            });
            
            checkout.addEventListener('change', () => {
                if (checkout.value < checkin.value) checkout.value = checkin.value;
                if (checkout.value < isoToday) checkout.value = toISO(addDays(today, 1));
            });
        }

        // Navbar functionality
        function setupNavbar() {
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
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupNavbar();
            setupDateValidation();
            setupFilters();
            loadRooms();

            document.getElementById('reservasi').addEventListener('submit', function(e) {
                e.preventDefault();
                loadRooms();
            });
        });
    </script>
</body>
</html>