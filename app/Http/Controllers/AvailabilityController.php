<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockedDate;

class AvailabilityController extends Controller
{
    public function index()
    {
        $blockedDates = BlockedDate::orderBy('date')->get();
        return view('owner.availability', compact('blockedDates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:today|unique:blocked_dates,date',
            'reason' => 'nullable|string|max:255',
        ]);

        BlockedDate::create([
            'date' => $request->date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('owner.availability')
                         ->with('success', 'Date blocked successfully!');
    }

    public function destroy($id)
    {
        BlockedDate::findOrFail($id)->delete();
        return redirect()->route('owner.availability')
                         ->with('success', 'Date unblocked successfully!');
    }
}