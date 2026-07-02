<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard</title>
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
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            grid-template-columns: repeat(3, 1fr);
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
        <span>Owner: {{ Auth::user()->name }}</span>
        <form method="POST" action="/logout" style="display:inline">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

    <div class="container">
        <div class="welcome">
            <h1>Owner Dashboard 🏡</h1>
            <p>Manage your homestay, bookings, and revenue.</p>
        </div>

        <div class="cards">
        <div class="card">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Bookings</p>
    </div>
    <div class="card">
        <h3>{{ $pendingBookings }}</h3>
        <p>Pending Approval</p>
    </div>
    <div class="card">
        <h3>RM {{ number_format($monthlyRevenue, 2) }}</h3>
        <p>Monthly Revenue</p>
    </div>
        <div class="card">
        <h3>{{ $openComplaints }}</h3>
        <p>Complaints</p>
    </div>
    </div>

    <div class="actions">
        <div class="action-card">
            <h4>📋 Manage Bookings</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                Approve or cancel customer bookings.
            </p>
            <a href="{{ route('owner.bookings') }}" class="btn">View Bookings</a>
        </div>
        <div class="action-card">
            <h4>📊 Generate Report</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                View monthly and yearly revenue reports.
            </p>
            <a href="{{ route('owner.report') }}" class="btn">View Reports</a>
        </div>
        <div class="action-card">
            <h4>💰 Manage Price</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                Update your homestay pricing.
            </p>
            <a href="{{ route('owner.price') }}" class="btn">Update Price</a>
        </div>
        <div class="action-card">
            <h4>📅 Availability Calendar</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                Manage your available dates.
            </p>
            <a href="{{ route('owner.availability') }}" class="btn">Manage Calendar</a>
        </div>
        <div class="action-card">
            <h4>💬 Complaints & Feedback</h4>
            <p style="color:#666; margin-bottom:16px; font-size:14px">
                View and resolve customer feedback.
            </p>
            <a href="{{ route('owner.feedback') }}" class="btn">View Feedback</a>
        </div>
    </div>
</div>

</body>
</html>