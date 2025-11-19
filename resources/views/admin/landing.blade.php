<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Landing Page | Hotel Mukti Jaya</title>
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
      h1 {
        font-size: 26px;
        font-weight: 800;
      }
      .subtitle {
        color: #64748b;
        margin: 8px 0 18px;
        font-size: 13.5px;
      }
      h2 {
        font-size: 16px;
        margin: 10px 0 14px;
      }

      /* Cards */
      .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
      }
      .card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: 0.2s;
      }
      .card:hover {
        transform: translateY(-2px);
      }
      .imgbox {
        position: relative;
        background: #f3f4f6;
      }
      .imgbox img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
      }
      .imgbox .del-img {
        position: absolute;
        top: 8px;
        right: 8px;
        opacity: 0;
        background: rgba(239, 68, 68, 0.92);
        color: #fff;
        border: 0;
        border-radius: 8px;
        padding: 4px 8px;
        cursor: pointer;
        font-size: 12px;
        transition: 0.2s;
        font-weight: 500;
      }
      .imgbox:hover .del-img {
        opacity: 1;
      }
      .card-b {
        padding: 12px 14px;
      }
      .card-b h3 {
        font-size: 14px;
        margin-bottom: 6px;
        font-weight: 600;
      }
      .card-b p {
        font-size: 13px;
        margin-bottom: 4px;
        color: #334155;
      }
      .price {
        font-weight: 600;
        font-size: 14px;
        margin-top: 6px;
        color: var(--brand);
      }

      .btns {
        display: flex;
        gap: 8px;
        margin-top: 10px;
      }
      .btn {
        flex: 1;
        height: 30px;
        border: 0;
        border-radius: 10px;
        font-weight: 500;
        cursor: pointer;
        font-size: 13px;
        padding: 0 10px;
        transition: 0.2s;
      }
      .btn-edit {
        background: #f3f4f6;
        color: #111;
      }
      .btn-edit:hover {
        background: #e5e7eb;
      }
      .btn-del {
        background: #fee2e2;
        color: #b91c1c;
      }
      .btn-del:hover {
        background: #fecaca;
      }

      .add-card {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        padding: 30px;
        background: #fff;
        color: #475569;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
        text-align: center;
        text-decoration: none;
      }
      .add-card:hover {
        background: #f9fafb;
        border-color: var(--brand);
      }

      /* Modal Styles */
      .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s;
      }
      
      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }
      
      .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      .modal-content {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideUp 0.3s;
      }
      
      @keyframes slideUp {
        from {
          transform: translateY(50px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }
      
      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }
      
      .modal-header h3 {
        font-size: 18px;
        font-weight: 700;
      }
      
      .close-modal {
        background: #f3f4f6;
        border: 0;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 20px;
        line-height: 1;
        transition: 0.2s;
      }
      
      .close-modal:hover {
        background: #e5e7eb;
      }
      
      .form-group {
        margin-bottom: 16px;
      }
      
      .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 14px;
        color: #374151;
      }
      
      .form-group input,
      .form-group select,
      .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        font-family: "Geist", sans-serif;
      }
      
      .form-group input:focus,
      .form-group select:focus,
      .form-group textarea:focus {
        outline: none;
        border-color: var(--brand);
      }
      
      .form-group textarea {
        resize: vertical;
        min-height: 80px;
      }
      
      .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
      }
      
      .btn-primary {
        flex: 1;
        padding: 12px;
        background: var(--brand);
        color: #fff;
        border: 0;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
      }
      
      .btn-primary:hover {
        background: var(--brand-2);
      }
      
      .btn-secondary {
        flex: 1;
        padding: 12px;
        background: #f3f4f6;
        color: #374151;
        border: 0;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
      }
      
      .btn-secondary:hover {
        background: #e5e7eb;
      }
      
      .btn-danger {
        flex: 1;
        padding: 12px;
        background: #ef4444;
        color: #fff;
        border: 0;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
      }
      
      .btn-danger:hover {
        background: #dc2626;
      }

      .image-preview {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
      }
      
      .image-preview img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--border);
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

        <nav class="menu">
          <a href="{{ route('admin.dashboard') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="7" height="7" rx="2" />
              <rect x="14" y="3" width="7" height="7" rx="2" />
              <rect x="14" y="14" width="7" height="7" rx="2" />
              <rect x="3" y="14" width="7" height="7" rx="2" />
            </svg>Dashboard
          </a>
          <a href="{{ route('admin.checkin') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 12h12" />
              <path d="m15 18 6-6-6-6" />
              <path d="M3 3v18" />
            </svg>Reservasi
          </a>
          <a href="{{ route('admin.checkout') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 12H3" />
              <path d="m9 18-6-6 6-6" />
              <path d="M21 3v18" />
            </svg>Tamu Menginap
          </a>
          <a class="active" href="{{ route('admin.landing') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <line x1="2" y1="12" x2="22" y2="12" />
              <path d="M12 2a15.3 15.3 0 0 1 0 20a15.3 15.3 0 0 1 0-20z" />
            </svg>Landing Page
          </a>
        </nav>

        <div class="logout" onclick="handleLogout()">Logout</div>
      </aside>

      <!-- Main -->
      <main>
        <h1>Landing Page</h1>
        <p class="subtitle">
          Pada halaman ini, admin dapat melakukan tambah, edit, dan hapus data kamar yang akan ditampilkan pada<br> 
          halaman utama website Hotel Mukti Jaya agar pengunjung selalu melihat data terbaru.
        </p>
        <h2>Manajemen Kamar</h2>

        <div class="grid" id="grid">
          @foreach($rooms as $room)
          <div class="card">
            <div class="imgbox">
              @if($room->images->count() > 1)
                <img src="{{ asset('images/rooms/' . $room->images[1]->image_path) }}" 
                     alt="{{ $room->room_name }}"
                     data-room-id="{{ $room->room_id }}">
              @elseif($room->images->count() > 0)
                <img src="{{ asset('images/rooms/' . $room->images->first()->image_path) }}" 
                     alt="{{ $room->room_name }}"
                     data-room-id="{{ $room->room_id }}">
              @else
                <img src="{{ asset('images/rooms/default-room.jpg') }}" 
                     alt="{{ $room->room_name }}"
                     data-room-id="{{ $room->room_id }}">
              @endif
              <button class="del-img" onclick="removeImage({{ $room->room_id }})">Hapus Foto</button>
            </div>
            <div class="card-b">
              <h3>{{ $room->room_name }}</h3>
              <p>👥 {{ $room->room_capacity ?? 2 }} Orang</p>
              <div class="price">Rp. {{ number_format($room->room_price, 0, ',', '.') }}/malam</div>
              <div class="btns">
                <a href="{{ route('admin.rooms.edit', $room->room_id) }}" class="btn btn-edit" style="display: flex; align-items: center; justify-content: center; text-decoration: none;">Edit</a>
                <button class="btn btn-del" onclick="deleteRoom({{ $room->room_id }})">Delete</button>
              </div>
            </div>
          </div>
          @endforeach

          <a href="{{ route('admin.rooms.create') }}" class="add-card">
            <div style="font-size:22px">＋</div>
            Tambah Kamar Baru<br><small>Klik untuk menambahkan kamar baru</small>
          </a>
        </div>
      </main>
    </div>

    <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Logout Handler
      function handleLogout() {
        if (confirm('Yakin ingin logout?')) {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = "{{ route('admin.logout') }}";
          const csrfInput = document.createElement('input');
          csrfInput.type = 'hidden';
          csrfInput.name = '_token';
          csrfInput.value = csrfToken;
          form.appendChild(csrfInput);
          document.body.appendChild(form);
          form.submit();
        }
      }

      // Delete Room
      function deleteRoom(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kamar ini?')) {
          fetch(`/admin/rooms/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Kamar berhasil dihapus!');
              location.reload();
            } else {
              alert('Gagal menghapus kamar: ' + (data.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus kamar');
          });
        }
      }

      // Remove Image
      function removeImage(id) {
        if (confirm('Apakah Anda yakin ingin menghapus foto kamar ini?')) {
          fetch(`/admin/rooms/${id}/remove-image`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const img = document.querySelector(`[data-room-id="${id}"]`);
              if (img) {
                img.src = '/images/rooms/default-room.jpg';
              }
              alert('Foto berhasil dihapus!');
            } else {
              alert('Gagal menghapus foto: ' + (data.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto');
          });
        }
      }
    </script>
  </body>
</html>