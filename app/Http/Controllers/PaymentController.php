<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    // Show payment page
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        // Make sure this booking belongs to logged in user
        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('customer.dashboard');
        }

        return view('customer.payment', compact('booking'));
    }

    // Process payment
    public function process(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:card,qr',
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('customer.dashboard');
        }

        $booking->payment_method = $request->payment_method;
        $booking->payment_status = 'paid';
        $booking->save();

        return redirect()->route('payment.success', $booking->id);
    }

    // Payment success page
    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        return view('customer.payment-success', compact('booking'));
    }
}