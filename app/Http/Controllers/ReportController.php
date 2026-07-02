<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class ReportController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Monthly report - current month
        $monthlyBookings = Booking::where('status', 'approved')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();

        $monthlyRevenue = $monthlyBookings->sum('total_price');
        $monthlyCount = $monthlyBookings->count();

        // Yearly report - current year
        $yearlyBookings = Booking::where('status', 'approved')
            ->whereYear('created_at', $currentYear)
            ->get();

        $yearlyRevenue = $yearlyBookings->sum('total_price');
        $yearlyCount = $yearlyBookings->count();

        // Monthly breakdown for the year
        $monthlyBreakdown = [];
        $monthNames = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        for ($m = 1; $m <= 12; $m++) {
            $revenue = Booking::where('status', 'approved')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $m)
                ->sum('total_price');

            $count = Booking::where('status', 'approved')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $m)
                ->count();

            $monthlyBreakdown[] = [
                'month' => $monthNames[$m],
                'revenue' => $revenue,
                'count' => $count,
            ];
        }

        // All approved bookings
        $allBookings = Booking::with('user')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.report', compact(
            'monthlyRevenue',
            'monthlyCount',
            'yearlyRevenue',
            'yearlyCount',
            'monthlyBreakdown',
            'allBookings',
            'currentYear',
            'currentMonth',
            'monthNames'
        ));
    }
}