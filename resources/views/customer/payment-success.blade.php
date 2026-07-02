<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful — Rlinda Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #e1f5ee;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 24px;
        }
        h1 { font-size: 26px; color: #1D9E75; margin-bottom: 8px; }
        .subtitle { color: #666; font-size: 15px; margin-bottom: 32px; }
        .details {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 28px;
            text-align: left;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            color: #555;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-row span:last-child { font-weight: 500; color: #333; }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 0 0;
            color: #1D9E75;
        }
        .btn {
            display: block;
            padding: 14px;
            background: #1D9E75;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .btn:hover { background: #178a63; }
        .btn-outline {
            display: block;
            padding: 14px;
            border: 1.5px solid #1D9E75;
            color: #1D9E75;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
        }
        .payment-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e1f5ee;
            color: #1D9E75;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="success-icon">✅</div>
    <h1>Payment Successful!</h1>
    <p class="subtitle">Your booking has been confirmed. See you soon!</p>

    <div class="payment-badge">
        💳 Paid via {{ ucfirst($booking->payment_method) }}
    </div>

    <div class="details">
        <div class="detail-row">
            <span>Booking ID</span>
            <span>#{{ $booking->id }}</span>
        </div>
        <div class="detail-row">
            <span>Check-in</span>
            <span>{{ $booking->check_in }}</span>
        </div>
        <div class="detail-row">
            <span>Check-out</span>
            <span>{{ $booking->check_out }}</span>
        </div>
        <div class="detail-row">
            <span>Guests</span>
            <span>{{ $booking->guests }} guest(s)</span>
        </div>
        <div class="detail-row">
            <span>Payment Status</span>
            <span style="color:#1D9E75">✅ Paid</span>
        </div>
        <div class="total-row">
            <span>Total Paid</span>
            <span>RM {{ number_format($booking->total_price, 2) }}</span>
        </div>
    </div>

    <a href="{{ route('customer.dashboard') }}" class="btn">Go to Dashboard</a>
    <a href="/" class="btn-outline">Back to Homepage</a>
</div>
</body>
</html>