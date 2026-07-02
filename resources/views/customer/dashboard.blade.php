<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
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
        .nav-right { display: flex; align-items: center; gap: 16px; }
        .nav-right span { color: #555; }
        .logout-btn {
            padding: 8px 16px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .container { padding: 40px; }
        .welcome {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid #eee;
        }
        .welcome h1 { font-size: 24px; margin-bottom: 8px; }
        .welcome p { color: #666; }
        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #eee;
            text-align: center;
        }
        .card h3 { font-size: 32px; font-weight: bold; color: #1D9E75; margin-bottom: 8px; }
        .card p { color: #666; font-size: 14px; }
        .actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .action-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .action-card h4 { margin-bottom: 12px; font-size: 16px; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #1D9E75;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <div class="nav-right">
        <span>Welcome, {{ Auth::user()->name }}</span>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<div class="container">

    @if(session('success'))
        <div style="background:#e1f5ee; color:#1D9E75; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px">
            {{ session('success') }}
        </div>
    @endif

    <div class="welcome">
        <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p>Here's your booking overview.</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Bookings</p>
        </div>
        <div class="card">
            <h3>{{ $upcomingStays }}</h3>
            <p>Upcoming Stays</p>
        </div>
        <div class="card">
            <h3>{{ $pastStays }}</h3>
            <p>Past Stays</p>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="action-card" style="margin-top:20px; margin-bottom:24px">
        <h4 style="margin-bottom:16px">📋 My Recent Bookings</h4>
        @if($recentBookings->isEmpty())
            <p style="color:#666; font-size:14px">No bookings yet. Click Book Now to get started!</p>
        @else
            <table style="width:100%; border-collapse:collapse; font-size:14px">
                <thead>
                    <tr style="border-bottom:2px solid #eee; text-align:left">
                        <th style="padding:10px">Check-in</th>
                        <th style="padding:10px">Check-out</th>
                        <th style="padding:10px">Guests</th>
                        <th style="padding:10px">Total</th>
                        <th style="padding:10px">Status</th>
                        <th style="padding:10px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                    <tr style="border-bottom:1px solid #eee">
                        <td style="padding:10px">{{ $booking->check_in }}</td>
                        <td style="padding:10px">{{ $booking->check_out }}</td>
                        <td style="padding:10px">{{ $booking->guests }}</td>
                        <td style="padding:10px">RM {{ $booking->total_price }}</td>
                        <td style="padding:10px">
                        <span style="
                            padding:4px 10px;
                            border-radius:20px;
                            font-size:12px;
                            background:{{ $booking->status === 'approved' ? '#e1f5ee' : ($booking->status === 'cancelled' ? '#ffe5e5' : '#fff3cd') }};
                            color:{{ $booking->status === 'approved' ? '#1D9E75' : ($booking->status === 'cancelled' ? '#ff4444' : '#856404') }};
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td style="padding:10px">
                        @if($booking->status !== 'cancelled')
                            <form method="POST" action="{{ route('booking.cancel', $booking->id) }}">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to cancel this booking?')"
                                    style="padding:4px 12px; background:#ff4444; color:white; border:none; border-radius:6px; font-size:12px; cursor:pointer;">
                                    Cancel
                                </button>
                            </form>
                        @else
                            <span style="color:#999; font-size:12px">—</span>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="actions">
        <div class="action-card">
            <h4>📅 Book a Homestay</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                Pick your dates and make an instant booking.
            </p>
            <a href="{{ route('booking.create') }}" class="btn">Book Now</a>
        </div>
        <div class="action-card">
            <h4>💬 Complaints & Feedback</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                Have an issue or feedback? Let us know.
            </p>
            <a href="{{ route('feedback.create') }}" class="btn">Submit Feedback</a>
        </div>
    </div>

</div>

</body>
</html>