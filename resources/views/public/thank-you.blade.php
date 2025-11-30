<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih | Hotel Mukti Jaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Geist', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(14, 76, 47, 0.15);
            padding: 50px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            border: 1px solid #e2e8f0;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }
        
        .success-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }
        
        h1 {
            color: #0e4c2f;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        
        .subtitle {
            color: #475569;
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .reservation-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
        }
        
        .reservation-id {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0e4c2f;
            margin-bottom: 10px;
        }
        
        .status-badge {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .note {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
        }
        
        .note h3 {
            color: #92400e;
            font-size: 1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .note p {
            color: #92400e;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            flex: 1;
            padding: 15px 25px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: #0e4c2f;
            color: white;
        }
        
        .btn-primary:hover {
            background: #08341f;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        
        <h1>Terima Kasih!</h1>
        <p class="subtitle">
            Pembayaran Anda berhasil dan reservasi telah dikonfirmasi.<br>
            Kami telah mengirimkan detail reservasi ke email Anda.
        </p>
        
        <div class="reservation-info">
            <div class="reservation-id">{{ $reservationId ?? 'RSV202511245514' }}</div>
            <div class="status-badge">Reservasi Dikonfirmasi</div>
        </div>
        
        <div class="note">
            <h3>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                Informasi Penting
            </h3>
            <p>
                • Silakan tunjukkan ID Reservasi ini saat check-in<br>
                • Check-in: 14.00 WIB | Check-out: 12.00 WIB<br>
                • Hubungi resepsionis jika ada pertanyaan
            </p>
        </div>
        
        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Home</a>
            <a href="{{ route('reservation') }}" class="btn btn-secondary">Pesan Lagi</a>
        </div>
    </div>
</body>
</html>