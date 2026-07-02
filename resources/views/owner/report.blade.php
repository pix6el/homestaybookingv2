<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Revenue Report</title>
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
            margin-bottom: 24px;
            color: #1D9E75;
            text-decoration: none;
            font-size: 14px;
        }
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }
        .summary-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #eee;
            text-align: center;
        }
        .summary-card h3 {
            font-size: 28px;
            font-weight: bold;
            color: #1D9E75;
            margin-bottom: 8px;
        }
        .summary-card p { color: #666; font-size: 14px; margin: 0; }
        .section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #eee;
            margin-bottom: 24px;
        }
        .section h2 { font-size: 20px; margin-bottom: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th {
            background: #fafafa;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            border-bottom: 1px solid #eee;
        }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .bar-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .bar {
            height: 20px;
            background: #1D9E75;
            border-radius: 4px;
            min-width: 4px;
            transition: width 0.3s;
        }
        .bar-label { font-size: 13px; color: #333; white-space: nowrap; }
        .empty { color: #999; text-align: center; padding: 20px; }
        .badge-approved {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #e1f5ee;
            color: #1D9E75;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">🏠 Rlinda Enterprise</div>
    <span style="color:#555">Owner: {{ Auth::user()->name }}</span>
</nav>

<div class="container">
    <a href="{{ route('owner.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>Revenue Report</h1>
    <p>Financial overview for {{ $currentYear }}</p>

    {{-- Summary Cards --}}
    <div class="summary-cards">
        <div class="summary-card">
            <h3>RM {{ number_format($monthlyRevenue, 2) }}</h3>
            <p>This Month's Revenue</p>
        </div>
        <div class="summary-card">
            <h3>{{ $monthlyCount }}</h3>
            <p>This Month's Bookings</p>
        </div>
        <div class="summary-card">
            <h3>RM {{ number_format($yearlyRevenue, 2) }}</h3>
            <p>This Year's Revenue</p>
        </div>
        <div class="summary-card">
            <h3>{{ $yearlyCount }}</h3>
            <p>This Year's Bookings</p>
        </div>
    </div>

    {{-- Monthly Breakdown --}}
    <div class="section">
        <h2>📊 Monthly Breakdown — {{ $currentYear }}</h2>
        @php $maxRevenue = max(array_column($monthlyBreakdown, 'revenue')) ?: 1; @endphp
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Bookings</th>
                    <th>Revenue</th>
                    <th>Chart</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyBreakdown as $month)
                <tr>
                    <td>{{ $month['month'] }}</td>
                    <td>{{ $month['count'] }}</td>
                    <td>RM {{ number_format($month['revenue'], 2) }}</td>
                    <td>
                        <div class="bar-container">
                            <div class="bar" style="width: {{ ($month['revenue'] / $maxRevenue) * 200 }}px"></div>
                            @if($month['revenue'] > 0)
                                <span class="bar-label">RM {{ number_format($month['revenue'], 0) }}</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- All Approved Bookings --}}
    <div class="section">
        <h2>📋 All Approved Bookings</h2>
        @if($allBookings->isEmpty())
            <div class="empty">No approved bookings yet.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td>RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge-approved">Approved</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

</body>
</html>