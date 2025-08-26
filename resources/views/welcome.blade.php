<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <a href="{{ route('home') }}" class="flex items-center">
                                <x-application-logo class="block h-9 w-auto fill-current text-blue-600" />
                                <span class="ml-3 text-xl font-bold text-gray-800">CampaignHub</span>
                            </a>
                        </div>
                    </div>

                  <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition-colors duration-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium transition-colors duration-200">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium transition-colors duration-200">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <section class="relative py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="max-w-3xl mx-auto">
                        <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Make a Difference with Every Campaign
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Join our platform to support meaningful causes and create positive change in communities around the world.
                        </p>
                        @guest
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Get Started
                            </a>
                            <a href="#campaigns" class="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 font-semibold text-lg transition-all duration-300">
                                Explore Campaigns
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            <section class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Browse by Category</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Explore campaigns based on causes that matter most to you
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        @foreach($categories as $key => $category)
                        <a href="{{ route('campaigns.index') }}?category={{ $key }}" 
                           class="bg-white rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 transform hover:scale-105 border border-gray-200 hover:border-blue-300">
                            <div class="text-2xl mb-2">{{ $category['icon'] }}</div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $category['name'] }}</h3>
                            <p class="text-xs text-gray-600">{{ $category['count'] }} campaigns</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Campaigns Section -->
            <section id="campaigns" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest Campaigns</h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Discover ongoing and upcoming campaigns that need your support to make a real impact.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($campaigns as $campaign)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $campaign->getStatusBadgeClass() }}">
                                        {{ $campaign->status }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $campaign->start_date->format('M d, Y') }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $campaign->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $campaign->description }}</p>
                                
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Progress</span>
                                        <span>{{ number_format($campaign->getProgressPercentage(), 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                                             style="width: {{ $campaign->getProgressPercentage() }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-sm text-gray-600 mb-4">
                                    <span>Raised: ${{ number_format($campaign->current_amount) }}</span>
                                    <span>Goal: ${{ number_format($campaign->target_amount) }}</span>
                                </div>
                                
                                <a href="{{ route('campaign.show', $campaign->id) }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold transition-colors duration-200 text-center">
                                    Show Campaign
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- View All Campaigns Button -->
                    @if($totalCampaigns > 6)
                    <div class="text-center mt-12">
                        <a href="{{ route('campaigns.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 font-semibold text-lg transition-all duration-300">
                            View All Campaigns
                        </a>
                    </div>
                    @endif

                    @guest
                    <div class="text-center mt-16">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-4">Ready to Make an Impact?</h3>
                            <p class="text-blue-100 mb-6">Join thousands of supporters making a difference every day</p>
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 font-semibold text-lg transition-all duration-300">
                                Join Our Community
                            </a>
                        </div>
                    </div>
                    @endguest
                </div>
            </section>

            <!-- About Us Section -->
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">About CampaignHub</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Empowering communities through meaningful campaigns and collective support
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Mission</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                CampaignHub is dedicated to connecting passionate individuals and organizations 
                                with causes that matter. We believe in the power of collective action to create 
                                positive change in communities around the world.
                            </p>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Our platform provides a secure and transparent way for campaign creators to 
                                share their stories and for supporters to contribute to causes they care about.
                            </p>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalCampaignsCount }}+</div>
                                    <div class="text-sm text-gray-600">Campaigns Supported</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-blue-600 mb-2">${{ number_format($totalFundsRaised) }}+</div>
                                    <div class="text-sm text-gray-600">Total Funds Raised</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-2xl p-8 shadow-xl">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Why Choose Us?</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-gray-900">Transparent Process</h4>
                                        <p class="text-gray-600 text-sm">Every donation is tracked and reported with full transparency</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-gray-900">Secure Payments</h4>
                                        <p class="text-gray-600 text-sm">Industry-standard security for all transactions</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-gray-900">24/7 Support</h4>
                                        <p class="text-gray-600 text-sm">Dedicated support team available around the clock</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-gray-900">Global Reach</h4>
                                        <p class="text-gray-600 text-sm">Supporting campaigns from communities worldwide</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; 2024 CampaignHub. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
