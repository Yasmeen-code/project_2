<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller

{
    /**
     * Display the home page with campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::latest()
            ->take(6)
            ->get();

        $totalCampaigns = Campaign::count();

        $totalCampaignsCount = Campaign::count();
        $totalFundsRaised = Campaign::sum('current_amount');

        $categoryCounts = Campaign::select('category')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');

        $categories = [
            'education' => [
                'name' => 'Education',
                'icon' => '📚',
                'count' => $categoryCounts['education'] ?? 0
            ],
            'healthcare' => [
                'name' => 'Healthcare',
                'icon' => '🏥',
                'count' => $categoryCounts['healthcare'] ?? 0
            ],
            'environment' => [
                'name' => 'Environment',
                'icon' => '🌱',
                'count' => $categoryCounts['environment'] ?? 0
            ],
            'emergency_relief' => [
                'name' => 'Emergency Relief',
                'icon' => '🚨',
                'count' => $categoryCounts['emergency_relief'] ?? 0
            ],
            'community' => [
                'name' => 'Community',
                'icon' => '👥',
                'count' => $categoryCounts['community'] ?? 0
            ]
        ];

        return view('welcome', compact('campaigns', 'totalCampaigns', 'categories', 'totalCampaignsCount', 'totalFundsRaised'));
    }
}
