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

        $donation = Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => $campaign->id,
            'amount' => $validated['amount'],
            'status' => 'completed', 
        ]);

        $campaign->increment('current_amount', $validated['amount']);
        $campaign->updateStatus();

        return redirect()->route('thank.you')
            ->with('donation_amount', $validated['amount'])
            ->with('campaign_name', $campaign->name)
            ->with('total_donors', $campaign->donations()->count())
            ->with('total_raised', $campaign->current_amount);
    }

    /**
     * Show thank you page
     */
    public function thankYou()
    {
        if (!session()->has('donation_amount')) {
            return redirect()->route('home');
        }

        return view('thank-you');
    }
}
