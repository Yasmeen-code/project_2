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

        return view('welcome', compact('campaigns'));
    }
}
