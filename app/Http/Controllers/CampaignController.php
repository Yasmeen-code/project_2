<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display all campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(12);
        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return view('showcampaign', compact('campaign'));
    }
}
