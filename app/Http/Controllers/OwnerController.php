<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class OwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'owner') {
            return redirect()->route('customer.dashboard');
        }

        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $monthlyRevenue = Booking::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');
        
        $openComplaints = \App\Models\Feedback::where('status', 'open')->count();

        $recentBookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('owner.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'monthlyRevenue',
            'openComplaints',
            'recentBookings'
        ));
    }

    // Show all bookings page
    public function bookings()
    {
        $bookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.bookings', compact('bookings'));
    }

    // Approve a booking
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->back()->with('success', 'Booking approved!');
    }

    // Cancel a booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled!');
    }
}