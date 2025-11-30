<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Kamar | Hotel Mukti Jaya</title>
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

      /* Sidebar (konsisten) */
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
        object-fit: contain;
        border-radius: 6px;
      }
      .brand .meta b {
        font-size: 16px;
        font-weight: 700;
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
        max-width: 1400px;
        width: 100%;
      }

      /* Header: tombol back hijau + judul */
      .page-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
      }
      .page-header h1 {
        font-size: 26px;
        font-weight: 700;
      }
      .btn-back {
        width: 44px;
        height: 44px;
        display: grid;
        place-items: center;
        background: var(--brand);
        color: #fff;
        border: 0;
        border-radius: 14px;
        cursor: pointer;
        transition: 0.2s;
      }
      .btn-back:hover {
        filter: brightness(0.95);
      }
      .btn-back svg {
        width: 20px;
        height: 20px;
        stroke: #fff;
        stroke-width: 2.2;
      }
      .subtitle {
        color: #64748b;
        margin-bottom: 16px;
        font-size: 13.5px;
      }

      .card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
        max-width: 1000px; 
        width: 100%;
      }
      .card-b {
        padding: 18px;
      }

      .form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        max-width: 100%;
      }
      .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      label {
        font-size: 13px;
        color: #334155;
        font-weight: 600;
      }
      input[type="text"],
      input[type="number"],
      select,
      textarea {
        height: 44px;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0 12px;
        background: #fff;
        font-size: 14px;
        font-family: "Geist", sans-serif;
        outline: none;
      }
      textarea {
        height: auto;
        min-height: 110px;
        padding: 10px 12px;
        line-height: 1.5;
        resize: vertical;
      }

      .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
      }
      @media (max-width: 720px) {
        .two-col {
          grid-template-columns: 1fr;
        }
      }

      /* Gallery 5 slot */
      .gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
      }
      .slot {
        width: 160px;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px dashed #cbd5e1;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        cursor: pointer;
      }
      .slot span {
        font-size: 12px;
        font-weight: 600;
      }
      .thumb {
        position: relative;
        width: 160px;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--border);
        background: #f3f4f6;
        cursor: move;
        transition: transform 0.2s, opacity 0.2s;
      }
      .thumb.dragging {
        opacity: 0.5;
        transform: scale(0.95);
      }
      .drag-info {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
      }
      .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
      }
      .thumb button {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(239, 68, 68, 0.92);
        color: #fff;
        border: 0;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 12px;
        cursor: pointer;
        opacity: 0;
        transition: 0.2s;
      }
      .thumb:hover button {
        opacity: 1;
      }
      .upload-info {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
      }
      .custom-notification {
        animation: slideIn 0.3s ease-out;
      }

      /* Actions */
      .actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 14px 18px;
        border-top: 1px solid var(--border);
        max-width: 100%;
      }
      .btn {
        height: 40px;
        border: 0;
        border-radius: 10px;
        padding: 0 16px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
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
      .btn-primary:hover {
        opacity: 0.95;
      }
      @keyframes slideIn {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
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
            </svg><span>Dashboard</span>
          </a>
          <a href="{{ route('admin.checkin') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 12h12" />
              <path d="m15 18 6-6-6-6" />
              <path d="M3 3v18" />
            </svg><span>Reservasi</span>
          </a>
          <a href="{{ route('admin.checkout') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 12H3" />
              <path d="m9 18-6-6 6-6" />
              <path d="M21 3v18" />
            </svg><span>Tamu Menginap</span>
          </a>
          <a class="active" href="{{ route('admin.landing') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <line x1="2" y1="12" x2="22" y2="12" />
              <path d="M12 2a15.3 15.3 0 0 1 0 20a15.3 15.3 0 0 1 0-20z" />
            </svg><span>Landing Page</span>
          </a>
        </nav>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: auto;">
          @csrf
          <button type="submit" class="logout" onclick="return confirm('Yakin ingin logout?')" style="border: 0; width: 100%;">
            Logout
          </button>
        </form>
      </aside>

      <!-- Main -->
      <main>
        <div class="page-header">
          <button class="btn-back" onclick="window.location.href='{{ route('admin.landing') }}'" aria-label="Kembali">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 18l-6-6 6-6" />
            </svg>
          </button>
          <h1>Tambah Kamar</h1>
        </div>
        <p class="subtitle">
          Pada halaman ini, admin dapat menambahkan data kamar baru yang akan ditampilkan di landing page hotel.
        </p>

        @if ($errors->any())
          <div style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <section class="card">
          <form id="roomForm" method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-b">
              <div class="form">
                <!-- Nama & Tipe -->
                <div class="two-col">
                  <div class="field">
                    <label>Nama Kamar *</label>
                    <input type="text" name="room_name" value="{{ old('room_name') }}" placeholder="mis. Suite Double Bed (Lantai 1)" required />
                  </div>
                  <div class="field">
                    <label>Tipe Kamar *</label>
                    <select name="room_type" required>
                      <option value="">Pilih Tipe</option>
                      <option value="Suite" {{ old('room_type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                      <option value="Deluxe" {{ old('room_type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                      <option value="Superior" {{ old('room_type') == 'Superior' ? 'selected' : '' }}>Superior</option>
                      <option value="Standard" {{ old('room_type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                    </select>
                  </div>
                </div>

                <!-- Harga & Kapasitas -->
                <div class="two-col">
                  <div class="field">
                    <label>Harga per Malam (Rp) *</label>
                    <input type="number" name="room_price" value="{{ old('room_price') }}" placeholder="345000" min="0" required />
                  </div>
                  <div class="field">
                    <label>Kapasitas (Orang) *</label>
                    <input type="number" name="room_capacity" value="{{ old('room_capacity', 2) }}" placeholder="2" min="1" required />
                  </div>
                </div>

                <!-- Fasilitas -->
                <div class="field">
                  <label>Fasilitas Kamar</label>
                  <textarea name="room_facility" placeholder="WiFi gratis, TV kabel, AC, kamar mandi dalam, air panas, dll.">{{ old('room_facility') }}</textarea>
                </div>

                <!-- Peraturan Check Out / Keluar -->
                <div class="field">
                  <label>Peraturan Check Out / Keluar</label>
                  <textarea name="room_rules" placeholder="Check-in: 14.00 WIB&#10;Check-out: 12.00 WIB&#10;Late check-out dikenakan biaya tambahan&#10;Tidak boleh membawa hewan peliharaan&#10;Dilarang merokok di dalam kamar" rows="8">{{ old('room_rules') }}</textarea>
                </div>

                <!-- Tambah Foto Baru -->
                <div id="uploadSectionContainer"></div>
              </div> <!-- Tutup div.form -->
            </div> <!-- Tutup div.card-b -->

            <div class="actions">
              <button type="button" class="btn btn-ghost" onclick="window.location.href='{{ route('admin.landing') }}'">
                Batal
              </button>
              <button type="submit" class="btn btn-primary">Tambah Kamar</button>
            </div>
          </form>
        </section>
      </main>
    </div>

    <script>
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const MAX_PHOTOS = 5;
      const MIN_PHOTOS = 3;
      const MAX_FILE_SIZE = 2 * 1024 * 1024;
      let selectedFiles = [];
      let draggedItem = null;
      let gallery = null;

      function drawGallery() {
          if (!gallery) return;
          const totalPhotos = selectedFiles.length;
          const remainingSlots = Math.max(0, MAX_PHOTOS - totalPhotos);
          
          const thumbs = selectedFiles.map((file, i) => `
              <div class="thumb" draggable="true" data-index="${i}">
                  <img src="${file.preview}" alt="Foto ${i + 1}"/>
                  <button type="button" onclick="removePhoto(${i})">Hapus</button>
              </div>
          `);

          const slots = Array.from({ length: remainingSlots }).map(() => `
              <div class="slot" onclick="triggerAdd()">
                  <span>+ Tambah Gambar</span>
              </div>
          `);

          gallery.innerHTML = [...thumbs, ...slots].join("");
          addDragAndDropEvents();
      }

      function addDragAndDropEvents() {
          const thumbs = gallery.querySelectorAll('.thumb');
          thumbs.forEach(thumb => {
              thumb.addEventListener('dragstart', function(e) {
                  draggedItem = this;
                  this.classList.add('dragging');
              });
              thumb.addEventListener('dragover', function(e) {
                  e.preventDefault();
              });
              thumb.addEventListener('drop', function(e) {
                  e.preventDefault();
                  if (draggedItem !== this) {
                      const fromIndex = parseInt(draggedItem.getAttribute('data-index'));
                      const toIndex = parseInt(this.getAttribute('data-index'));
                      [selectedFiles[fromIndex], selectedFiles[toIndex]] = [selectedFiles[toIndex], selectedFiles[fromIndex]];
                      drawGallery();
                      showNotification('Urutan foto berhasil diubah!', 'success');
                  }
              });
              thumb.addEventListener('dragend', function() {
                  this.classList.remove('dragging');
                  draggedItem = null;
              });
          });
      }

      function triggerAdd() {
          const input = document.createElement('input');
          input.type = 'file';
          input.accept = 'image/jpeg,image/png,image/jpg';
          input.multiple = true;
          input.onchange = handleFileSelect;
          input.click();
      }

      function removePhoto(i) {
          selectedFiles.splice(i, 1);
          drawGallery();
      }

      async function handleFileSelect(e) {
          const files = [...e.target.files];
          for (const f of files) {
              if (f.size > MAX_FILE_SIZE) {
                  showNotification(`File "${f.name}" terlalu besar. Maksimal 2MB.`, 'error');
                  continue;
              }
              if (selectedFiles.length >= MAX_PHOTOS) {
                  showNotification(`Maksimal ${MAX_PHOTOS} foto.`, 'error');
                  break;
              }
              const preview = await new Promise((res) => {
                  const r = new FileReader();
                  r.onload = () => res(r.result);
                  r.readAsDataURL(f);
              });
              selectedFiles.push({ original: f, preview });
          }
          drawGallery();
      }

      function createUploadSection() {
          document.getElementById('uploadSectionContainer').innerHTML = `
              <div class="field" id="uploadSection">
                  <label>Foto Kamar</label>
                  <p class="upload-info">📷 Minimal ${MIN_PHOTOS} foto, maksimal ${MAX_PHOTOS} foto • 📏 Maksimal 2MB per file</p>
                  <p class="drag-info">↕️ Drag & drop untuk mengubah urutan foto</p>
                  <div class="gallery" id="gallery"></div>
              </div>
          `;
          gallery = document.getElementById("gallery");
          if (gallery) drawGallery();
      }

      function showNotification(message, type) {
          const existing = document.querySelector('.custom-notification');
          if (existing) existing.remove();
          
          const notification = document.createElement('div');
          notification.className = 'custom-notification';
          notification.style.cssText = `
              position: fixed; top: 20px; right: 20px; padding: 12px 20px;
              border-radius: 8px; color: white; font-weight: 600; z-index: 10000;
              background: ${type === 'success' ? '#10b981' : '#ef4444'};
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
          `;
          notification.textContent = message;
          document.body.appendChild(notification);
          setTimeout(() => { if (notification.parentNode) notification.remove(); }, 3000);
      }

      function handleFormSubmit(e) {
        e.preventDefault();
        
        const totalPhotos = selectedFiles.length;
        if (totalPhotos < MIN_PHOTOS) {
            showNotification(`Minimal ${MIN_PHOTOS} foto diperlukan.`, 'error');
            return;
        }
        if (totalPhotos > MAX_PHOTOS) {
            showNotification(`Maksimal ${MAX_PHOTOS} foto.`, 'error');
            return;
        }
        
        const form = document.getElementById('roomForm');
        const formData = new FormData();
        
        // Append form data
        formData.append('_token', CSRF_TOKEN);
        formData.append('room_name', form.querySelector('[name="room_name"]').value);
        formData.append('room_type', form.querySelector('[name="room_type"]').value);
        formData.append('room_price', form.querySelector('[name="room_price"]').value);
        formData.append('room_capacity', form.querySelector('[name="room_capacity"]').value);
        formData.append('room_facility', form.querySelector('[name="room_facility"]').value);
        formData.append('room_rules', form.querySelector('[name="room_rules"]').value);
        
        // Append files
        selectedFiles.forEach(file => {
            formData.append('images[]', file.original);
        });
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Menyimpan...';
        submitBtn.disabled = true;
        
        fetch("{{ route('admin.rooms.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: formData
        })
        .then(async response => {
            // Handle validation errors
            if (response.status === 422) {
                const data = await response.json();
                let errorMsg = 'Terjadi kesalahan validasi';
                if (data.errors) {
                    const firstError = Object.values(data.errors)[0];
                    if (Array.isArray(firstError)) errorMsg = firstError[0];
                }
                showNotification(errorMsg, 'error');
                throw new Error('Validation failed');
            }
            
            // Handle redirect
            if (response.redirected) {
                showNotification('Kamar berhasil ditambahkan!', 'success');
                setTimeout(() => { window.location.href = response.url; }, 1000);
                return;
            }
            
            return response.json();
        })
        .then(data => {
            if (data) {
                // Handle JSON response
                if (data.success) {
                    showNotification('Kamar berhasil ditambahkan!', 'success');
                    setTimeout(() => { window.location.href = '/admin/landing'; }, 1500);
                } else {
                    showNotification(data.message || 'Terjadi kesalahan', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.message !== 'Validation failed') {
                showNotification('Terjadi kesalahan saat menyimpan', 'error');
            }
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    }

      document.addEventListener('DOMContentLoaded', function() {
          createUploadSection();
          const form = document.getElementById('roomForm');
          if (form) form.addEventListener('submit', handleFormSubmit);
      });

      window.removePhoto = removePhoto;
      window.triggerAdd = triggerAdd;
    </script>
  </body>
</html>