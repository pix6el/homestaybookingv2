<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // Show feedback form
    public function create()
    {
        return view('customer.feedback');
    }

    // Save feedback
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('customer.dashboard')
                         ->with('success', 'Feedback submitted successfully!');
    }

    // Owner views all feedback
    public function index()
    {
        $feedbacks = Feedback::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.feedback', compact('feedbacks'));
    }

    // Owner marks feedback as resolved
    public function resolve($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 'resolved';
        $feedback->save();

        return redirect()->back()->with('success', 'Marked as resolved!');
    }
}