<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Campaigns - {{ config('app.name', 'Laravel') }}</title>
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
            <!-- Campaigns Section -->
            <section class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            @if(request()->has('category') && request()->category)
                                {{ ucfirst(str_replace('_', ' ', request()->category)) }} Campaigns
                            @else
                                All Campaigns
                            @endif
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            @if(request()->has('category') && request()->category)
                                Browse {{ strtolower(request()->category) }} campaigns that need your support
                            @else
                                Browse through all available campaigns and support the causes that matter to you
                            @endif
                        </p>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-12">
                        <div class="flex flex-wrap justify-center gap-3">
                            <a href="{{ route('campaigns.index') }}" 
                               class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 
                                      {{ !request()->has('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                All Categories
                            </a>
                            @foreach($categories as $key => $category)
                            <a href="{{ route('campaigns.index') }}?category={{ $key }}" 
                               class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 
                                      {{ request()->has('category') && request()->category == $key ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                {{ $category['icon'] }} {{ $category['name'] }}
                                <span class="ml-1 text-xs bg-white/20 px-2 py-1 rounded-full">
                                    {{ $categoryCounts[$key] ?? 0 }}
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Campaigns Grid -->
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
                                    Support Campaign
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $campaigns->links() }}
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 font-semibold text-lg transition-all duration-300">
                            Back to Home
                        </a>
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
