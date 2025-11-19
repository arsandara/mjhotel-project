<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reservasi | Hotel Mukti Jaya</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <style>
      /* CSS tetap sama seperti sebelumnya */
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
        --green: #22c55e;
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
      .btn {
        height: 40px;
        border: 0;
        border-radius: 10px;
        padding: 0 16px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--brand);
        color: #fff;
    }

    .btn-primary:hover {
        opacity: 0.95;
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
      }
      .b-yellow {
        background: #f59e0b;
      }
      .b-green {
        background: #22c55e;
      }
      .b-red {
        background: #ef4444;
      }

      /* Pager */
      .pager {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
        margin: 10px 6px 6px;
        flex-wrap: wrap;
      }
      .pager button {
        min-width: 30px;
        height: 30px;
        border: 1px solid var(--border);
        background: #fff;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 800;
        font-size: 13px;
      }
      .pager .is-active {
        background: var(--brand-2-20);
        border-color: rgba(6, 82, 56, 0.35);
      }

      /* ====== Modal (shared) ====== */
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
        width: min(880px, 95vw);
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
      .row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
      }
      .field {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
      }
      label {
        font-size: 13px;
        color: #334155;
      }
      input[type="text"],
      input[type="email"],
      input[type="date"],
      input[type="tel"],
      select,
      textarea {
        height: 42px;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0 12px;
        font-family: "Geist", sans-serif;
        font-size: 14px;
        background: #fff;
      }
      textarea {
        height: 80px;
        padding: 10px 12px;
        resize: vertical;
      }
      .dialog-f {
        padding: 14px 18px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 10px;
        justify-content: flex-end;
      }
      .btn-ghost {
        background: #fff;
        border: 1px solid var(--border);
        color: #111;
      }

      /* Modal kecil (edit nomor kamar) */
      .dialog.slim {
        width: min(520px, 92vw);
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
                <a href="{{ route('admin.checkin') }}" class="active">
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
            <h1 class="page-title">Reservasi</h1>
            <p class="subtitle">
                Pada halaman ini, admin dapat melakukan pengelolaan data reservasi, seperti menambah, mengedit<br>
                dan menghapus data tamu yang melakukan reservasi.
            </p>

            <div class="toolbar">
                <button class="btn btn-primary" id="btnOpenAdd">
                    Tambah Reservasi
                </button>
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
                                @foreach($reservations as $reservation)
                                <tr data-id="{{ $reservation->reservation_id }}">
                                    <td class="idcell">{{ $reservation->reservation_id }}</td>
                                    <td>{{ $reservation->customer_name }}</td>
                                    <td>
                                        {{ $reservation->roomBooking->room_booking_name }}
                                        @if($reservation->room_number)
                                            <div style="color:#64748b;font-size:12px;margin-top:4px">No: {{ $reservation->room_number }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $reservation->check_in->format('d M Y') }}</td>
                                    <td>{{ $reservation->check_out->format('d M Y') }}</td>
                                    <td>{{ $reservation->duration }}</td>
                                    <td class="money">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="actions">
                                            <button class="icon-btn b-yellow" data-edit title="Edit nomor kamar">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                            </button>
                                            <!-- UBAH: data-checkout MENJADI data-checkin -->
                                            <button class="icon-btn b-green" data-checkin title="Check In">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M9 12h12"/><path d="m15 18 6-6-6-6"/><path d="M3 3v18"/>
                                                </svg>
                                            </button>
                                            <button class="icon-btn b-red" data-delete title="Hapus">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                    <path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modals -->
    <div class="modal" id="addModal" aria-hidden="true">
        <div class="dialog">
            <div class="dialog-h">Tambah Reservasi</div>
            <form id="addForm">
                @csrf
                <div class="dialog-b">
                    <div class="row">
                        <div class="field">
                            <label>Kamar</label>
                            <select name="room_booking_id" required>
                                <option value="">Pilih Kamar</option>
                                @foreach($availableRooms as $room)
                                    <option value="{{ $room['id'] }}" data-price="{{ $room['price'] }}">
                                        {{ $room['name'] }} - Rp {{ number_format($room['price'], 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label>Check In</label>
                            <input type="date" name="check_in" required />
                        </div>
                        <div class="field">
                            <label>Check Out</label>
                            <input type="date" name="check_out" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label>Nama Lengkap*</label>
                            <input type="text" name="customer_name" placeholder="Nama tamu" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label>Email*</label>
                            <input type="email" name="customer_email" placeholder="email@contoh.com" required />
                        </div>
                        <div class="field">
                            <label>No. HP*</label>
                            <input type="tel" name="customer_phone" placeholder="08xxxx" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label>Nomor Kamar*</label>
                            <input type="text" name="room_number" placeholder="cth: 221" required />
                        </div>
                        <div class="field">
                            <label>Catatan (opsional)</label>
                            <input type="text" name="special_request" placeholder="do not disturb" />
                        </div>
                    </div>
                </div>
                <div class="dialog-f">
                    <button type="button" class="btn btn-ghost" data-close>Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Reservasi</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="editModal" aria-hidden="true">
        <div class="dialog slim">
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
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!CSRF_TOKEN) {
        console.error('CSRF token not found!');
    }

    let editingId = null;

    // ========== MODAL FUNCTIONS ==========
    const openModal = (modal) => {
        if (modal) {
            modal.classList.add('open');
            document.documentElement.style.overflow = 'hidden';
        }
    };

    const closeModal = (modal) => {
        if (modal) {
            modal.classList.remove('open');
            document.documentElement.style.overflow = '';
        }
    };

    // Event listeners untuk modal backdrop
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');

    if (addModal) {
        addModal.addEventListener('click', (e) => {
            if (e.target === addModal) closeModal(addModal);
        });
    }

    if (editModal) {
        editModal.addEventListener('click', (e) => {
            if (e.target === editModal) closeModal(editModal);
        });
    }

    // Close buttons
    document.querySelectorAll('[data-close]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const modal = btn.closest('.modal');
            if (modal) closeModal(modal);
        });
    });

    // ========== OPEN ADD MODAL ==========
    const btnOpenAdd = document.getElementById('btnOpenAdd');
    if (btnOpenAdd) {
        btnOpenAdd.addEventListener('click', (e) => {
            e.preventDefault();
            const form = document.getElementById('addForm');
            if (form) {
                const today = new Date().toISOString().split('T')[0];
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                const checkInInput = form.querySelector('[name="check_in"]');
                const checkOutInput = form.querySelector('[name="check_out"]');
                
                if (checkInInput) checkInInput.value = today;
                if (checkOutInput) checkOutInput.value = tomorrow.toISOString().split('T')[0];
                
                openModal(addModal);
            }
        });
    }

    // ========== ROOM SELECTION - GET AVAILABLE NUMBERS ==========
    const roomSelect = document.querySelector('select[name="room_booking_id"]');
    const roomNumberInput = document.querySelector('input[name="room_number"]');

    if (roomSelect && roomNumberInput) {
        roomSelect.addEventListener('change', async function() {
            const roomId = this.value;
            console.log('Room selected:', roomId);
            
            if (!roomId) {
                roomNumberInput.placeholder = 'Pilih kamar terlebih dahulu';
                roomNumberInput.disabled = true;
                return;
            }
            
            try {
                const response = await fetch(`/admin/checkin/${roomId}/available-numbers`);
                const result = await response.json();
                console.log('Available numbers:', result);
                
                if (result.available_numbers && result.available_numbers.length > 0) {
                    roomNumberInput.placeholder = `Tersedia: ${result.available_numbers.join(', ')}`;
                    roomNumberInput.disabled = false;
                    
                    // Create datalist
                    let datalistId = 'room-numbers-list';
                    let existingDatalist = document.getElementById(datalistId);
                    if (existingDatalist) {
                        existingDatalist.remove();
                    }
                    
                    const datalist = document.createElement('datalist');
                    datalist.id = datalistId;
                    result.available_numbers.forEach(num => {
                        const option = document.createElement('option');
                        option.value = num;
                        datalist.appendChild(option);
                    });
                    
                    roomNumberInput.setAttribute('list', datalistId);
                    document.body.appendChild(datalist);
                } else {
                    roomNumberInput.placeholder = 'Semua kamar sudah terpakai';
                    roomNumberInput.disabled = true;
                }
            } catch (error) {
                console.error('Error loading room numbers:', error);
                roomNumberInput.placeholder = 'Error memuat nomor kamar';
            }
        });
    }

    // ========== SUBMIT ADD RESERVATION FORM ==========
    const addForm = document.getElementById('addForm');
    if (addForm) {
        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('=== ADD FORM SUBMITTED ===');
            
            const formData = new FormData(addForm);
            const roomSelect = addForm.querySelector('select[name="room_booking_id"]');
            const selectedOption = roomSelect?.options[roomSelect.selectedIndex];
            const roomPrice = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) : 0;
            
            const checkIn = new Date(formData.get('check_in'));
            const checkOut = new Date(formData.get('check_out'));
            const duration = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const totalPrice = roomPrice * duration;
            
            const data = {
                room_booking_id: formData.get('room_booking_id'),
                customer_name: formData.get('customer_name'),
                customer_email: formData.get('customer_email'),
                customer_phone: formData.get('customer_phone'),
                check_in: formData.get('check_in'),
                check_out: formData.get('check_out'),
                room_number: formData.get('room_number'),
                special_request: formData.get('special_request') || null,
                capacity: '2 orang',
                room_price: roomPrice,
                total_price: totalPrice,
                duration: duration
            };
            
            console.log('Data to send:', data);
            
            try {
                const response = await fetch('/admin/checkin', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                console.log('Response status:', response.status);
                const result = await response.json();
                console.log('Response result:', result);
                
                if (result.success) {
                    alert('✓ Reservasi berhasil dibuat!');
                    closeModal(addModal);
                    window.location.reload();
                } else {
                    alert('✗ ' + (result.message || 'Gagal membuat reservasi'));
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        });
    }

    // ========== TABLE ACTIONS - FIXED ==========
    const tableBody = document.getElementById('tbl');
    if (tableBody) {
        tableBody.addEventListener('click', async (e) => {
            const tr = e.target.closest('tr[data-id]');
            if (!tr) return;
            
            const reservationId = tr.dataset.id;
            console.log('Action clicked for reservation:', reservationId);

            // EDIT ROOM NUMBER
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

            // CHECK IN
            if (e.target.closest('[data-checkin]')) {
                e.preventDefault();
                e.stopPropagation();
                
                if (confirm('Lakukan check-in untuk reservasi ini?\n\nTamu akan pindah ke halaman Tamu Menginap.')) {
                    await checkinReservation(reservationId);
                }
                return;
            }

            // DELETE
            if (e.target.closest('[data-delete]')) {
                e.preventDefault();
                e.stopPropagation();
                
                if (confirm('Hapus reservasi ini?\n\nData akan dihapus permanen.')) {
                    await deleteReservation(reservationId);
                }
                return;
            }
        });
    }

    // ========== SUBMIT EDIT FORM - FIXED ==========
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
                
                const response = await fetch(`/admin/checkin/${encodedId}/room-number`, {
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

    // ========== CHECK IN FUNCTION - FIXED ==========
    async function checkinReservation(reservationId) {
        try {
            console.log('=== CHECK IN ===');
            console.log('Processing check-in for:', reservationId);
            
            // ENCODE reservation ID untuk handle karakter #
            const encodedId = encodeURIComponent(reservationId);
            console.log('Encoded ID for check-in:', encodedId);
            
            // PERBAIKAN: Gunakan POST method (bukan PATCH)
            const response = await fetch(`/admin/checkin/${encodedId}/checkin`, {
                method: 'POST', // UBAH INI dari PATCH ke POST
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                // HAPUS body karena tidak diperlukan untuk check-in
                // body: JSON.stringify({}) // Tidak perlu body kosong
            });

            console.log('Check-in response status:', response.status);
            
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                
                // Coba parse error message
                try {
                    const errorJson = JSON.parse(errorText);
                    alert('✗ ' + (errorJson.message || 'Gagal melakukan check-in'));
                } catch {
                    alert('Error: ' + errorText);
                }
                return;
            }

            const result = await response.json();
            console.log('Check-in result:', result);
            
            if (result.success) {
                alert('✓ Tamu berhasil check-in!\n\nData pindah ke halaman Tamu Menginap.');
                window.location.reload();
            } else {
                alert('✗ ' + (result.message || 'Gagal melakukan check-in'));
            }
        } catch (error) {
            console.error('Error during check-in:', error);
            alert('Terjadi kesalahan saat check-in: ' + error.message);
        }
    }

    // ========== DELETE FUNCTION - FIXED ==========
    async function deleteReservation(reservationId) {
        try {
            console.log('=== DELETE ===');
            console.log('Deleting reservation:', reservationId);
            
            // ENCODE reservation ID untuk handle karakter #
            const encodedId = encodeURIComponent(reservationId);
            console.log('Encoded ID for delete:', encodedId);
            
            const response = await fetch(`/admin/checkin/${encodedId}/delete`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                }
            });

            console.log('Delete response status:', response.status);
            
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                
                try {
                    const errorJson = JSON.parse(errorText);
                    alert('✗ ' + (errorJson.message || 'Gagal menghapus reservasi'));
                } catch {
                    alert('Error: ' + errorText);
                }
                return;
            }

            const result = await response.json();
            console.log('Delete result:', result);
            
            if (result.success) {
                alert('✓ Reservasi berhasil dihapus!');
                window.location.reload();
            } else {
                alert('✗ ' + (result.message || 'Gagal menghapus reservasi'));
            }
        } catch (error) {
            console.error('Error during delete:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // ========== SEARCH ==========
    const searchInput = document.getElementById('q');
    if (searchInput) {
        searchInput.addEventListener('input', async (e) => {
            const query = e.target.value.trim();
            
            if (query.length >= 2 || query.length === 0) {
                try {
                    const response = await fetch(`/admin/checkin/search?q=${encodeURIComponent(query)}`);
                    const reservations = await response.json();
                    updateTable(reservations);
                } catch (error) {
                    console.error('Search error:', error);
                }
            }
        });
    }

    function updateTable(reservations) {
        const tbody = document.querySelector('#tbl tbody');
        if (!tbody) return;
        
        if (!reservations || reservations.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                        Tidak ada hasil pencarian
                    </td>
                </tr>
            `;
            return;
        }
        
        tbody.innerHTML = reservations.map(reservation => `
            <tr data-id="${reservation.reservation_id}">
                <td class="idcell">${reservation.reservation_id}</td>
                <td>${reservation.customer_name}</td>
                <td>
                    ${reservation.room_booking.room_booking_name}
                    ${reservation.room_number ? 
                        `<div style="color:#64748b;font-size:12px;margin-top:4px">No: ${reservation.room_number}</div>` : 
                        ''}
                </td>
                <td>${new Date(reservation.check_in).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                <td>${new Date(reservation.check_out).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                <td>${reservation.duration}</td>
                <td class="money">Rp ${reservation.total_price.toLocaleString('id-ID')}</td>
                <td>
                    <div class="actions">
                        <button class="icon-btn b-yellow" data-edit title="Edit nomor kamar">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        </button>
                        <button class="icon-btn b-green" data-checkin title="Check In">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12h12"/><path d="m15 18 6-6-6-6"/><path d="M3 3v18"/>
                            </svg>
                        </button>
                        <button class="icon-btn b-red" data-delete title="Hapus">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                <path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    console.log('=== SCRIPT LOADED ===');
    console.log('CSRF Token:', CSRF_TOKEN);
    console.log('Add Form:', addForm ? 'Found' : 'Not found');
    console.log('Edit Form:', editForm ? 'Found' : 'Not found');
    console.log('Table:', tableBody ? 'Found' : 'Not found');
    </script>