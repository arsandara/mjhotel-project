<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | Hotel Mukti Jaya</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <style>
      /* ===== Vars & Reset (selaras dengan halamanmu) ===== */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      :root {
        --brand: #0e4c2f;
        --brand-dark: #0e4c2f;
        --bg: #f1f5f9;
        --bg-soft: #d9e8ef;
        --text: #111827;
        --muted: #475569;
        --border: #e5e7eb;
        --shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        --radius: 6px;
        --ctrl-h: 44px;
      }
      body {
        font-family: "Geist", sans-serif;
        background: linear-gradient(
            0deg,
            rgba(14, 76, 47, 0.06),
            rgba(14, 76, 47, 0.06)
          ),
          var(--bg);
        color: var(--text);
        min-height: 100svh;
        display: grid;
        place-items: center;
        padding: 24px;
      }

      /* ===== Card Login (meniru komponen & nuansa gambar) ===== */
      .login-wrap {
        width: 100%;
        max-width: 520px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 28px;
      }
      .brand {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
        text-align: center;
      }
      .brand img {
        width: 74px;
        height: auto;
      }
      .brand h1 {
        font-size: 18px;
        letter-spacing: 0.04em;
        font-weight: 700;
      }
      .brand small {
        color: #6b7280;
        font-size: 12px;
      }

      /* ===== Alert Messages ===== */
      .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 13px;
        animation: slideDown 0.3s ease;
      }
      
      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .alert-danger {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
      }
      
      .alert-danger p {
        margin: 0;
      }
      
      .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
      }

      .form {
        display: grid;
        grid-template-columns: 1fr;
        row-gap: 14px;
      }
      .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }
      .label {
        font-size: 13px;
        color: #334155;
      }
      .control {
        display: flex;
        align-items: center;
        gap: 8px;
        height: var(--ctrl-h);
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: #fff;
        transition: all 0.2s;
      }
      .control:focus-within {
        outline: 2px solid rgba(14, 76, 47, 0.22);
      }
      .control.has-error {
        border-color: #ef4444;
      }
      .control input {
        border: 0;
        outline: 0;
        width: 100%;
        background: transparent;
        color: #111827;
        font-size: 14px;
      }
      .toggle {
        border: 0;
        background: #f8fafc;
        height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        cursor: pointer;
        font-weight: 600;
        color: #0f172a;
        font-size: 12px;
        transition: background 0.2s;
      }
      .toggle:hover {
        background: #f1f5f9;
      }

      .row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 4px;
      }
      .row label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--muted);
        cursor: pointer;
      }
      .row a {
        font-size: 13px;
        color: var(--brand);
        text-decoration: none;
        font-weight: 600;
      }
      .row a:hover {
        text-decoration: underline;
      }

      .btn-primary {
        height: var(--ctrl-h);
        background: var(--brand);
        color: #fff;
        border: 0;
        border-radius: var(--radius);
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
      }
      .btn-primary:hover {
        background: var(--brand-dark);
        transform: translateY(-1px);
      }
      .btn-primary:active {
        transform: translateY(0);
      }
      .btn-primary:disabled {
        background: #9ca3af;
        cursor: not-allowed;
        transform: none;
      }

      .error-text {
        display: none;
        margin-top: 4px;
        font-size: 12px;
        color: #ef4444;
      }
      .error-text.show {
        display: block;
      }
      
      .note {
        margin-top: 16px;
        text-align: center;
        font-size: 12px;
        color: #64748b;
      }

      /* ===== Footer strip opsional agar serasi ===== */
      .footer {
        margin-top: 18px;
        text-align: center;
        font-size: 12px;
        color: #94a3b8;
      }

      @media (max-width: 560px) {
        .login-wrap {
          padding: 22px;
        }
      }
    </style>
  </head>
    <body>
        <main class="login-wrap" role="main" aria-labelledby="title">
            <div class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Hotel Mukti Jaya" />
                <h1 id="title">Hotel Mukti Jaya</h1>
                <small>The Cozy Budget Hotel</small>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form id="adminLogin" class="form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="field">
                    <label class="label" for="username">Username</label>
                    <div class="control {{ $errors->has('username') ? 'has-error' : '' }}">
                        <input
                            id="username"
                            name="username"
                            type="text"
                            placeholder="Masukkan username"
                            autocomplete="username"
                            required
                            value="{{ old('username') }}"
                        />
                    </div>
                    @error('username')
                        <span class="error-text show">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="control {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        />
                        <button
                            type="button"
                            class="toggle"
                            id="togglePwd"
                            aria-controls="password"
                            aria-pressed="false"
                        >
                            Tampil
                        </button>
                    </div>
                    @error('password')
                        <span class="error-text show">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <label><input type="checkbox" id="remember" name="remember" /> Ingat saya</label>
                    <a href="#" onclick="alert('Hubungi administrator untuk reset password.');return false;">Lupa password?</a>
                </div>

                <button class="btn-primary" type="submit" id="submitBtn">Login</button>
                <p class="note">Hanya untuk staf yang berwenang.</p>
            </form>

            <div class="footer">© 2025 Hotel Mukti Jaya</div>
        </main>

        <script>
            // Toggle tampil/sembunyi password
            const toggle = document.getElementById("togglePwd");
            const pwd = document.getElementById("password");
            toggle.addEventListener("click", () => {
                const show = pwd.type === "password";
                pwd.type = show ? "text" : "password";
                toggle.textContent = show ? "Sembunyi" : "Tampil";
                toggle.setAttribute("aria-pressed", String(show));
                pwd.focus();
            });

            // Handle form submission - disable button to prevent double submit
            const form = document.getElementById('adminLogin');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Loading...';
            });

            // Auto refresh CSRF token every 10 minutes to prevent 419 error
            setInterval(function() {
                fetch('/admin/login', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Extract new CSRF token from response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newToken = doc.querySelector('input[name="_token"]');
                    
                    if (newToken) {
                        const currentToken = document.querySelector('input[name="_token"]');
                        if (currentToken) {
                            currentToken.value = newToken.value;
                        }
                        
                        // Update meta tag
                        const metaToken = document.querySelector('meta[name="csrf-token"]');
                        if (metaToken) {
                            metaToken.setAttribute('content', newToken.value);
                        }
                        
                        console.log('CSRF token refreshed successfully');
                    }
                })
                .catch(error => {
                    console.log('Token refresh failed:', error);
                });
            }, 600000); // 10 minutes = 600000 ms
        </script>
    </body>
    </html>