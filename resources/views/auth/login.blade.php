<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Rlinda Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #0d3d2e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .wrapper {
            width: 100%;
            max-width: 420px;
        }
        .logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .logo h1 {
            font-size: 28px;
            color: white;
            font-weight: bold;
        }
        .logo p {
            color: #a8d5c2;
            font-size: 14px;
            margin-top: 6px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .card h2 {
            font-size: 22px;
            margin-bottom: 6px;
            color: #1a1a1a;
        }
        .card p {
            font-size: 14px;
            color: #888;
            margin-bottom: 28px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 18px;
        }
        .form-group label {
            font-size: 13px;
            color: #555;
            font-weight: 500;
        }
        .form-group input {
            padding: 12px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: border 0.2s;
            outline: none;
        }
        .form-group input:focus {
            border-color: #1D9E75;
        }
        .error {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 4px;
        }
        .forgot {
            text-align: right;
            margin-bottom: 20px;
        }
        .forgot a {
            font-size: 13px;
            color: #1D9E75;
            text-decoration: none;
        }
        .btn {
            width: 100%;
            padding: 13px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn:hover { background: #178a63; }
        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
        .register-link a {
            color: #1D9E75;
            text-decoration: none;
            font-weight: 500;
        }
        .divider {
            height: 1px;
            background: #f0f0f0;
            margin: 20px 0;
        }
        .owner-note {
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="logo">
        <h1>🏠 Rlinda Enterprise</h1>
        <p>Welcome back! Please login to continue.</p>
    </div>

    <div class="card">
        <h2>Sign in</h2>
        <p>Enter your email and password to access your account</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="you@example.com" required autofocus>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Enter your password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="forgot">
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="divider"></div>

        <div class="register-link">
            Don't have an account?
            <a href="{{ route('register') }}">Register here</a>
        </div>

        <div class="owner-note" style="margin-top:12px">
            Owner? Use your owner credentials to login.
        </div>
    </div>
</div>

</body>
</html>