<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Price</title>
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
        .container { padding: 40px; max-width: 500px; margin: 0 auto; }
        h1 { font-size: 28px; margin-bottom: 8px; }
        p { color: #666; margin-bottom: 32px; }
        .back-link {
            display: inline-block;
            margin-bottom: 24px;
            color: #1D9E75;
            text-decoration: none;
            font-size: 14px;
        }
        .alert {
            background: #e1f5ee;
            color: #1D9E75;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .card {
            background: white;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .current-price {
            background: #f0faf5;
            border: 1px solid #1D9E75;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            text-align: center;
        }
        .current-price p { color: #666; font-size: 13px; margin-bottom: 4px; }
        .current-price h2 { font-size: 36px; color: #1D9E75; font-weight: bold; }
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
        .input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .input-prefix {
            padding: 12px 14px;
            background: #f5f5f5;
            color: #666;
            font-size: 15px;
            border-right: 1px solid #ddd;
        }
        .input-wrapper input {
            padding: 12px;
            border: none;
            font-size: 15px;
            width: 100%;
            outline: none;
        }
        .error { color: red; font-size: 13px; margin-top: 4px; }
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
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Owner: {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('owner.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Manage Price</h1>
    <p>Update the nightly rate for your homestay</p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="current-price">
            <p>Current Price Per Night</p>
            <h2>RM {{ $price }}</h2>
        </div>

        <form method="POST" action="{{ route('owner.price.update') }}">
            @csrf

            <div class="form-group">
                <label>New Price Per Night</label>
                <div class="input-wrapper">
                    <span class="input-prefix">RM</span>
                    <input type="number" name="price" value="{{ old('price', $price) }}" min="1" step="0.01" placeholder="Enter new price">
                </div>
                @error('price')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Update Price</button>
        </form>
    </div>
</div>

</body>
</html>