<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PriceController extends Controller
{
    public function index()
    {
        $price = Setting::get('price_per_night', 180);
        return view('owner.price', compact('price'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:1',
        ]);

        Setting::updateOrCreate(
            ['key' => 'price_per_night'],
            ['value' => $request->price]
        );

        return redirect()->route('owner.price')
                         ->with('success', 'Price updated successfully!');
    }
}