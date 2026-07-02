<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Rlinda Enterprise</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3e6cb 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .wrapper {
            width: 100%;
            max-width: 500px;
        }
        .logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .logo h1 {
            font-size: 26px;
            color: #0d3d2e;
            font-weight: bold;
        }
        .logo p {
            color: #555;
            font-size: 14px;
            margin-top: 6px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .card h2 {
            font-size: 22px;
            margin-bottom: 6px;
            color: #1a1a1a;
        }
        .card .subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 28px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }
        .form-group label {
            font-size: 13px;
            color: #555;
            font-weight: 500;
        }
        .form-group input {
            padding: 11px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border 0.2s;
        }
        .form-group input:focus {
            border-color: #1D9E75;
        }
        .error {
            color: #e53e3e;
            font-size: 12px;
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
            margin-top: 8px;
        }
        .btn:hover { background: #178a63; }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
        .login-link a {
            color: #1D9E75;
            text-decoration: none;
            font-weight: 500;
        }
        .terms {
            font-size: 12px;
            color: #aaa;
            text-align: center;
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="logo">
        <h1>🏠 Rlinda Enterprise</h1>
        <p>Create your account to start booking</p>
    </div>

    <div class="card">
        <h2>Create Account</h2>
        <p class="subtitle">Fill in your details to register as a customer</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Your full name" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                           placeholder="Choose a username" required>
                    @error('username')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="you@example.com" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                       placeholder="e.g. 0123456789" required>
                @error('phone_number')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password"
                           placeholder="Min 8 characters" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           placeholder="Repeat password" required>
                </div>
            </div>

            <button type="submit" class="btn">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Login here</a>
        </div>

        <div class="terms">
            By registering, you agree to our terms and conditions.
        </div>
    </div>
</div>

</body>
</html>