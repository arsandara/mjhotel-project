<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Review Pemesanan | Hotel Mukti Jaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        /* ===== VARIABLES & RESET ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --brand: #0e4c2f;
            --brand-dark: #08341f;
            --bg: #f1f5f9;
            --text: #111827;
            --radius: 6px;
            --shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            --nav-h: 60px;
        }
        body {
            font-family: "Geist", sans-serif;
            background: var(--bg);
            color: var(--text);
            padding-top: var(--nav-h);
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
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
            height: var(--nav-h);
        }
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
        .nav-toggle { 
            display: none;
            background: transparent;
            border: 0;
            color: #fff;
            padding: 6px;
            cursor: pointer;
        }

        /* ===== MAIN CONTENT ===== */
        .wrap {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* ===== SUMMARY CARDS ===== */
        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }
        .sum-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius);
            padding: 20px;
            text-align: center;
            box-shadow: var(--shadow);
        }
        .sum-top {
            font-size: 14px;
            color: #475569;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .sum-val {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }
        .sum-sub {
            font-size: 12px;
            color: #64748b;
        }

        /* ===== ROOM CARD ===== */
        .room-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .room-card img {
            width: 280px;
            height: 180px;
            object-fit: cover;
            border-radius: var(--radius);
        }
        .room-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .room-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            color: #475569;
            margin-bottom: 15px;
        }
        .icon-people {
            width: 20px;
            height: 20px;
            stroke: #065238;
        }
        .room-price {
            font-size: 28px;
            font-weight: 800;
            color: var(--brand);
        }

        /* ===== SECTIONS ===== */
        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin: 40px 0 20px;
            color: var(--text);
        }
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        .req {
            color: #dc2626;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            height: 48px;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius);
            padding: 0 16px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus {
            border-color: var(--brand);
        }
        .dob {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
            gap: 12px;
        }
        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            min-height: 14px;
        }

        /* ===== PAYMENT ===== */
        .pay-card {
            background: var(--brand);
            color: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .pay-header {
            padding: 20px 24px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 16px;
        }
        .pay-body {
            padding: 20px 24px;
        }
        .pay-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 0;
            font-size: 14px;
        }
        .pay-row.total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            font-weight: 700;
        }
        .pay-row.total span:last-child {
            font-size: 18px;
            font-weight: 800;
        }
        .cta {
            padding: 20px 24px;
            background: rgba(255, 255, 255, 0.1);
        }
        .btn-light {
            width: 100%;
            height: 56px;
            background: #fff;
            color: var(--brand);
            border: 0;
            border-radius: var(--radius);
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-light:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .summary {
                grid-template-columns: 1fr;
            }
            
            .room-card {
                flex-direction: column;
            }
            .room-card img {
                width: 100%;
                height: 200px;
            }
            
            .nav-toggle {
                display: inline-flex;
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
            }
            .nav-menu a {
                margin: 0;
                padding: 14px 16px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            .nav-menu.open {
                max-height: 70vh;
            }
            
            .dob {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .wrap {
                padding: 0 15px;
                margin: 20px auto;
            }
            
            .pay-header,
            .pay-body,
            .cta {
                padding: 16px 18px;
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

        <button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M3 6h18M3 12h18M3 18h18" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <nav class="nav-menu" id="primary-nav">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('reservation') }}">Reservasi</a>
            <a href="{{ url('/about') }}">Tentang</a>
        </nav>
    </header>

    <main class="wrap">
        @php
            if (!isset($checkinDate)) {
                $checkinDate = \Carbon\Carbon::parse($checkin ?? now());
            }
            if (!isset($checkoutDate)) {
                $checkoutDate = \Carbon\Carbon::parse($checkout ?? now()->addDays(1));
            }
            if (!isset($duration)) {
                $duration = $checkoutDate->diffInDays($checkinDate);
                if ($duration < 1) $duration = 1;
            }
            if (!isset($totalPrice)) {
                $totalPrice = ($price ?? 0) * $duration;
            }
        @endphp

        <!-- Summary Cards - DATA DARI DATABASE -->
        <section class="summary">
            <div class="sum-box">
                <div class="sum-top">Check In</div>
                <div class="sum-val">{{ $checkinDate->format('d M Y') }}</div>
                <div class="sum-sub">14.00 WIB</div>
            </div>
            <div class="sum-box">
                <div class="sum-top">Check Out</div>
                <div class="sum-val">{{ $checkoutDate->format('d M Y') }}</div>
                <div class="sum-sub">12.00 WIB</div>
            </div>
            <div class="sum-box">
                <div class="sum-top">Durasi</div>
                <div class="sum-val">{{ $duration }}</div>
                <div class="sum-sub">Malam</div>
            </div>
            <div class="sum-box">
                <div class="sum-top">Tamu</div>
                <div class="sum-val">{{ $persons ?? 2 }}</div>
                <div class="sum-sub">Orang</div>
            </div>
        </section>

        <!-- Room Card - DATA DARI DATABASE -->
        <section class="room-card">
            @php
                // Handle path gambar
                $imagePath = $image ?? 'default-room.jpg';
                if (!str_starts_with($imagePath, 'images/')) {
                    $imagePath = 'images/' . $imagePath;
                }
            @endphp
            
            <img 
                src="{{ asset($imagePath) }}" 
                alt="{{ $roomName ?? 'Room' }}" 
                onerror="this.src='{{ asset('images/default-room.jpg') }}'; this.onerror=null;"
            />
            
            <div class="room-info">
                <div>
                    <div class="room-title">{{ $roomName ?? 'Room' }}</div>
                    <div class="meta">
                        <svg class="icon-people" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>{{ $persons ?? 2 }} Orang</span>
                    </div>
                </div>
                <div class="room-price">Rp {{ number_format($price ?? 0, 0, ',', '.') }}</div>
            </div>
        </section>

        <!-- Personal Info -->
        <h3 class="section-title">Informasi Pribadi</h3>
        <section class="card">
            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $roomId ?? '' }}">
                <input type="hidden" name="room_name" value="{{ $roomName ?? '' }}">
                <input type="hidden" name="price" value="{{ $price ?? 0 }}">
                <input type="hidden" name="checkin" value="{{ $checkin ?? '' }}">
                <input type="hidden" name="checkout" value="{{ $checkout ?? '' }}">
                <input type="hidden" name="persons" value="{{ $persons ?? 2 }}">
                
                <div class="field">
                    <label class="label">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="fullName" name="full_name" placeholder="Nama sesuai identitas KTP" />
                    <div class="error" id="errName"></div>
                </div>

                <div class="field">
                    <label class="label">Tanggal Lahir <span class="req">*</span></label>
                    <div class="dob">
                        <input type="text" id="dobD" name="dob_day" placeholder="dd" maxlength="2" inputmode="numeric" />
                        <input type="text" id="dobM" name="dob_month" placeholder="mm" maxlength="2" inputmode="numeric" />
                        <input type="text" id="dobY" name="dob_year" placeholder="yyyy" maxlength="4" inputmode="numeric" />
                    </div>
                    <div class="error" id="errDob"></div>
                </div>

                <div class="field">
                    <label class="label">Email <span class="req">*</span></label>
                    <input type="email" id="email" name="email" placeholder="nama@gmail.com" />
                    <div class="error" id="errEmail"></div>
                </div>

                <div class="field">
                    <label class="label">No. HP <span class="req">*</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="08xxxx" inputmode="numeric" maxlength="15" />
                    <div class="error" id="errPhone"></div>
                </div>

                <div class="field">
                    <label class="label">Catatan <span style="color: #64748b; font-size: 12px">(opsional)</span></label>
                    <input type="text" id="note" name="note" placeholder="ex. request nomor lantai (sesuai ketersediaan)" />
                </div>
            </form>
        </section>

        <!-- Payment - DATA DARI DATABASE -->
        <h3 class="section-title">Detail Pembayaran</h3>
        <section class="pay-card">
            <div class="pay-header">
                Detail Pembayaran
            </div>
            
            <div class="pay-body">
                <div class="pay-row">
                    <span>{{ $roomName ?? 'Room' }}</span>
                    <span>Rp {{ number_format($price ?? 0, 0, ',', '.') }}</span>
                </div>
                
                <div class="pay-row">
                    <span>Durasi</span>
                    <span>{{ $duration }} malam</span>
                </div>
                
                <div class="pay-row total">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="cta">
                <button class="btn-light" id="btnSubmit">Pesan Sekarang</button>
            </div>
        </section>
    </main>

    <!-- Script Midtrans - DIPERBAIKI: URL yang benar -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        // ========== NAVBAR MOBILE ==========
        const toggle = document.querySelector(".nav-toggle");
        const menu = document.getElementById("primary-nav");
        if (toggle && menu) {
            toggle.addEventListener("click", () => {
                const isOpen = menu.classList.toggle("open");
                toggle.setAttribute("aria-expanded", String(isOpen));
            });
        }

        // ========== HELPER FUNCTIONS ==========
        function formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID', { maximumFractionDigits: 0 });
        }

        function parseDateISO(dateStr) {
            return new Date(dateStr + 'T00:00:00');
        }

        function calcDuration(checkinStr, checkoutStr) {
            const ci = parseDateISO(checkinStr);
            const co = parseDateISO(checkoutStr);
            const diffMs = co - ci;
            const diffDays = Math.round(diffMs / (1000 * 60 * 60 * 24));
            return diffDays >= 1 ? diffDays : 1;
        }

        // ========== VALIDATION ==========
        function validate() {
            let ok = true;
            
            // Name
            const name = document.getElementById('fullName').value.trim();
            document.getElementById('errName').textContent = name.length < 3 ? (ok = false, 'Nama lengkap minimal 3 karakter.') : '';

            // DOB
            const dd = document.getElementById('dobD').value.trim();
            const mm = document.getElementById('dobM').value.trim();
            const yy = document.getElementById('dobY').value.trim();
            let dobErr = '';
            const currentYear = new Date().getFullYear();
            
            if (dd.length !== 2 || mm.length !== 2 || yy.length !== 4) {
                dobErr = 'Tanggal lahir harus format dd / mm / yyyy.';
            } else {
                const d = Number(dd), m = Number(mm), y = Number(yy);
                if (isNaN(d) || isNaN(m) || isNaN(y) || d < 1 || d > 31 || m < 1 || m > 12 || y < 1900 || y > currentYear) {
                    dobErr = 'Tanggal lahir tidak valid.';
                } else {
                    const dt = new Date(`${yy}-${mm.padStart(2,'0')}-${dd.padStart(2,'0')}T00:00:00`);
                    if (isNaN(dt) || dt.getDate() !== d || dt.getMonth() + 1 !== m || dt.getFullYear() !== y) {
                        dobErr = 'Tanggal lahir tidak valid.';
                    }
                }
            }
            document.getElementById('errDob').textContent = dobErr;
            if (dobErr) ok = false;

            // Email
            const email = document.getElementById('email').value.trim();
            const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            document.getElementById('errEmail').textContent = emailOk ? '' : (ok = false, 'Format email tidak valid.');

            // Phone
            const phoneRaw = document.getElementById('phone').value.trim().replace(/^\+/, '');
            const phoneOk = /^[0-9]{10,15}$/.test(phoneRaw);
            document.getElementById('errPhone').textContent = phoneOk ? '' : (ok = false, 'No. HP harus angka 10–15 digit.');

            return ok;
        }

        // ========== INPUT FORMATTING ==========
        ['dobD','dobM','dobY','phone'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', e => { 
                    e.target.value = e.target.value.replace(/\D/g,''); 
                });
            }
        });

        // Autofocus jumps for DOB
        const dobD = document.getElementById('dobD');
        const dobM = document.getElementById('dobM');
        const dobY = document.getElementById('dobY');

        if (dobD) dobD.addEventListener('input', e => { 
            if (e.target.value.length === 2 && dobM) dobM.focus(); 
        });
        if (dobM) dobM.addEventListener('input', e => { 
            if (e.target.value.length === 2 && dobY) dobY.focus(); 
        });

        // ========== BOOKING + PAYMENT FLOW ==========
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btnSubmit');  // DIPERBAIKI: Deklarasi btn di sini
            let processing = false;  // DIPERBAIKI: Deklarasi processing di sini

            btn.addEventListener('click', async function (e) {
                e.preventDefault();
                
                if (processing) return;
                
                // Validate form
                if (!validate()) {
                    const firstErr = document.querySelector('.error:not(:empty)');
                    if (firstErr) firstErr.scrollIntoView({ behavior:'smooth', block:'center' });
                    return;
                }

                // DIPERBAIKI: Cek window.snap sebelum lanjut
                if (!window.snap || typeof window.snap.pay !== 'function') {
                    alert('Midtrans Snap gagal dimuat. Refresh halaman.');
                    return;
                }

                // Disable button
                processing = true;
                btn.disabled = true;
                btn.textContent = 'Processing...';

                try {
                    // 1) Create reservation
                    const form = document.getElementById('bookingForm');
                    const formData = new FormData(form);

                    const bookingResp = await fetch("{{ route('booking.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const bookingJson = await bookingResp.json();

                    if (!bookingResp.ok || !bookingJson.success) {
                        alert(bookingJson.message || 'Failed to create reservation.');
                        processing = false;
                        btn.disabled = false;
                        btn.textContent = 'Pesan Sekarang';
                        return;
                    }

                    const reservationId = bookingJson.reservation_id;
                    const totalPrice = bookingJson.total_price || {{ $totalPrice ?? 0 }};

                    // 2) Request Midtrans snap token
                    const payResp = await fetch("{{ route('payment.create') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            reservation_id: reservationId,
                            total_price: totalPrice
                        })
                    });
                    
                    const payJson = await payResp.json();

                    if (!payResp.ok || !payJson.success || !payJson.snap_token) {
                        alert(payJson.message || 'Failed to create Midtrans transaction.');
                        processing = false;
                        btn.disabled = false;
                        btn.textContent = 'Pesan Sekarang';
                        return;
                    }

                    // 3) Open Midtrans Snap
                    window.snap.pay(payJson.snap_token, {
                        onSuccess: function(result) {
                            alert('Pembayaran sukses! Reservation ID: ' + reservationId);
                            window.location.href = "/reservation/thank-you?reservation_id=" + reservationId;
                        },
                        onPending: function(result) {
                            alert('Pembayaran pending. Reservation ID: ' + reservationId);
                            window.location.href = "/reservation/pending?reservation_id=" + reservationId;
                        },
                        onError: function(result) {
                            alert('Terjadi kesalahan saat pembayaran.');
                            console.error(result);
                            processing = false;
                            btn.disabled = false;
                            btn.textContent = 'Pesan Sekarang';
                        },
                        onClose: function() {
                            alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
                            processing = false;
                            btn.disabled = false;
                            btn.textContent = 'Pesan Sekarang';
                        }
                    });

                } catch (err) {
                    console.error(err);
                    alert('Terjadi kesalahan. Cek console untuk detail.');
                    processing = false;
                    btn.disabled = false;
                    btn.textContent = 'Pesan Sekarang';
                }
            });
        });
    </script>
</body>
</html>