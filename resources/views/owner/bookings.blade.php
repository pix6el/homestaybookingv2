<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
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
        table {
            width: 100%;
            background: white;
            border-radius: 12px;
            border-collapse: collapse;
            overflow: hidden;
            border: 1px solid #eee;
        }
        th {
            background: #fafafa;
            padding: 14px;
            text-align: left;
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
        }
        td {
            padding: 14px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-approved { background: #e1f5ee; color: #1D9E75; }
        .badge-cancelled { background: #ffe5e5; color: #ff4444; }
        .btn {
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            color: white;
            margin-right: 6px;
        }
        .btn-approve { background: #1D9E75; }
        .btn-cancel { background: #ff4444; }
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Owner: {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('owner.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Manage Bookings</h1>
    <p>Approve or cancel customer booking requests</p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Guests</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->check_in }}</td>
                <td>{{ $booking->check_out }}</td>
                <td>{{ $booking->guests }}</td>
                <td>RM {{ number_format($booking->total_price, 2) }}</td>
                <td>
                    <span class="badge badge-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>
                    @if($booking->status === 'pending')
                        <form method="POST" action="{{ route('owner.bookings.approve', $booking->id) }}" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-approve">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('owner.bookings.cancel', $booking->id) }}" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-cancel">Cancel</button>
                        </form>
                    @else
                        <span style="color:#999; font-size:13px">No action</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#999; padding:30px">
                    No bookings yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>