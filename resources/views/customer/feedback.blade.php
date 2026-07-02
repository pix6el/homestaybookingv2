<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Feedback</title>
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
        .form-group textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
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
    <h1>Complaints & Feedback</h1>
    <p>Have an issue or suggestion? Let us know.</p>

    <div class="card">
        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="e.g. Issue with check-in process">
                @error('subject')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" placeholder="Describe your issue or feedback in detail...">{{ old('message') }}</textarea>
                @error('message')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Submit Feedback</button>
        </form>
    </div>
</div>

</body>
</html>