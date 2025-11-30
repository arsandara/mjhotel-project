<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $room->room_name }} | Hotel Mukti Jaya</title>

    <!-- Font Geist -->
    <link
      href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ========= Reset & Vars ========= */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      :root {
        --brand: #0e4c2f;
        --brand-dark: #08341f;
        --bg: #f8fafc;
        --bg-soft: #d9e8ef;
        --text: #111827;
        --shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        --nav-h: 60px;
        --radius: 12px;
      }
      html,
      body {
        height: 100%;
      }
      body {
        font-family: "Geist", sans-serif;
        background: var(--bg);
        color: var(--text);
        padding-top: var(--nav-h);
        line-height: 1.55;
      }
      .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
      }

      /* ========= Navbar ========= */
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
      .navbar.has-shadow {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      }
      .logo {
        height: 40px;
      }
      .nav-menu {
        display: flex;
        align-items: center;
      }
      .nav-menu a {
        color: #fff;
        text-decoration: none;
        margin-left: 20px;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: background 0.25s;
      }
      .nav-menu a:hover {
        background: rgba(255, 255, 255, 0.2);
      }
      .nav-menu .active {
        background: #fff;
        color: var(--brand);
        font-weight: 600;
      }
      .nav-toggle {
        display: none;
        background: transparent;
        border: 0;
        color: #fff;
        padding: 6px;
        cursor: pointer;
      }

      /* ========= Hero ========= */
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

      /* ========= Room Gallery ========= */
      .room-container {
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 18px;
        box-shadow: var(--shadow);
        max-width: 1200px;
        width: 100%;
        margin: 60px auto;
        padding: 30px;
      }

      .mosaic-gallery {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        grid-auto-rows: 140px;
        gap: 14px;
        padding: 14px;
        background: #fff;
        border-radius: 18px;
      }

      .gallery-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        cursor: zoom-in;
        transition: transform 0.3s;
      }

      .gallery-item:hover {
        transform: scale(1.02);
      }

      .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
      }

      /* Layout untuk 1 gambar */
      .mosaic-gallery:has(.gallery-item:nth-child(1):last-child) .gallery-item {
        grid-column: span 12;
        grid-row: span 4;
      }

      /* Layout untuk 2 gambar */
      .mosaic-gallery:has(.gallery-item:nth-child(2):last-child) .gallery-item:nth-child(1) {
        grid-column: span 8;
        grid-row: span 4;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(2):last-child) .gallery-item:nth-child(2) {
        grid-column: span 4;
        grid-row: span 4;
      }

      /* Layout untuk 3 gambar */
      .mosaic-gallery:has(.gallery-item:nth-child(3):last-child) .gallery-item:nth-child(1) {
        grid-column: span 8;
        grid-row: span 4;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(3):last-child) .gallery-item:nth-child(2) {
        grid-column: span 4;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(3):last-child) .gallery-item:nth-child(3) {
        grid-column: span 4;
        grid-row: span 2;
      }

      /* Layout untuk 4 gambar - 2x2 grid */
      .mosaic-gallery:has(.gallery-item:nth-child(4):last-child) .gallery-item:nth-child(1) {
        grid-column: span 6;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(4):last-child) .gallery-item:nth-child(2) {
        grid-column: span 6;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(4):last-child) .gallery-item:nth-child(3) {
        grid-column: span 6;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(4):last-child) .gallery-item:nth-child(4) {
        grid-column: span 6;
        grid-row: span 2;
      }

      /* Layout untuk 5 gambar - DIUBAH: 1 besar kiri, 4 kecil kanan (2x2) */
      .mosaic-gallery:has(.gallery-item:nth-child(5):last-child) .gallery-item:nth-child(1) {
        grid-column: span 6;
        grid-row: span 4;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(5):last-child) .gallery-item:nth-child(2) {
        grid-column: span 3;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(5):last-child) .gallery-item:nth-child(3) {
        grid-column: span 3;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(5):last-child) .gallery-item:nth-child(4) {
        grid-column: span 3;
        grid-row: span 2;
      }

      .mosaic-gallery:has(.gallery-item:nth-child(5):last-child) .gallery-item:nth-child(5) {
        grid-column: span 3;
        grid-row: span 2;
      }

      .room-info {
        margin-top: 28px;
        padding-top: 18px;
        border-top: 1px solid #e5e7eb;
      }
      .room-info h2 {
        font-size: 1.9rem;
        margin-bottom: 10px;
        color: var(--brand);
      }
      .room-info p {
        color: #374151;
        margin: 6px 0;
      }
      .rules {
        margin-top: 16px;
        padding-left: 22px;
      }
      .rules li {
        margin-bottom: 6px;
      }

      /* ========= Footer ========= */
      .footer {
        width: 100%;
        background: var(--brand);
        color: #fff;
        padding: 48px 5%;
        display: grid;
        grid-template-columns: 260px 1fr;
        align-items: start;
        gap: 36px;
      }
      .footer-left {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .footer-logo {
        width: 220px;
        height: auto;
        margin-bottom: 12px;
      }
      .footer-right {
        border-left: 1px solid rgba(255, 255, 255, 0.25);
        padding-left: 32px;
      }
      .footer-right h3 {
        font-size: 1.4rem;
        margin-bottom: 16px;
        font-weight: 700;
      }
      .footer-columns {
        display: grid;
        grid-template-columns: repeat(3, minmax(220px, 1fr));
        gap: 20px 28px;
      }
      .footer-col {
        text-align: justify;
        line-height: 1.7;
        font-size: 0.95rem;
        color: #e5e5e5;
      }
      .footer-bottom {
        width: 100%;
        text-align: center;
        font-size: 0.85rem;
        padding: 14px;
        background: #044f32;
        color: #dcdcdc;
        border-top: 1px solid #0d6841;
      }

      /* ========= Lightbox ========= */
      .lightbox {
        position: fixed;
        inset: 0;
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(2px);
      }
      .lightbox.open {
        display: flex;
      }
      .lightbox__dialog {
        width: min(92vw, 1100px);
        border-radius: 16px;
        background: #f3f4f6;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
        position: relative;
        padding: 18px 56px;
      }
      .lightbox__stage {
        background: #e5e7eb;
        border-radius: 18px;
        padding: 14px;
      }
      .lightbox__img {
        width: 100%;
        height: auto;
        display: block;
        max-height: 70vh;
        object-fit: contain;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      }
      .lightbox__close,
      .lightbox__nav {
        position: absolute;
        border: 0;
        border-radius: 999px;
        height: 42px;
        width: 42px;
        display: grid;
        place-items: center;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.92);
        color: #0a0a0a;
      }
      .lightbox__close {
        top: 10px;
        right: 10px;
      }
      .lightbox__prev {
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
      }
      .lightbox__next {
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
      }
      .lightbox__hint {
        position: absolute;
        bottom: 8px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-size: 12px;
        opacity: 0.8;
      }

      /* ========= Responsive ========= */
      @media (max-width: 1024px) {
        .navbar {
          padding: 12px 24px;
        }
        .hero-content {
          padding: 40px 48px;
        }
        .footer {
          grid-template-columns: 220px 1fr;
          gap: 28px;
          padding: 40px clamp(16px, 5vw, 24px);
        }
        .footer-right {
          padding-left: 24px;
        }
        .footer-logo {
          width: 200px;
        }
        .footer-columns {
          grid-template-columns: repeat(2, minmax(220px, 1fr));
        }
      }

      @media (max-width: 768px) {
        :root {
          --nav-h: 54px;
        }
        body {
          padding-top: var(--nav-h);
        }

        /* Navbar Mobile */
        .nav-toggle {
          display: inline-flex;
          margin-left: auto;
        }
        .navbar {
          padding: 6px 16px;
        }
        .nav-menu {
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
          transition: max-height 0.3s ease;
          border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .nav-menu a {
          color: #fff;
          padding: 10px 16px;
          border-bottom: 1px solid rgba(255, 255, 255, 0.08);
          margin-left: 0;
          border-radius: 0;
          font-size: 0.9rem;
        }
        .nav-menu.open {
          max-height: 70vh;
        }
        html.nav-open,
        html.nav-open body {
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

        /* Room Gallery Mobile */
        .room-container {
          margin: 28px auto;
          padding: 18px;
          border-radius: 14px;
        }
        .mosaic-gallery {
          grid-template-columns: 1fr;
          grid-auto-rows: 250px;
          gap: 12px;
          padding: 12px;
        }
        .gallery-item,
        .gallery-item.portrait {
          grid-column: 1 !important;
          grid-row: auto !important;
        }
        .room-info h2 {
          font-size: 1.5rem;
        }

        /* Footer Mobile */
        .footer {
          grid-template-columns: 1fr;
          text-align: center;
          gap: 20px;
          padding: 36px 16px;
        }
        .footer-right {
          border: 0;
          padding-left: 0;
        }
        .footer-columns {
          grid-template-columns: 1fr;
          gap: 14px;
        }
        .footer-col {
          text-align: left;
        }
        .footer-logo {
          width: 180px;
        }

        /* Lightbox Mobile */
        .lightbox__dialog {
          width: 96vw;
          padding: 12px 48px;
        }
        .lightbox__stage {
          padding: 10px;
          border-radius: 14px;
        }
        .lightbox__img {
          max-height: 66vh;
          border-radius: 10px;
        }
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
      }
    </style>
  </head>
  <body>
    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
      <div class="logo-area">
        <img
          src="{{ asset('images/logo.png') }}"
          alt="Logo Hotel"
          class="logo"
          loading="lazy"
          decoding="async"
        />
      </div>

      <button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false" id="navToggle">
        <span class="sr-only">Buka menu</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
          <path d="M3 6h18M3 12h18M3 18h18" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>

      <nav class="nav-menu" id="primary-nav">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ url('/reservation') }}" class="{{ request()->is('reservation') ? 'active' : '' }}">Reservasi</a>
        <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">Tentang</a>
      </nav>
    </header>

    <!-- ===== HERO ===== -->
    <section class="hero">
      <div class="hero-image">
        <img
          src="{{ asset('images/ataslanding.png') }}"
          alt="Hotel Mukti Jaya"
          loading="lazy"
          decoding="async"
        />
      </div>
      <div class="hero-content">
        <h1>Hotel <br /><span>Mukti Jaya</span></h1>
        <p>
          Tempat menginap nyaman dengan pelayanan ramah dan fasilitas lengkap
          untuk istirahat terbaik Anda.
        </p>
        <a href="{{ url('/reservation') }}" class="btn">Pesan Kamar Sekarang</a>
      </div>
    </section>

    <!-- ===== ROOM SECTION ===== -->
    <div class="room-container">
      <div class="mosaic-gallery">
        @foreach($room->images->sortBy('sort_order') as $index => $image)
          <div class="gallery-item">
            <img
              src="{{ asset('images/rooms/' . $image->image_path) }}"
              alt="{{ $room->room_name }} - Foto {{ $index + 1 }}"
              loading="lazy"
              decoding="async"
            />
          </div>
        @endforeach
      </div>

      <div class="room-info">
        <h2>{{ $room->room_name }}</h2>
        <p><strong>👥 Kapasitas:</strong> {{ $room->room_capacity }} Orang</p>
        <p><strong>💰 Harga:</strong> Rp {{ number_format($room->room_price, 0, ',', '.') }} / malam</p>
        <p><strong>🛋️ Fasilitas:</strong> {{ $room->room_facility }}</p>

        <h3 style="margin-top: 20px; color: #065f46">Peraturan Check Out / Keluar:</h3>
        <ul class="rules">
          @foreach(explode("\n", $room->room_rules) as $rule)
            @if(trim($rule))
              <li>{{ $rule }}</li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
      <div class="footer-left">
        <img src="{{ asset('images/logo.png') }}" alt="Hotel Mukti Jaya" class="footer-logo" loading="lazy" decoding="async"/>
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

    <!-- ===== LIGHTBOX ===== -->
    <div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="Galeri gambar">
      <div class="lightbox__dialog">
        <button class="lightbox__close" id="lbClose" aria-label="Tutup">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <path d="M18.3 5.7L5.7 18.3m12.6 0L5.7 5.7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
        <button class="lightbox__nav lightbox__prev" id="lbPrev" aria-label="Sebelumnya">
          <svg width="18" height="18" viewBox="0 0 24 24">
            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
          </svg>
        </button>
        <button class="lightbox__nav lightbox__next" id="lbNext" aria-label="Berikutnya">
          <svg width="18" height="18" viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
          </svg>
        </button>
        <div class="lightbox__stage">
          <img class="lightbox__img" id="lbImg" src="" alt="Foto kamar" />
        </div>
        <div class="lightbox__hint">Geser kiri/kanan • Tap di luar untuk menutup</div>
      </div>
    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
      // Navbar shadow
      window.addEventListener("scroll", () => {
        document.querySelector(".navbar").classList.toggle("has-shadow", window.scrollY > 10);
      });

      // Mobile nav
      (function () {
        const toggle = document.getElementById("navToggle");
        const menu = document.getElementById("primary-nav");
        if (!toggle || !menu) return;
        toggle.addEventListener("click", () => {
          const open = menu.classList.toggle("open");
          toggle.setAttribute("aria-expanded", String(open));
          document.documentElement.classList.toggle("nav-open", open);
        });
      })();

      // Lightbox
      (function () {
        const thumbs = Array.from(document.querySelectorAll(".mosaic-gallery img"));
        if (!thumbs.length) return;

        const lb = document.getElementById("lightbox");
        const lbImg = document.getElementById("lbImg");
        const prevB = document.getElementById("lbPrev");
        const nextB = document.getElementById("lbNext");
        const closeB = document.getElementById("lbClose");

        let idx = 0, startX = 0;

        const show = (i) => {
          idx = (i + thumbs.length) % thumbs.length;
          const t = thumbs[idx];
          lbImg.src = t.src;
          lbImg.alt = t.alt || "Foto kamar";
        };
        const open = (i) => {
          show(i);
          lb.classList.add("open");
          lb.setAttribute("aria-hidden", "false");
          document.documentElement.style.overflow = "hidden";
        };
        const close = () => {
          lb.classList.remove("open");
          lb.setAttribute("aria-hidden", "true");
          document.documentElement.style.overflow = "";
        };
        const prev = () => show(idx - 1);
        const next = () => show(idx + 1);

        thumbs.forEach((img, i) => img.addEventListener("click", () => open(i)));
        prevB.addEventListener("click", prev);
        nextB.addEventListener("click", next);
        closeB.addEventListener("click", close);
        lb.addEventListener("click", (e) => {
          if (e.target === lb) close();
        });

        window.addEventListener("keydown", (e) => {
          if (!lb.classList.contains("open")) return;
          if (e.key === "Escape") close();
          if (e.key === "ArrowLeft") prev();
          if (e.key === "ArrowRight") next();
        });

        lbImg.addEventListener("touchstart", (e) => {
          startX = e.touches[0].clientX;
        }, { passive: true });
        lbImg.addEventListener("touchend", (e) => {
          const dx = e.changedTouches[0].clientX - startX;
          if (dx > 40) prev();
          if (dx < -40) next();
        });
      })();
    </script>
  </body>
</html>