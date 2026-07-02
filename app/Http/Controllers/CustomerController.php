<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'customer') {
            return redirect()->route('owner.dashboard');
        }

        $totalBookings = Booking::where('user_id', $user->id)->count();
        
        $upcomingStays = Booking::where('user_id', $user->id)
            ->where('check_in', '>=', today())
            ->where('status', '!=', 'cancelled')
            ->count();
        
        $pastStays = Booking::where('user_id', $user->id)
            ->where('check_out', '<', today())
            ->count();

        $recentBookings = Booking::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalBookings',
            'upcomingStays', 
            'pastStays',
            'recentBookings'
        ));
    }
}