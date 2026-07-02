<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Homestay</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        nav {
            background: white;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }
        .logo { font-size: 20px; font-weight: bold; color: #1D9E75; }
        .container { padding: 40px; max-width: 600px; margin: 0 auto; }
        h1 { font-size: 28px; margin-bottom: 8px; }
        p { color: #666; margin-bottom: 32px; }
        .card {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group input,
        .form-group select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .price-info {
            background: #f0faf5;
            border: 1px solid #1D9E75;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            color: #1D9E75;
            font-size: 14px;
        }
        .error {
            color: red;
            font-size: 13px;
            margin-top: 4px;
        }
        .btn {
            width: 100%;
            padding: 14px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover { background: #178a63; }
        .back-link {
            display: inline-block;
            margin-bottom: 24px;
            color: #1D9E75;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Welcome, {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('customer.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Book Your Stay</h1>
    <p>Instant booking — no waiting for approval</p>

    <div class="card">
        <div class="price-info">
            💡 Price: <strong>RM {{ $price }} per night</strong> — total will be calculated automatically
        </div>

        @php
            $blocked = \App\Models\BlockedDate::where('date', '>=', today())
                        ->orderBy('date')
                        ->get();
        @endphp

        @if($blocked->isNotEmpty())
        <div style="background:#fff3f3; border:1px solid #ffcccc; border-radius:8px; padding:16px; margin-bottom:20px;">
            <p style="color:#cc0000; font-size:13px; font-weight:bold; margin-bottom:8px;">
                🚫 Unavailable Dates:
            </p>
            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                @foreach($blocked as $b)
                    <span style="background:#ffe5e5; color:#cc0000; padding:4px 10px; border-radius:20px; font-size:12px;">
                        {{ $b->date->format('d M Y') }}
                        @if($b->reason) — {{ $b->reason }} @endif
                    </span>
                @endforeach
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Check-in Date</label>
                    <input type="date" name="check_in" value="{{ old('check_in') }}">
                    @error('check_in')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Check-out Date</label>
                    <input type="date" name="check_out" value="{{ old('check_out') }}">
                    @error('check_out')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Number of Guests</label>
                <select name="guests">
                    <option value="1">1 guest</option>
                    <option value="2">2 guests</option>
                    <option value="3">3 guests</option>
                    <option value="4">4 guests</option>
                    <option value="5">5 guests</option>
                </select>
                @error('guests')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</div>

</body>
</html>