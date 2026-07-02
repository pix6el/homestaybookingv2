<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    // Show booking form
    public function create()
    {
        $price = \App\Models\Setting::get('price_per_night', 180);
        return view('customer.booking', compact('price'));
    }

    // Save booking to database
    public function store(Request $request)
    {
        $request->validate([
    'check_in' => 'required|date|after:today',
    'check_out' => 'required|date|after:check_in',
    'guests' => 'required|integer|min:1|max:10',
    ]);

    // Check if any date in the range is blocked
    $checkIn = \Carbon\Carbon::parse($request->check_in);
    $checkOut = \Carbon\Carbon::parse($request->check_out);

    $blockedDates = \App\Models\BlockedDate::whereBetween('date', [
        $checkIn->format('Y-m-d'),
        $checkOut->format('Y-m-d')
    ])->get();

    if ($blockedDates->isNotEmpty()) {
        $dates = $blockedDates->map(fn($b) => $b->date->format('d M Y'))->join(', ');
        return back()->withErrors([
            'check_in' => 'These dates are unavailable: ' . $dates
        ])->withInput();
    }

        // Calculate total price (RM180 per night)
        $checkIn = \Carbon\Carbon::parse($request->check_in);
        $checkOut = \Carbon\Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        $pricePerNight = \App\Models\Setting::get('price_per_night', 180);
        $totalPrice = $nights * $pricePerNight;

        Booking::create([
            'user_id' => Auth::id(),
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.show', $booking->id);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Make sure this booking belongs to the logged in customer
        if ($booking->user_id !== Auth::id()) {
        return redirect()->route('customer.dashboard')
                         ->with('error', 'Unauthorized action.');
        }

        // Only allow cancelling pending or approved bookings
        if ($booking->status === 'cancelled') {
        return redirect()->route('customer.dashboard')
                         ->with('error', 'Booking is already cancelled.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('customer.dashboard')
                     ->with('success', 'Booking cancelled successfully!');
    }
}
