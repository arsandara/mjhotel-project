<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Check Out | Hotel Mukti Jaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet" />

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
        --yellow: #f59e0b;
        --red: #ef4444;
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

      .toolbar {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 12px;
      }
      .search {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid var(--border);
        background: #fff;
        border-radius: 10px;
        padding: 0 12px;
        height: 40px;
      }
      .search input {
        border: 0;
        outline: 0;
        background: transparent;
        font-size: 14px;
        min-width: 220px;
      }

      /* Card & table */
      .card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
      }
      .card-b {
        padding: 12px;
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
        padding: 12px;
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

      .idcell {
        font-weight: 700;
        color: #111;
      }
      .money {
        white-space: nowrap;
      }
      .actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
      }
      .icon-btn {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 8px;
        display: grid;
        place-items: center;
        cursor: pointer;
        color: #fff;
      }
      .icon-btn svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
      }
      .b-yellow {
        background: #f59e0b;
      }
      .b-red {
        background: #ef4444;
      }

      /* Modal edit */
      .modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
        z-index: 50;
      }
      .modal.open {
        display: flex;
      }
      .dialog {
        width: min(520px, 95vw);
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--border);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
      }
      .dialog-h {
        padding: 14px 18px;
        border-bottom: 1px solid var(--border);
        font-size: 18px;
        font-weight: 700;
      }
      .dialog-b {
        padding: 18px;
      }
      .field {
        display: flex;
        flex-direction: column;
        gap: 6px;
      }
      label {
        font-size: 13px;
        color: #334155;
      }
      input[type="text"] {
        height: 42px;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0 12px;
        font-family: "Geist", sans-serif;
        font-size: 14px;
        background: #fff;
      }
      .dialog-f {
        padding: 14px 18px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 10px;
        justify-content: flex-end;
      }
      .btn {
        height: 40px;
        border: 0;
        border-radius: 10px;
        padding: 0 16px;
        font-weight: 700;
        cursor: pointer;
      }
      .btn-ghost {
        background: #fff;
        border: 1px solid var(--border);
        color: #111;
      }
      .btn-primary {
        background: var(--brand);
        color: #fff;
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
        aside {
            position: relative;
            height: auto;
        }
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
                <a href="{{ route('admin.dashboard') }}">
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
                <a href="{{ route('admin.checkout') }}" class="active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 12H3" />
                        <path d="m9 18-6-6 6-6" />
                        <path d="M21 3v18" />
                    </svg>
                    <span>Tamu Menginap</span>
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

            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form" style="margin-top: auto;">
              @csrf
              <button type="submit" class="logout" onclick="return confirm('Yakin ingin logout?')" style="border: 0; width: 100%;">
                  Logout
              </button>
          </form>
        </aside>

        <!-- Main -->
        <main>
            <h1 class="page-title">Tamu Menginap</h1>
            <p class="subtitle">
                Pada halaman ini, admin dapat melihat daftar tamu yang sedang menginap<br>
                dan melakukan proses check-out saat tamu selesai menginap.
            </p>

            <div class="toolbar">
                <div class="search">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    <input type="text" id="q" placeholder="Cari nama / kamar / email..." />
                </div>
            </div>

            <section class="card">
                <div class="card-b">
                    <div class="table-wrap">
                        <table id="tbl">
                            <thead>
                                <tr>
                                    <th style="width: 8%">ID</th>
                                    <th style="width: 18%">Nama Lengkap</th>
                                    <th style="width: 16%">Kamar</th>
                                    <th style="width: 12%">Check In</th>
                                    <th style="width: 12%">Check Out</th>
                                    <th style="width: 8%">Malam</th>
                                    <th style="width: 14%">Total</th>
                                    <th style="width: 12%; text-align: right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guests as $guest)
                                <tr data-id="{{ $guest->reservation_id }}">
                                    <td class="idcell">{{ $guest->reservation_id }}</td>
                                    <td>{{ $guest->customer_name }}</td>
                                    <td>
                                        {{ $guest->roomBooking->room_booking_name }}
                                        @if($guest->room_number)
                                            <div style="color:#64748b;font-size:12px;margin-top:4px">No: {{ $guest->room_number }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $guest->check_in->format('d M Y') }}</td>
                                    <td>{{ $guest->check_out->format('d M Y') }}</td>
                                    <td>{{ $guest->duration }}</td>
                                    <td class="money">Rp {{ number_format($guest->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="actions">
                                            <button class="icon-btn b-yellow" data-edit title="Edit nomor kamar">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 20h9"/>
                                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                </svg>
                                            </button>
                                            <button class="icon-btn b-red" data-checkout title="Check Out">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M15 12H3"/>
                                                    <path d="m9 18-6-6 6-6"/>
                                                    <path d="M21 3v18"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                                        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                                <polyline points="9 22 9 12 15 12 15 22"/>
                                            </svg>
                                            <div>
                                                <div style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">Belum ada tamu yang menginap</div>
                                                <div style="font-size: 14px; color: #94a3b8;">Tamu akan muncul di sini setelah melakukan check-in</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal: Edit Nomor Kamar -->
    <div class="modal" id="editModal" aria-hidden="true">
        <div class="dialog">
            <div class="dialog-h">Edit Nomor Kamar Tamu</div>
            <form id="editForm">
                @csrf
                <div class="dialog-b">
                    <div class="field">
                        <label>Nomor Kamar</label>
                        <input type="text" name="room_number" placeholder="Masukkan nomor kamar" required />
                    </div>
                </div>
                <div class="dialog-f">
                    <button type="button" class="btn btn-ghost" data-close>Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let editingId = null;

    // Modal functions
    const openModal = (modal) => {
        modal.classList.add('open');
        document.documentElement.style.overflow = 'hidden';
    };

    const closeModal = (modal) => {
        modal.classList.remove('open');
        document.documentElement.style.overflow = '';
    };

    // Event listeners untuk modal
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeModal(e.currentTarget);
        });
    }

    document.querySelectorAll('[data-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            closeModal(btn.closest('.modal'));
        });
    });

    // ===== TABLE ACTIONS =====
    const tableBody = document.getElementById('tbl');
    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            const tr = e.target.closest('tr[data-id]');
            if (!tr) return;
            
            const reservationId = tr.dataset.id;
            console.log('Action clicked for reservation:', reservationId);

            // Edit Nomor Kamar
            if (e.target.closest('[data-edit]')) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('=== EDIT CLICKED ===');
                editingId = reservationId;
                
                const roomNoDiv = tr.querySelector('td:nth-child(3) div');
                const currentRoomNo = roomNoDiv ? roomNoDiv.textContent.replace('No: ', '').trim() : '';
                
                console.log('Current room number:', currentRoomNo);
                
                const editForm = document.getElementById('editForm');
                const editInput = editForm?.querySelector('[name="room_number"]');
                if (editInput) {
                    editInput.value = currentRoomNo;
                    console.log('Edit input value set to:', editInput.value);
                }
                
                if (editModal) {
                    openModal(editModal);
                    console.log('Edit modal opened');
                }
                return;
            }

            // Check Out
            if (e.target.closest('[data-checkout]')) {
                e.preventDefault();
                e.stopPropagation();
                
                if (confirm('Lakukan check-out untuk tamu ini?\n\nKamar akan kembali tersedia setelah check-out.')) {
                    processCheckout(reservationId);
                }
                return;
            }
        });
    }

    // ===== EDIT NOMOR KAMAR =====
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('=== EDIT FORM SUBMITTED ===');
            console.log('Editing reservation ID:', editingId);
            
            if (!editingId) {
                alert('Error: Reservation ID tidak ditemukan');
                return;
            }
            
            const formData = new FormData(editForm);
            const newRoomNumber = formData.get('room_number');
            console.log('New room number:', newRoomNumber);
            
            if (!newRoomNumber || newRoomNumber.trim() === '') {
                alert('Nomor kamar tidak boleh kosong!');
                return;
            }
            
            try {
                // ENCODE reservation ID untuk handle karakter # dan spesial lainnya
                const encodedId = encodeURIComponent(editingId);
                console.log('Encoded ID:', encodedId);
                
                const response = await fetch(`/admin/checkout/${encodedId}/room-number`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        room_number: newRoomNumber.trim()
                    })
                });

                console.log('Edit response status:', response.status);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Error response:', errorText);
                    throw new Error('HTTP error! status: ' + response.status);
                }
                
                const result = await response.json();
                console.log('Edit result:', result);
                
                if (result.success) {
                    alert('✓ Nomor kamar berhasil diupdate!');
                    closeModal(editModal);
                    window.location.reload();
                } else {
                    alert('✗ ' + (result.message || 'Gagal mengupdate nomor kamar'));
                }
            } catch (error) {
                console.error('Error updating room number:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        });
    }

    // ===== PROCESS CHECK OUT =====
    async function processCheckout(reservationId) {
        try {
            console.log('=== CHECK OUT ===');
            console.log('Processing check-out for:', reservationId);
            
            // ENCODE reservation ID untuk handle karakter #
            const encodedId = encodeURIComponent(reservationId);
            console.log('Encoded ID for check-out:', encodedId);
            
            const response = await fetch(`/admin/checkout/${encodedId}/checkout`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            });

            console.log('Check-out response status:', response.status);
            
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                
                try {
                    const errorJson = JSON.parse(errorText);
                    alert('✗ ' + (errorJson.message || 'Gagal melakukan check-out'));
                } catch {
                    alert('Error: ' + errorText);
                }
                return;
            }

            const result = await response.json();
            console.log('Check-out result:', result);
            
            if (result.success) {
                alert('✓ Tamu berhasil check-out!\n\nKamar sekarang tersedia untuk reservasi baru.');
                window.location.reload();
            } else {
                alert('✗ ' + (result.message || 'Gagal melakukan check-out'));
            }
        } catch (error) {
            console.error('Error during check-out:', error);
            alert('Terjadi kesalahan saat check-out: ' + error.message);
        }
    }

    // ===== SEARCH =====
    const searchInput = document.getElementById('q');
    if (searchInput) {
        searchInput.addEventListener('input', async (e) => {
            const query = e.target.value.trim();
            
            if (query.length >= 2 || query.length === 0) {
                try {
                    const response = await fetch(`/admin/checkout/search?q=${encodeURIComponent(query)}`);
                    const guests = await response.json();
                    updateTable(guests);
                } catch (error) {
                    console.error('Search error:', error);
                }
            }
        });
    }

    function updateTable(guests) {
        const tbody = document.querySelector('#tbl tbody');
        if (!tbody) return;
        
        if (!guests || guests.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                            <div>
                                <div style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">Tidak ada hasil pencarian</div>
                                <div style="font-size: 14px; color: #94a3b8;">Coba kata kunci lain</div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = guests.map(guest => `
            <tr data-id="${guest.reservation_id}">
                <td class="idcell">${guest.reservation_id}</td>
                <td>${guest.customer_name}</td>
                <td>
                    ${guest.room_booking.room_booking_name}
                    ${guest.room_number ? 
                        `<div style="color:#64748b;font-size:12px;margin-top:4px">No: ${guest.room_number}</div>` : 
                        ''}
                </td>
                <td>${new Date(guest.check_in).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                <td>${new Date(guest.check_out).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                <td>${guest.duration}</td>
                <td class="money">Rp ${guest.total_price.toLocaleString('id-ID')}</td>
                <td>
                    <div class="actions">
                        <button class="icon-btn b-yellow" data-edit title="Edit nomor kamar">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                            </svg>
                        </button>
                        <button class="icon-btn b-red" data-checkout title="Check Out">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 12H3"/>
                                <path d="m9 18-6-6 6-6"/>
                                <path d="M21 3v18"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    console.log('=== CHECKOUT SCRIPT LOADED ===');
    console.log('CSRF Token:', CSRF_TOKEN);
    console.log('Edit Form:', editForm ? 'Found' : 'Not found');
    console.log('Table:', tableBody ? 'Found' : 'Not found');
</script>