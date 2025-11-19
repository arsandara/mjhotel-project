<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin | Hotel Mukti Jaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        :root {
            --brand: #0e4c2f;
            --brand-2: #065238;
            --brand-2-20: rgba(6, 82, 56, 0.2);
            --bg: #f1f5f9;
            --text: #111827;
            --muted: #475569;
            --border: #e5e7eb;
            --shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            --radius: 16px;
            --side-w: 260px;

            --green-bg: rgba(6, 124, 56, 0.12);
            --green: #0a7a3e;
            --green-br: rgba(6, 124, 56, 0.25);
            --amber-bg: rgba(245, 158, 11, 0.16);
            --amber: #b45309;
            --amber-br: rgba(245, 158, 11, 0.3);
            --red-bg: rgba(239, 68, 68, 0.12);
            --red: #b91c1c;
            --red-br: rgba(239, 68, 68, 0.25);
        }
        body {
            font-family: "Geist", sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .app {
            display: grid;
            grid-template-columns: var(--side-w) 1fr;
            min-height: 100svh;
        }

        /* Sidebar */
        aside {
            background: #fff;
            border-right: 1px solid var(--border);
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            position: sticky;
            top: 0;
            height: 100svh;
            overflow-y: auto;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 4px 12px;
        }
        .brand img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: contain;
        }
        .brand .meta b {
            font-size: 16px;
        }
        .brand .meta small {
            color: #6b7280;
            font-size: 12px;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 14px;
            color: #0f172a;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.2s;
        }
        .menu a svg {
            width: 22px;
            height: 22px;
        }
        .menu a.active {
            background: var(--brand-2-20);
        }
        .menu a:hover {
            background: rgba(6, 82, 56, 0.08);
        }
        .logout {
            margin-top: auto;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            text-align: center;
            color: #374151;
            background: #f3f4f6;
            cursor: pointer;
            transition: 0.25s;
        }
        .logout:hover {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* Main */
        main {
            padding: 24px;
        }
        .page-title {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .subtitle {
            color: #64748b;
            margin-bottom: 16px;
            font-size: 13.5px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--brand);
            margin-bottom: 8px;
        }
        .stat-label {
            font-size: 14px;
            color: var(--muted);
        }

        /* Card & table */
        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .card-h {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-h h3 {
            font-size: 15px;
            font-weight: 700;
        }
        .card-b {
            padding: 14px;
        }

        .table-wrap {
            overflow: auto;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }
        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        th {
            background: #f9fafb;
            text-align: left;
            font-size: 12.5px;
            color: #334155;
        }
        td {
            font-size: 13px;
        }
        .email-green {
            color: var(--brand-2);
            font-weight: 600;
        }

        /* col width & align supaya sejajar antara 2 tabel bawah */
        .cols-ks th:nth-child(1),
        .cols-ks td:nth-child(1) {
            width: 58%;
            text-align: left;
        }
        .cols-ks th:nth-child(2),
        .cols-ks td:nth-child(2) {
            width: 42%;
            text-align: center;
        } /* kolom status center */

        /* Buttons */
        .btn {
            height: 42px;
            border: 0;
            border-radius: 10px;
            padding: 0 16px;
            font-weight: 800;
            cursor: pointer;
        }
        .btn-primary {
            background: var(--brand);
            color: #fff;
            width: 100%;
        } /* penuh sepanjang card */
        .btn-primary:hover {
            opacity: 0.95;
        }

        /* ==== Chips ==== */
        /* toggle Ready/Sold (simple, tanpa panah) */
        .chip-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 90px;
            height: 32px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            user-select: none;
            transition: transform 0.06s ease;
        }
        .chip-toggle:active {
            transform: scale(0.98);
        }
        .chip--ready {
            background: var(--green-bg);
            color: var(--green);
            border-color: var(--green-br);
        }
        .chip--sold {
            background: var(--red-bg);
            color: var(--red);
            border-color: var(--red-br);
        }

        /* select chip untuk status reservasi */
        .chip-select {
            position: relative;
            display: inline-block;
        }
        .chip-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: 1px solid transparent;
            border-radius: 10px;
            height: 32px;
            min-width: 110px;
            padding: 0 28px 0 12px;
            background: #fff;
            font-family: "Geist", sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .chip-select.ready select {
            background: var(--green-bg);
            color: var(--green);
            border-color: var(--green-br);
        }
        .chip-select.pending select {
            background: var(--amber-bg);
            color: var(--amber);
            border-color: var(--amber-br);
        }
        .chip-select.cancelled select {
            background: var(--red-bg);
            color: var(--red);
            border-color: var(--red-br);
        }
        .chip-select:after {
            content: "▾";
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            opacity: 0.7;
            pointer-events: none;
        }

        @media (max-width: 900px) {
            :root {
                --side-w: 84px;
            }
            .brand .meta {
                display: none;
            }
            .menu a span {
                display: none;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 820px) {
            main {
                padding: 16px;
            }
            .page-title {
                font-size: 22px;
            }
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }
        @media (max-width: 820px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

    /* Chip yang bisa diklik untuk edit */
        .chip-editable {
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .chip-editable:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .chip-editable:active {
            transform: scale(0.98);
        }

        /* Tambahkan indikator untuk chip yang bisa diklik */
        .chip-editable::after {
            content: "✎";
            margin-left: 6px;
            font-size: 11px;
            opacity: 0.6;
        }
        /* SLIDER STYLES */
        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.3s ease;
        }

        .slider-slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slider-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
            padding: 12px;
        }

        .slider-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .slider-btn:hover {
            background: var(--brand-2-20);
            border-color: var(--brand-2);
        }

        .slider-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .slider-dots {
            display: flex;
            gap: 6px;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border);
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .slider-dot.active {
            background: var(--brand-2);
        }

        .slider-counter {
            font-size: 12px;
            color: var(--muted);
            min-width: 60px;
            text-align: center;
        }

        /* Status Chip Read-only */
        .chip-readonly {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 90px;
            height: 32px;
            padding: 0 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            user-select: none;
        }

        .chip-ready {
            background: var(--green-bg);
            color: var(--green);
            border: 1px solid var(--green-br);
        }

        .chip-pending {
            background: var(--amber-bg);
            color: var(--amber);
            border: 1px solid var(--amber-br);
        }

        .chip-cancelled {
            background: var(--red-bg);
            color: var(--red);
            border: 1px solid var(--red-br);
        }

        .chip-confirmed {
            background: var(--green-bg);
            color: var(--green);
            border: 1px solid var(--green-br);
        }
    </style>
</head>
<body>
    <div class="app">
        <!-- Sidebar -->
        <aside>
            <div class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Hotel Mukti Jaya" />
                <div class="meta">
                    <b>Hotel Mukti Jaya</b><br /><small>Admin Panel</small>
                </div>
            </div>

            <nav class="menu" id="sideMenu">
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="2" />
                        <rect x="14" y="3" width="7" height="7" rx="2" />
                        <rect x="14" y="14" width="7" height="7" rx="2" />
                        <rect x="3" y="14" width="7" height="7" rx="2" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.checkin') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12h12" />
                        <path d="m15 18 6-6-6-6" />
                        <path d="M3 3v18" />
                    </svg>
                    <span>Reservasi</span>
                </a>
                <a href="{{ route('admin.checkout') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 12H3" />
                        <path d="m9 18-6-6 6-6" />
                        <path d="M21 3v18" />
                    </svg>
                    <span>Tamu</span>
                </a>
                <a href="{{ route('admin.landing') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="2" y1="12" x2="22" y2="12" />
                        <path d="M12 2a15.3 15.3 0 0 1 0 20a15.3 15.3 0 0 1 0-20z" />
                    </svg>
                    <span>Landing Page</span>
                </a>
            </nav>

            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout" onclick="return confirm('Yakin ingin logout?')">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main -->
        <main>
            <h1 class="page-title">Dashboard</h1>
            <p class="subtitle">
                Pada halaman ini, admin dapat melihat reservasi terbaru dan edit ketersediaan kamar<br>
                untuk ditampilkan pada halaman pemesanan kamar pada website resmi Hotel Mukti Jaya.
            </p>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $totalRooms }}</div>
                    <div class="stat-label">Total Kamar</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $availableRooms }}</div>
                    <div class="stat-label">Kamar Tersedia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $totalBookings }}</div>
                    <div class="stat-label">Total Reservasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $pendingBookings }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>

            <!-- Reservasi Terbaru dengan SLIDER -->
            <section class="card">
                <div class="card-h">
                    <h3>Reservasi Terbaru</h3>
                </div>
                <div class="card-b">
                    <div class="slider-container">
                        <div class="slider-wrapper" id="reservasiSlider">
                            @php
                                $chunkedReservations = $latestReservations->chunk(5);
                            @endphp
                            
                            @foreach($chunkedReservations as $slideIndex => $reservations)
                            <div class="slider-slide">
                                <div class="table-wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 28%">Tamu</th>
                                                <th style="width: 20%">Kamar</th>
                                                <th style="width: 14%">Check In</th>
                                                <th style="width: 24%">Catatan</th>
                                                <th style="width: 14%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reservations as $reservation)
                                            <tr>
                                                <td>
                                                    <div style="display:flex;flex-direction:column;gap:4px">
                                                        <b style="font-weight:700">{{ $reservation['customer_name'] }}</b>
                                                        <span class="email-green">{{ $reservation['customer_email'] }}</span>
                                                        <small style="color:#64748b">{{ $reservation['customer_phone'] }}</small>
                                                    </div>
                                                </td>
                                                <td>{{ $reservation['room_name'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($reservation['check_in'])->format('d M Y') }}</td>
                                                <td>{{ $reservation['special_request'] ?: '-' }}</td>
                                                <td>
                                                    @if($reservation['is_editable'])
                                                        <label class="chip-select {{ strtolower($reservation['booking_status']) }}">
                                                            <select class="status-select" data-reservation-id="{{ $reservation['reservation_id'] }}">
                                                                <option value="Pending" {{ $reservation['booking_status'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="Confirmed" {{ $reservation['booking_status'] == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                                <option value="Cancelled" {{ $reservation['booking_status'] == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                            </select>
                                                        </label>
                                                    @else
                                                        <span class="chip-readonly chip-{{ strtolower($reservation['booking_status']) }}">
                                                            {{ $reservation['booking_status'] }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($chunkedReservations->count() > 1)
                        <div class="slider-controls">
                            <button class="slider-btn" id="sliderPrev" disabled>‹</button>
                            
                            <div class="slider-dots">
                                @foreach($chunkedReservations as $index => $slide)
                                <div class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                                @endforeach
                            </div>
                            
                            <span class="slider-counter">
                                <span id="currentSlide">1</span> / {{ $chunkedReservations->count() }}
                            </span>
                            
                            <button class="slider-btn" id="sliderNext" 
                                {{ $chunkedReservations->count() <= 1 ? 'disabled' : '' }}>
                                ›
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Status & Ketersediaan -->
            <section class="grid-2">
                <!-- Status Kamar -->
                <div class="card">
                    <div class="card-h">
                        <h3>Status Kamar</h3>
                    </div>
                    <div class="card-b">
                        <div class="table-wrap">
                            <table style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th style="width: 35%">Kamar</th>
                                        <th style="width: 25%; text-align: center">Okupansi</th>
                                        <th style="width: 40%; text-align: center">Ketersediaan Public</th>
                                    </tr>
                                </thead>
                                <tbody id="statusBody">
                                    @foreach($roomStatus as $room)
                                    <tr>
                                        <td>
                                            <div style="font-weight:600; margin-bottom:4px">{{ $room['name'] }}</div>
                                            <small style="color:#64748b">
                                                Terisi: {{ $room['occupied'] }}/{{ $room['total'] }}
                                            </small>
                                        </td>
                                        <td style="text-align: center">
                                            <!-- Status Otomatis (Read-only) -->
                                            <span class="chip-toggle {{ $room['auto_status'] == 'Ready' ? 'chip--ready' : 'chip--sold' }}" 
                                                style="cursor: default; opacity: 0.8">
                                                {{ $room['auto_status'] }}
                                            </span>
                                        </td>
                                        <td style="text-align: center">
                                            <!-- Status Manual (Editable by Admin) -->
                                            <button type="button" 
                                                    class="chip-toggle chip-editable {{ $room['manual_status'] == 'Available' ? 'chip--ready' : 'chip--sold' }}" 
                                                    data-room-id="{{ $room['id'] }}" 
                                                    data-state="{{ $room['manual_status'] }}"
                                                    title="Klik untuk ubah status tampil di public">
                                                {{ $room['manual_status'] }}
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; border-left: 3px solid var(--brand);">
                            <small style="color:#475569; display:block; margin-bottom: 6px">
                                <strong>ℹ️ Penjelasan Status:</strong>
                            </small>
                            <small style="color:#64748b; display:block; line-height: 1.6">
                                <strong>Okupansi:</strong> Status otomatis berdasarkan ketersediaan nomor kamar<br>
                                <strong>Ketersediaan Public:</strong> Klik untuk atur kamar tampil/tidak di website (untuk reservasi walk-in)
                            </small>
                        </div>
                        <div style="margin-top: 12px">
                            <button class="btn btn-primary" id="btnUpdateAvailability">Simpan Perubahan Status</button>
                        </div>
                    </div>
                </div>

                <!-- Ketersediaan Kamar -->
                <div class="card">
                    <div class="card-h"><h3>Ketersediaan Kamar</h3></div>
                    <div class="card-b">
                        <div class="table-wrap">
                            <table class="cols-ks">
                                <thead>
                                    <tr>
                                        <th>Kamar</th>
                                        <th>Nomor Kamar</th>
                                    </tr>
                                </thead>
                                <tbody id="availBody">
                                    @foreach($roomAvailability as $room)
                                    <tr>
                                        <td>{{ $room['name'] }}</td>
                                        <td>{{ implode(', ', $room['numbers']) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ===== SLIDER FUNCTIONALITY =====
        let currentSlide = 0;
        const sliderWrapper = document.getElementById('reservasiSlider');
        const slides = document.querySelectorAll('.slider-slide');
        const totalSlides = slides.length;
        const prevBtn = document.getElementById('sliderPrev');
        const nextBtn = document.getElementById('sliderNext');
        const currentSlideSpan = document.getElementById('currentSlide');
        const dots = document.querySelectorAll('.slider-dot');

        function updateSlider() {
            if (sliderWrapper) {
                sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update buttons
                if (prevBtn) prevBtn.disabled = currentSlide === 0;
                if (nextBtn) nextBtn.disabled = currentSlide === totalSlides - 1;
                
                // Update counter
                if (currentSlideSpan) currentSlideSpan.textContent = currentSlide + 1;
                
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }
        }

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlider();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentSlide < totalSlides - 1) {
                    currentSlide++;
                    updateSlider();
                }
            });

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });
        }

        // ===== UPDATE RESERVATION STATUS =====
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('status-select')) {
                const select = e.target;
                select.addEventListener('change', function() {
                    const reservationId = this.dataset.reservationId;
                    const newStatus = this.value;
                    
                    fetch(`/admin/reservations/${reservationId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const chip = this.closest('.chip-select');
                            chip.className = `chip-select ${newStatus.toLowerCase()}`;
                            alert('Status reservasi berhasil diupdate!');
                            
                            // Reload setelah 1 detik untuk update data
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            alert(data.message || 'Gagal mengupdate status reservasi');
                            // Reset select value
                            this.value = this.getAttribute('data-original-value');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal mengupdate status reservasi');
                        // Reset select value
                        this.value = this.getAttribute('data-original-value');
                    });
                });
            }
        });

        // Store original values for status selects
        document.querySelectorAll('.status-select').forEach(select => {
            select.setAttribute('data-original-value', select.value);
        });

        // ===== ROOM AVAILABILITY TOGGLE =====
        document.getElementById('statusBody')?.addEventListener('click', function(e) {
            const button = e.target.closest('.chip-editable');
            if (!button) return;

            const currentState = button.dataset.state;
            const newState = currentState === 'Available' ? 'Unavailable' : 'Available';
            
            button.dataset.state = newState;
            button.textContent = newState;
            button.className = `chip-toggle chip-editable ${newState === 'Available' ? 'chip--ready' : 'chip--sold'}`;
        });

        // ===== SAVE ROOM AVAILABILITY =====
        document.getElementById('btnUpdateAvailability')?.addEventListener('click', function() {
            const updates = [];
            
            document.querySelectorAll('#statusBody .chip-editable').forEach(button => {
                updates.push({
                    room_id: button.dataset.roomId,
                    status: button.dataset.state
                });
            });

            fetch('/admin/rooms/availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ updates: updates })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status ketersediaan kamar berhasil diperbarui!');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memperbarui status ketersediaan kamar');
            });
        });

        // Initialize slider
        updateSlider();
    </script>
</body>
</html>