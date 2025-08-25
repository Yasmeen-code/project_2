<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 text-gray-600 hover:text-gray-900 px-3 py-2">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $campaign->name }}</h2>
                    <img src="{{ $campaign->image_url }}" alt="{{ $campaign->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
                    <p class="text-gray-600 mb-4">{{ $campaign->description }}</p>
                    <p class="text-gray-600 mb-4"><strong>Status:</strong> {{ $campaign->status }}</p>
                    <p class="text-gray-600 mb-4"><strong>Target Amount:</strong> ${{ number_format($campaign->target_amount, 2) }}</p>
                    <p class="text-gray-600 mb-4"><strong>Current Amount:</strong> ${{ number_format($campaign->current_amount, 2) }}</p>

                    <form action="{{ route('donate', $campaign->id) }}" method="POST">
                        @csrf
                        <input type="number" name="amount" placeholder="Enter donation amount" required class="border rounded-lg p-2 w-full mb-2">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold transition-colors duration-200">
                            Support Campaign
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
