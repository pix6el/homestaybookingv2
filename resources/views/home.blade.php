<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rlinda Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; color: #333; }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 40px;
            border-bottom: 1px solid #eee;
            background: white;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo { font-size: 22px; font-weight: bold; color: #1D9E75; }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-links a {
            text-decoration: none;
            color: #555;
            font-size: 15px;
        }
        .nav-links a:hover { color: #1D9E75; }
        .nav-btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-outline {
            border: 1.5px solid #1D9E75;
            color: #1D9E75;
            background: white;
        }
        .btn-solid {
            background: #1D9E75;
            color: white;
            border: none;
        }
        .btn-solid:hover { background: #178a63; }

        /* Hero */
        .hero {
            background: #f5f3ef;
            text-align: center;
            padding: 80px 20px;
        }
        .hero h1 { font-size: 42px; margin-bottom: 16px; color: #1a1a1a; }
        .hero p { font-size: 18px; color: #666; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto; }
        .hero-btns { display: flex; gap: 16px; justify-content: center; }
        .btn-hero-primary {
            padding: 14px 32px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-hero-primary:hover { background: #178a63; }
        .btn-hero-secondary {
            padding: 14px 32px;
            background: white;
            color: #1D9E75;
            border: 1.5px solid #1D9E75;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Gallery */
        .section { padding: 60px 40px; }
        .section h2 { font-size: 28px; margin-bottom: 8px; }
        .section p { color: #666; margin-bottom: 32px; }
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .gallery-item {
            background: #e8e8e8;
            border-radius: 12px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 14px;
        }

        /* Features */
        .features {
            background: #f9f9f9;
            padding: 60px 40px;
            text-align: center;
        }
        .features h2 { font-size: 28px; margin-bottom: 8px; }
        .features p { color: #666; margin-bottom: 40px; }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 900px;
            margin: 0 auto;
        }
        .feature-card {
            background: white;
            padding: 28px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .feature-icon { font-size: 32px; margin-bottom: 12px; }
        .feature-card h4 { font-size: 16px; margin-bottom: 8px; }
        .feature-card p { font-size: 14px; color: #888; margin: 0; }

        /* Booking */
        .booking-section { padding: 60px 40px; }
        .booking-section h2 { font-size: 28px; margin-bottom: 8px; }
        .booking-section p { color: #666; margin-bottom: 32px; }
        .booking-card {
            background: white;
            border-radius: 12px;
            padding: 32px;
            max-width: 500px;
            border: 1px solid #eee;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group label { font-size: 13px; color: #888; text-transform: uppercase; }
        .form-group input, .form-group select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .price { font-size: 22px; font-weight: bold; color: #1D9E75; margin: 20px 0; }
        .book-btn {
            width: 100%;
            padding: 14px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        .book-btn:hover { background: #178a63; }
        .login-note {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 12px;
        }
        .login-note a { color: #1D9E75; text-decoration: none; }

        /* Footer */
        footer {
            background: #0d3d2e;
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
        }
        footer h4 { color: white; margin-bottom: 16px; font-size: 16px; }
        footer p, footer a {
            font-size: 14px;
            color: #a8d5c2;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
        }
        footer a:hover { color: white; }
        .footer-copy {
            text-align: center;
            padding: 16px;
            font-size: 13px;
            color: #a8d5c2;
            background: #0a2e21;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav>
        <div class="logo">🏠 Rlinda Enterprise</div>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="#gallery">Gallery</a>
            <a href="#booking">Book Now</a>
            @auth
                @if(Auth::user()->role === 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="nav-btn btn-solid">Dashboard</a>
                @else
                    <a href="{{ route('customer.dashboard') }}" class="nav-btn btn-solid">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-btn btn-outline">Login</a>
                <a href="{{ route('register') }}" class="nav-btn btn-solid">Register</a>
            @endauth
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero">
        <h1>Your home away from home</h1>
        <p>A cozy private homestay with instant booking and flexible dates.</p>
        <div class="hero-btns">
            @auth
                <a href="{{ route('booking.create') }}" class="btn-hero-primary">📅 Book Now</a>
            @else
                <a href="{{ route('login') }}" class="btn-hero-primary">📅 Book Now</a>
            @endauth
            <a href="#gallery" class="btn-hero-secondary">View Photos</a>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="section" id="gallery">
        <h2>Photo gallery</h2>
        <p>Take a look around before you arrive</p>
        <div class="gallery">
            <div class="gallery-item">🛋️ Living Room</div>
            <div class="gallery-item">🛏️ Bedroom</div>
            <div class="gallery-item">🍳 Kitchen</div>
            <div class="gallery-item">🚿 Bathroom</div>
            <div class="gallery-item">🌿 Garden</div>
            <div class="gallery-item">📍 Nearby Area</div>
        </div>
    </section>

    {{-- Features --}}
    <section class="features">
        <h2>Why choose us?</h2>
        <p>Everything you need for a comfortable stay</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h4>Instant Booking</h4>
                <p>No waiting — your booking is confirmed immediately.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏡</div>
                <h4>Entire Home</h4>
                <p>You get the whole place to yourself. No sharing.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📍</div>
                <h4>Great Location</h4>
                <p>Conveniently located near shops, restaurants and transport.</p>
            </div>
        </div>
    </section>

    {{-- Booking Widget --}}
    <section class="booking-section" id="booking">
        <h2>Book your stay</h2>
        <p>Instant booking — no waiting for approval</p>
        <div class="booking-card">
            <div class="form-row">
                <div