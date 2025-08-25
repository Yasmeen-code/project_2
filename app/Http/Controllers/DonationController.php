<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Store a new donation.
     */
    public function store(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Create the donation
        $donation = Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => $campaign->id,
            'amount' => $validated['amount'],
            'status' => 'completed', // For now, we'll assume payment is completed
        ]);

        // Update the campaign's current amount
        $campaign->increment('current_amount', $validated['amount']);

        return redirect()->route('home')
            ->with('success', 'Thank you for your donation of $' . number_format($validated['amount']) . '!');
    }
}
