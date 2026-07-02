<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedback</title>
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
        .container { padding: 40px; }
        h1 { font-size: 28px; margin-bottom: 8px; }
        p { color: #666; margin-bottom: 24px; }
        .back-link {
            display: inline-block;
            margin-bottom: 16px;
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
        .feedback-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #eee;
            margin-bottom: 16px;
        }
        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }
        .feedback-header h4 { font-size: 16px; margin-bottom: 4px; }
        .feedback-meta { font-size: 13px; color: #999; }
        .feedback-message { color: #444; font-size: 14px; line-height: 1.6; margin-bottom: 12px; }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        .badge-open { background: #fff3cd; color: #856404; }
        .badge-resolved { background: #e1f5ee; color: #1D9E75; }
        .btn {
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            color: white;
            background: #1D9E75;
        }
        .empty { text-align: center; color: #999; padding: 40px; background: white; border-radius: 12px; }
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Owner: {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('owner.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Complaints & Feedback</h1>
    <p>View and resolve customer feedback</p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @forelse($feedbacks as $feedback)
        <div class="feedback-card">
            <div class="feedback-header">
                <div>
                    <h4>{{ $feedback->subject }}</h4>
                    <span class="feedback-meta">From {{ $feedback->user->name }} • {{ $feedback->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <span class="badge badge-{{ $feedback->status }}">{{ ucfirst($feedback->status) }}</span>
            </div>
            <p class="feedback-message">{{ $feedback->message }}</p>
            @if($feedback->status === 'open')
                <form method="POST" action="{{ route('owner.feedback.resolve', $feedback->id) }}">
                    @csrf
                    <button type="submit" class="btn">Mark as Resolved</button>
                </form>
            @endif
        </div>
    @empty
        <div class="empty">No feedback submitted yet.</div>
    @endforelse
</div>

</body>
</html>