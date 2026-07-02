<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Availability Calendar</title>
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
        .container { padding: 40px; max-width: 800px; margin: 0 auto; }
        h1 { font-size: 28px; margin-bottom: 8px; }
        p { color: #666; margin-bottom: 24px; }
        .back-link {
            display: inline-block;
            margin-bottom: 24px;
            color: #1D9E75;
            text-decoration: none;
            font-size: 14px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            background: #e1f5ee;
            color: #1D9E75;
        }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .card h3 { font-size: 18px; margin-bottom: 20px; }
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
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .error { color: red; font-size: 13px; }
        .btn {
            width: 100%;
            padding: 12px;
            background: #1D9E75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }
        .btn:hover { background: #178a63; }
        .date-list { display: flex; flex-direction: column; gap: 10px; }
        .date-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #fff8f0;
            border: 1px solid #ffe0b2;
            border-radius: 8px;
        }
        .date-info { display: flex; flex-direction: column; gap: 2px; }
        .date-text { font-size: 15px; font-weight: 500; color: #333; }
        .date-reason { font-size: 12px; color: #999; }
        .unblock-btn {
            padding: 6px 12px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
        }
        .empty { color: #999; font-size: 14px; text-align: center; padding: 20px; }
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Owner: {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('owner.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Availability Calendar</h1>
    <p>Block dates when your homestay is unavailable</p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="grid">
        <!-- Block a date form -->
        <div class="card">
            <h3>🚫 Block a Date</h3>
            <form method="POST" action="{{ route('owner.availability.store') }}">
                @csrf
                <div class="form-group">
                    <label>Date to Block</label>
                    <input type="date" name="date" value="{{ old('date') }}">
                    @error('date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Reason (optional)</label>
                    <input type="text" name="reason" value="{{ old('reason') }}"
                           placeholder="e.g. Personal use, Maintenance">
                    @error('reason')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn">Block This Date</button>
            </form>
        </div>

        <!-- Blocked dates list -->
        <div class="card">
            <h3>📅 Blocked Dates</h3>
            @if($blockedDates->isEmpty())
                <div class="empty">No dates blocked yet.</div>
            @else
                <div class="date-list">
                    @foreach($blockedDates as $blocked)
                        <div class="date-item">
                            <div class="date-info">
                                <span class="date-text">
                                    {{ $blocked->date->format('d M Y') }}
                                </span>
                                @if($blocked->reason)
                                    <span class="date-reason">{{ $blocked->reason }}</span>
                                @endif
                            </div>
                            <form method="POST"
                                  action="{{ route('owner.availability.destroy', $blocked->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="unblock-btn">Unblock</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>