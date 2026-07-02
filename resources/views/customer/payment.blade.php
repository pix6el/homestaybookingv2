<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment — Rlinda Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; min-height: 100vh; }
        nav {
            background: white;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }
        .logo { font-size: 20px; font-weight: bold; color: #1D9E75; }
        .container { padding: 40px; max-width: 700px; margin: 0 auto; }
        .back-link {
            display: inline-block;
            margin-bottom: 24px;
            color: #1D9E75;
            text-decoration: none;
            font-size: 14px;
        }
        h1 { font-size: 28px; margin-bottom: 8px; }
        .subtitle { color: #666; margin-bottom: 32px; font-size: 15px; }

        /* Order Summary */
        .order-summary {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #eee;
            margin-bottom: 24px;
        }
        .order-summary h3 { font-size: 16px; margin-bottom: 16px; color: #333; }
        .order-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px solid #f5f5f5;
            color: #555;
        }
        .order-total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            padding: 16px 0 0;
            color: #1D9E75;
        }

        /* Payment Method Tabs */
        .payment-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }
        .tab-btn {
            padding: 16px;
            border: 2px solid #eee;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }
        .tab-btn.active {
            border-color: #1D9E75;
            background: #f0faf5;
        }
        .tab-btn h4 { font-size: 15px; margin-bottom: 4px; }
        .tab-btn p { font-size: 12px; color: #888; }
        .tab-icon { font-size: 28px; margin-bottom: 8px; }

        /* Card Form */
        .payment-form {
            background: white;
            border-radius: 12px;
            padding: 28px;
            border: 1px solid #eee;
        }
        .payment-form h3 { font-size: 16px; margin-bottom: 20px; }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }
        .form-group label {
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group input {
            padding: 12px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }
        .form-group input:focus { border-color: #1D9E75; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .card-icons { display: flex; gap: 8px; margin-bottom: 16px; }
        .card-icon {
            padding: 4px 10px;
            border: 1px solid #eee;
            border-radius: 4px;
            font-size: 12px;
            color: #555;
            background: #fafafa;
        }

        /* QR Code Section */
        .qr-section { text-align: center; padding: 20px 0; }
        .qr-options { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
        .qr-option {
            padding: 20px;
            border: 2px solid #eee;
            border-radius: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }
        .qr-option.selected { border-color: #1D9E75; background: #f0faf5; }
        .qr-option .qr-icon { font-size: 36px; margin-bottom: 8px; }
        .qr-option h4 { font-size: 14px; font-weight: bold; }
        .qr-option p { font-size: 12px; color: #888; }
        .qr-code-display {
            background: white;
            border: 2px dashed #1D9E75;
            border-radius: 12px;
            padding: 24px;
            margin: 20px 0;
            display: none;
        }
        .qr-code-display.show { display: block; }
        .qr-placeholder {
            width: 180px;
            height: 180px;
            margin: 0 auto 16px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
        }
        .qr-instruction { font-size: 14px; color: #555; line-height: 1.6; }
        .qr-amount { font-size: 24px; font-weight: bold; color: #1D9E75; margin: 12px 0; }

        /* Pay Button */
        .pay-btn {
            width: 100%;
            padding: 16px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.2s;
        }
        .pay-btn:hover { background: #178a63; }
        .secure-note {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 12px;
        }

        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }
        .loading-overlay.show { display: flex; }
        .spinner {
            width: 50px; height: 50px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .loading-text { color: white; font-size: 18px; }
    </style>
</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <div class="loading-text">Processing payment...</div>
</div>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Welcome, {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('customer.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Complete Payment</h1>
    <p class="subtitle">Secure payment for your booking</p>

    {{-- Order Summary --}}
    <div class="order-summary">
        <h3>📋 Booking Summary</h3>
        <div class="order-row">
            <span>Check-in</span>
            <span>{{ $booking->check_in }}</span>
        </div>
        <div class="order-row">
            <span>Check-out</span>
            <span>{{ $booking->check_out }}</span>
        </div>
        <div class="order-row">
            <span>Guests</span>
            <span>{{ $booking->guests }} guest(s)</span>
        </div>
        <div class="order-row">
            <span>Duration</span>
            <span>
                {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }} night(s)
            </span>
        </div>
        <div class="order-total">
            <span>Total Amount</span>
            <span>RM {{ number_format($booking->total_price, 2) }}</span>
        </div>
    </div>

    {{-- Payment Method Selection --}}
    <div class="payment-tabs">
        <div class="tab-btn active" id="tab-card" onclick="switchTab('card')">
            <div class="tab-icon">💳</div>
            <h4>Debit / Credit Card</h4>
            <p>Visa, Mastercard</p>
        </div>
        <div class="tab-btn" id="tab-qr" onclick="switchTab('qr')">
            <div class="tab-icon">📱</div>
            <h4>QR Payment</h4>
            <p>DuitNow, Touch 'n Go</p>
        </div>
    </div>

    {{-- Card Payment Form --}}
    <div id="card-section">
        <div class="payment-form">
            <h3>💳 Card Details</h3>
            <div class="card-icons">
                <span class="card-icon">VISA</span>
                <span class="card-icon">Mastercard</span>
                <span class="card-icon">Maestro</span>
            </div>
            <form id="card-form" method="POST" action="{{ route('payment.process', $booking->id) }}"
                  onsubmit="handlePayment(event, 'card')">
                @csrf
                <input type="hidden" name="payment_method" value="card">

                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" placeholder="1234 5678 9012 3456"
                           maxlength="19" oninput="formatCard(this)" required>
                </div>
                <div class="form-group">
                    <label>Cardholder Name</label>
                    <input type="text" placeholder="Name as on card" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="text" placeholder="MM/YY" maxlength="5"
                               oninput="formatExpiry(this)" required>
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="123" maxlength="3" required>
                    </div>
                </div>
                <button type="submit" class="pay-btn">
                    🔒 Pay RM {{ number_format($booking->total_price, 2) }}
                </button>
                <p class="secure-note">🔐 Your payment is secured and encrypted</p>
            </form>
        </div>
    </div>

    {{-- QR Payment Section --}}
    <div id="qr-section" style="display:none">
        <div class="payment-form">
            <h3>📱 Choose QR Payment Method</h3>

            <div class="qr-options">
                <div class="qr-option" id="qr-duitnow" onclick="selectQR('duitnow')">
                    <div class="qr-icon">🏦</div>
                    <h4>DuitNow QR</h4>
                    <p>All Malaysian banks</p>
                </div>
                <div class="qr-option" id="qr-tng" onclick="selectQR('tng')">
                    <div class="qr-icon">💙</div>
                    <h4>Touch 'n Go</h4>
                    <p>TNG eWallet</p>
                </div>
            </div>

            {{-- DuitNow QR --}}
            <div class="qr-code-display" id="duitnow-qr">
                <div class="qr-placeholder">🏦</div>
                <div class="qr-amount">RM {{ number_format($booking->total_price, 2) }}</div>
                <p class="qr-instruction">
                    1. Open your banking app<br>
                    2. Scan this DuitNow QR code<br>
                    3. Confirm the amount and pay<br>
                    4. Click "I've Paid" below
                </p>
            </div>

            {{-- TNG QR --}}
            <div class="qr-code-display" id="tng-qr">
                <div class="qr-placeholder">💙</div>
                <div class="qr-amount">RM {{ number_format($booking->total_price, 2) }}</div>
                <p class="qr-instruction">
                    1. Open Touch 'n Go eWallet app<br>
                    2. Tap "Scan" and scan this QR<br>
                    3. Confirm the amount and pay<br>
                    4. Click "I've Paid" below
                </p>
            </div>

            <form id="qr-form" method="POST" action="{{ route('payment.process', $booking->id) }}"
                  onsubmit="handlePayment(event, 'qr')" style="display:none">
                @csrf
                <input type="hidden" name="payment_method" id="qr-method-input" value="qr">
                <button type="submit" class="pay-btn">✅ I've Paid — Confirm Booking</button>
                <p class="secure-note">Click above after completing your QR payment</p>
            </form>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        document.getElementById('card-section').style.display = tab === 'card' ? 'block' : 'none';
        document.getElementById('qr-section').style.display = tab === 'qr' ? 'block' : 'none';
        document.getElementById('tab-card').classList.toggle('active', tab === 'card');
        document.getElementById('tab-qr').classList.toggle('active', tab === 'qr');
    }

    function selectQR(type) {
        document.getElementById('duitnow-qr').classList.remove('show');
        document.getElementById('tng-qr').classList.remove('show');
        document.getElementById('qr-duitnow').classList.remove('selected');
        document.getElementById('qr-tng').classList.remove('selected');

        document.getElementById(type + '-qr').classList.add('show');
        document.getElementById('qr-' + type).classList.add('selected');
        document.getElementById('qr-method-input').value = type;
        document.getElementById('qr-form').style.display = 'block';
    }

    function formatCard(input) {
        let value = input.value.replace(/\D/g, '');
        value = value.replace(/(.{4})/g, '$1 ').trim();
        input.value = value;
    }

    function formatExpiry(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length >= 2) value = value.slice(0,2) + '/' + value.slice(2);
        input.value = value;
    }

    function handlePayment(event, type) {
        event.preventDefault();
        const overlay = document.getElementById('loadingOverlay');
        overlay.classList.add('show');
        setTimeout(() => {
            event.target.submit();
        }, 2500);
    }
</script>

</body>
</html>