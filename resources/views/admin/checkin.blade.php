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
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 12px;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        .icon-btn:hover {
            transform: translateY(-3px) scale(1.08);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }
        .icon-btn:active {
            transform: translateY(-1px) scale(1.05);
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
      .dialog-f .btn {
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
      }
      .dialog-f .btn::before {
          content: '';
          position: absolute;
          top: 0; left: 0; right: 0; bottom: 0;
          background: rgba(0,0,0,0.15);
          opacity: 0;
          transition: opacity 0.25s ease;
          border-radius: 10px;
      }
      .dialog-f .btn:hover::before {
          opacity: 1;
      }

      .dialog-f .btn:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      }
      .dialog-f .btn-primary:hover {
          background: #0a3d25 !important; 
      }
      .dialog-f .btn-ghost:hover {
          background: #e5e7eb !important;
          border-color: #d1d5db !important;
          color: #111 !important;
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
                    <div class="meta"><b>Hotel Mukti Jaya</b><br><small>Admin Panel</small></div>
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

            <!-- Main Content -->
            <main>
                <h1 class="page-title">Reservasi</h1>
                <p class="subtitle">Pada halaman ini, admin dapat melakukan pengelolaan data reservasi, seperti menambah, mengedit, dan<br>
                  menghapus data tamu yang melakukan check-in.</p>

                <div class="toolbar">
                    <button class="btn btn-primary" id="btnOpenAdd">Tambah Reservasi</button>
                    <div class="search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input type="text" id="q" placeholder="Cari nama / kamar / email..." />
                    </div>
                </div>

                <section class="card">
                    <div class="card-b">
                        <div class="table-wrap">
                            <table id="tbl">
                                <thead>
                                    <tr>
                                        <th style="width:15%">ID</th>
                                        <th style="width:18%">Nama</th>
                                        <th style="width:16%">Tipe Kamar</th>
                                        <th style="width:12%">Check In</th>
                                        <th style="width:12%">Check Out</th>
                                        <th style="width:8%">Malam</th>
                                        <th style="width:14%">Total</th>
                                        <th style="width:12%;text-align:right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                    <tr data-id="{{ $reservation->reservation_id }}" data-room-booking-id="{{ $reservation->room_booking_id }}">
                                        <td class="idcell">{{ $reservation->reservation_id }}</td>
                                        <td>{{ $reservation->customer_name }}</td>
                                        <td>
                                            {{ $reservation->roomBooking->room_booking_name }}
                                            @if($reservation->room_number)
                                                <div style="color:#22c55e;font-weight:600;font-size:13px;margin-top:4px">
                                                    Kamar: {{ $reservation->room_number }}
                                                </div>
                                            @else
                                                <div style="color:#f59e0b;font-size:12px;margin-top:4px;font-style:italic">
                                                    Belum dialokasikan
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $reservation->check_in->format('d M Y') }}</td>
                                        <td>{{ $reservation->check_out->format('d M Y') }}</td>
                                        <td>{{ $reservation->duration }}</td>
                                        <td class="money">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="actions">
                                                <!-- Edit / Assign Kamar -->
                                                <button class="icon-btn b-yellow" data-edit title="{{ $reservation->room_number ? 'Edit' : 'Assign' }} nomor kamar">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/>
                                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                                    </svg>
                                                </button>

                                                <!-- Check In (aktif hanya kalau sudah ada kamar) -->
                                                @if($reservation->room_number)
                                                    <button class="icon-btn b-green" data-checkin title="Check In">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path d="M9 12h12"/><path d="m15 18 6-6-6-6"/><path d="M3 3v18"/>
                                                        </svg>
                                                    </button>
                                                @else
                                                    <button class="icon-btn b-green" disabled title="Assign kamar dulu">
                                                        <svg opacity="0.4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path d="M9 12h12"/><path d="m15 18 6-6-6-6"/><path d="M3 3v18"/>
                                                        </svg>
                                                    </button>
                                                @endif

                                                <!-- Hapus -->
                                                <button class="icon-btn b-red" data-delete title="Hapus">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                        <path d="M10 11v6"/><path d="M14 11v6"/>
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

        <!-- Modal Tambah Reservasi Manual -->
        <div class="modal" id="addModal">
            <div class="dialog">
                <div class="dialog-h">Tambah Reservasi</div>
                <form id="addForm">
                    @csrf
                    <div class="dialog-b">
                        <div class="row">
                            <div class="field">
                                <label>Tipe Kamar</label>
                                <select name="room_booking_id" required>
                                    <option value="">Pilih Tipe Kamar</option>
                                    @foreach($availableRooms as $room)
                                        <option value="{{ $room['id'] }}" data-price="{{ $room['price'] }}">
                                            {{ $room['name'] }} - Rp {{ number_format($room['price'], 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="field"><label>Check In</label><input type="date" name="check_in" required></div>
                            <div class="field"><label>Check Out</label><input type="date" name="check_out" required></div>
                        </div>
                        <div class="row">
                            <div class="field"><label>Nama Tamu</label><input type="text" name="customer_name" required></div>
                        </div>
                        <div class="row">
                            <div class="field"><label>Email</label><input type="email" name="customer_email" required></div>
                            <div class="field"><label>No. HP</label><input type="tel" name="customer_phone" required></div>
                        </div>
                        <div class="row">
                            <div class="field">
                                <label>Nomor Kamar</label>
                                <select name="room_number" required style="height:42px;">
                                    <option value="">Pilih tipe kamar dulu</option>
                                </select>
                            </div>
                            <div class="field"><label>Catatan</label><input type="text" name="special_request"></div>
                        </div>
                    </div>
                    <div class="dialog-f">
                        <button type="button" class="btn btn-ghost" data-close>Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Reservasi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit / Assign Nomor Kamar -->
        <div class="modal" id="editModal">
            <div class="dialog slim">
                <div class="dialog-h">Edit Nomor Kamar</div>
                <form id="editForm">
                    @csrf
                    <div class="dialog-b">
                        <div class="field">
                            <label>Nomor Kamar</label>
                            <select name="room_number" required style="height:42px;">
                                <option value="">Memuat kamar tersedia...</option>
                            </select>
                            <small style="color:#64748b;margin-top:4px;display:block">
                                Kamar tersedia untuk: <strong id="editRoomType">-</strong>
                            </small>
                        </div>
                    </div>
                    <div class="dialog-f">
                        <button type="button" class="btn btn-ghost" data-close>Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    <script>
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let editingId = null;

      // === MODAL HELPER ===
      const openModal = (modal) => {
          modal?.classList.add('open');
          document.documentElement.style.overflow = 'hidden';
      };
      const closeModal = (modal) => {
          modal?.classList.remove('open');
          document.documentElement.style.overflow = '';
      };

      // Klik backdrop = tutup modal
      document.querySelectorAll('.modal').forEach(m => {
          m.addEventListener('click', e => e.target === m && closeModal(m));
      });
      document.querySelectorAll('[data-close]').forEach(btn => {
          btn.addEventListener('click', () => closeModal(btn.closest('.modal')));
      });

      const addModal  = document.getElementById('addModal');
      const editModal = document.getElementById('editModal');

      // === BUKA MODAL TAMBAH ===
      document.getElementById('btnOpenAdd')?.addEventListener('click', () => {
          const today = new Date().toISOString().split('T')[0];
          const tomorrow = new Date();
          tomorrow.setDate(tomorrow.getDate() + 1);

          document.querySelector('#addForm [name="check_in"]').value = today;
          document.querySelector('#addForm [name="check_out"]').value = tomorrow.toISOString().split('T')[0];
          openModal(addModal);
      });

      // === LOAD NOMOR KAMAR DI MODAL TAMBAH ===
      document.querySelector('#addForm select[name="room_booking_id"]')?.addEventListener('change', async function () {
          const id = this.value;
          const selectNum = document.querySelector('#addForm select[name="room_number"]');

          if (!id) {
              selectNum.innerHTML = '<option value="">Pilih tipe kamar dulu</option>';
              return;
          }

          const res = await fetch(`/admin/checkin/${id}/available-numbers`);
          const data = await res.json();

          selectNum.innerHTML = '<option value="">Pilih Nomor Kamar</option>';
          data.available_numbers?.forEach(n => {
              const opt = document.createElement('option');
              opt.value = n;
              opt.textContent = n;
              selectNum.appendChild(opt);
          });
      });

      // === AKSI TOMBOL DI TABEL (INI YANG DIPERBAIKI TOTAL) ===
      document.querySelector('#tbl tbody')?.addEventListener('click', async function (e) {
          // Cari button yang diklik (bukan svg atau path)
          const button = e.target.closest('button[data-edit], button[data-checkin], button[data-delete]');
          if (!button) return;

          e.stopPropagation(); // Penting biar ga kena event lain

          const tr = button.closest('tr');
          const reservationId = tr.dataset.id;
          const roomBookingId = tr.dataset.roomBookingId;

          // 1. EDIT / ASSIGN KAMAR
          if (button.hasAttribute('data-edit')) {
              editingId = reservationId;

              const roomTypeName = tr.cells[2].firstChild.textContent.trim();
              document.getElementById('editRoomType').textContent = roomTypeName;

              const select = document.querySelector('#editForm select[name="room_number"]');
              select.innerHTML = '<option value="">Memuat...</option>';
              select.disabled = true;

              try {
                  const res = await fetch(`/admin/checkin/${roomBookingId}/available-numbers`);
                  const data = await res.json();

                  select.innerHTML = '<option value="">Pilih Nomor Kamar</option>';
                  const currentRoom = tr.cells[2].querySelector('div')?.textContent.replace('Kamar:', '').trim() || '';

                  data.available_numbers?.forEach(num => {
                      const opt = document.createElement('option');
                      opt.value = num;
                      opt.textContent = num;
                      if (num === currentRoom) opt.selected = true;
                      select.appendChild(opt);
                  });

                  select.disabled = false;
              } catch (err) {
                  select.innerHTML = '<option value="">Gagal memuat kamar</option>';
              }

              openModal(editModal);
              return;
          }

          // 2. CHECK-IN
          if (button.hasAttribute('data-checkin')) {
              if (!confirm('Check-in tamu ini sekarang?')) return;

              try {
                  const res = await fetch(`/admin/checkin/${encodeURIComponent(reservationId)}/checkin`, {
                      method: 'POST',
                      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
                  });
                  const json = await res.json();
                  alert(json.success ? 'Check-in berhasil!' : 'Gagal: ' + (json.message || 'Error'));
                  if (json.success) location.reload();
              } catch (err) {
                  alert('Error: ' + err.message);
              }
              return;
          }

          // 3. HAPUS
          if (button.hasAttribute('data-delete')) {
              if (!confirm('Yakin hapus reservasi ini? Data hilang permanen!')) return;

              try {
                  const res = await fetch(`/admin/checkin/${encodeURIComponent(reservationId)}/delete`, {
                      method: 'POST',
                      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
                  });
                  const json = await res.json();
                  alert(json.success ? 'Reservasi dihapus!' : 'Gagal: ' + (json.message || 'Error'));
                  if (json.success) location.reload();
              } catch (err) {
                  alert('Error: ' + err.message);
              }
          }
      });

      // === SUBMIT EDIT NOMOR KAMAR ===
      document.getElementById('editForm')?.addEventListener('submit', async function (e) {
          e.preventDefault();
          const roomNumber = this.querySelector('select[name="room_number"]').value;
          if (!roomNumber) return alert('Pilih nomor kamar dulu!');

          try {
              const res = await fetch(`/admin/checkin/${encodeURIComponent(editingId)}/room-number`, {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': CSRF_TOKEN,
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({ room_number: roomNumber })
              });
              const json = await res.json();

              alert(json.success ? 'Nomor kamar berhasil diupdate!' : 'Gagal: ' + (json.message || 'Error'));
              if (json.success) {
                  closeModal(editModal);
                  location.reload();
              }
          } catch (err) {
              alert('Error: ' + err.message);
          }
      });

      console.log('FIXED 100% — Semua tombol bisa diklik!');

      // === SUBMIT TAMBAH RESERVASI ===
      document.getElementById('addForm')?.addEventListener('submit', async function (e) {
          e.preventDefault();
          
          const formData = new FormData(this);

          try {
              const res = await fetch('/admin/checkin', {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': CSRF_TOKEN,
                      // JANGAN PAKE Content-Type: application/json → biar FormData jalan
                  },
                  body: formData
              });

              const json = await res.json();

              if (json.success) {
                  alert('Sukses! ' + json.message + ' → ' + json.reservation_id);
                  closeModal(addModal);
                  location.reload();
              } else {
                  alert('Gagal: ' + json.message);
              }
          } catch (err) {
              alert('Error koneksi: ' + err.message);
          }
      });
  </script>