<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->name }} - CampaignHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-blue-600" />
                            <span class="ml-3 text-xl font-bold text-gray-800">CampaignHub</span>
                        </a>
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
            <!-- Hero Section -->
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4 inline-block">
                            {{ $campaign->category ? ucfirst(str_replace('_', ' ', $campaign->category)) : 'General' }}
                        </span>
                        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">{{ $campaign->name }}</h1>
                        <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                            {{ $campaign->description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Campaign Details -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Campaign Image -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                            <img src="{{ $campaign->image_url }}" alt="{{ $campaign->name }}" class="w-full h-96 object-cover">
                        </div>

                        <!-- Campaign Story -->
                        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Campaign Story</h2>
                            <div class="prose prose-lg text-gray-600 leading-relaxed">
                                <p>{{ $campaign->description }}</p>
                                <p class="mt-4">Every contribution makes a significant impact. Your support helps us achieve our goals and create positive change in the community.</p>
                            </div>
                        </div>

                        <!-- Updates Section -->
                        <div class="bg-white rounded-2xl shadow-xl p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest Updates</h2>
                            <div class="space-y-4">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <div class="w-3 h-3 bg-blue-600 rounded-full mr-3"></div>
                                        <span class="text-sm font-semibold text-blue-600">New Update</span>
                                        <span class="ml-auto text-sm text-gray-500">2 days ago</span>
                                    </div>
                                    <p class="text-gray-700">We've reached 50% of our funding goal! Thank you to all our amazing supporters.</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <div class="w-3 h-3 bg-gray-400 rounded-full mr-3"></div>
                                        <span class="text-sm font-semibold text-gray-600">Campaign Launch</span>
                                        <span class="ml-auto text-sm text-gray-500">1 week ago</span>
                                    </div>
                                    <p class="text-gray-700">Our campaign is officially live! Join us in making a difference.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Progress Card -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Campaign Progress</h3>
                            
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Raised</span>
                                    <span>{{ number_format($campaign->getProgressPercentage(), 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-3 rounded-full transition-all duration-300" 
                                         style="width: {{ $campaign->getProgressPercentage() }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">${{ number_format($campaign->current_amount) }}</div>
                                    <div class="text-sm text-gray-600">Raised</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">${{ number_format($campaign->target_amount) }}</div>
                                    <div class="text-sm text-gray-600">Goal</div>
                                </div>
                            </div>

                            <div class="text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $campaign->getStatusBadgeClass() }}">
                                    {{ $campaign->status }}
                                </span>
                            </div>
                        </div>

                        <!-- Donation Form -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Make a Difference</h3>
                            <form action="{{ route('donate', $campaign->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Donation Amount</label>
                                    <input type="number" name="amount" id="amount" 
                                           placeholder="Enter amount" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-4 rounded-xl hover:from-blue-700 hover:to-indigo-800 font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Support This Campaign
                                </button>
                            </form>
                        </div>

                        <!-- Campaign Info -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Campaign Details</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-600">Started: {{ $campaign->start_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="text-gray-600">Supporters: {{ $campaign->donations()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; 2024 CampaignHub. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
