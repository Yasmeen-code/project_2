<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display all campaigns.
     */
    public function index(Request $request)
    {
        $query = Campaign::latest();
        
        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $campaigns = $query->paginate(12);
        
        // Get category counts for filter display
        $categoryCounts = Campaign::select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');
            
        $categories = [
            'education' => ['name' => 'Education', 'icon' => '📚'],
            'healthcare' => ['name' => 'Healthcare', 'icon' => '🏥'],
            'environment' => ['name' => 'Environment', 'icon' => '🌱'],
            'emergency_relief' => ['name' => 'Emergency Relief', 'icon' => '🚨'],
            'community' => ['name' => 'Community', 'icon' => '👥']
        ];
        
        return view('campaigns.index', compact('campaigns', 'categories', 'categoryCounts'));
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return view('showcampaign', compact('campaign'));
    }
}
