<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <style>
        /* Gaya CSS */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* CSS yang disesuaikan untuk gambar potret */
        .event-header {
            position: relative;
            height: 500px; /* Tinggi disesuaikan untuk gambar potret */
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-header img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Menggunakan 'contain' agar gambar potret tidak terpotong */
            object-position: center;
        }
        
        .event-info-box {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }
        
        .event-info-box h1 {
            margin: 0 0 10px;
            font-size: 2.5rem;
            color: #333;
        }
        
        .event-info-box p {
            margin: 0;
            color: #777;
        }

        .event-info-box .organizer {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .event-info-box .details {
            display: flex;
            align-items: center;
            margin-top: 15px;
            color: #555;
            font-size: 1.1rem;
        }

        .event-info-box .details .icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #007bff;
        }

        .main-content {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .left-column {
            flex: 2;
        }

        .right-column {
            flex: 1;
        }

        .card {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card h2 {
            margin-top: 0;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            font-size: 1.5rem;
            color: #333;
        }
        
        .ticket-list .ticket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .ticket-list .ticket-item:last-child {
            border-bottom: none;
        }

        .ticket-info {
            flex-grow: 1;
        }

        .ticket-info h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }
        
        .ticket-info .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #007bff;
            margin-top: 5px;
        }

        .ticket-info .availability {
            color: #555;
            font-size: 0.9rem;
        }

        .buy-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buy-button:hover {
            background-color: #0056b3;
        }

        .cta-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            position: sticky;
            top: 20px;
        }
        
        .cta-box .price-range {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .cta-box .buy-cta {
            background-color: #ff5e3a;
            color: #fff;
            border: none;
            width: 100%;
            padding: 15px 0;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .cta-box .buy-cta:hover {
            background-color: #e64c2a;
        }

        .event-description img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }
            
            .event-info-box {
                margin-top: -50px;
                padding: 20px;
            }

            .event-info-box h1 {
                font-size: 2rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="container">
        <div class="event-header">
            <img src="{{ asset('storage/' . $event->gambar) }}" alt="Poster Maher Zain Live in Concert">
        </div>

        <div class="event-info-box">
            <h1 id="event-title">{{ $event->nama }}</h1>
            <p class="organizer">by GoldLive Indonesia</p>
            
            <div class="details">
                <i class="fas fa-calendar-alt icon"></i>
                <span id="event-date">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }} | {{ $event->waktu }}</span>
            </div>
            <div class="details">
                <i class="fas fa-map-marker-alt icon"></i>
                <span id="event-location">{{ $event->lokasi }}</span>
            </div>
        </div>

        <div class="main-content">
            <div class="left-column">
                <div class="card event-description">
                    <h2>Deskripsi Event</h2>
                    {!! $event->deskripsi !!}
                </div>
            </div>

            <div class="right-column">
                <div class="cta-box">                 
                    @if(Auth::check() == false)                                   
                        <a href="{{ route('register') }}">
                            <button class="buy-cta">Daftar Event</button>
                        </a>
                    @else
                        <a href="#">
                            <button class="buy-cta">Daftar Event</button>
                        </a>
                    @endif               
                </div>
            </div>
        </div>
    </div>

</body>
</html>