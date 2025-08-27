<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Donation - CampaignHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57, #ff9ff3, #54a0ff);
            border-radius: 50%;
            animation: fall linear forwards;
        }
        
        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-green-50 to-blue-100 min-h-screen">
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-blue-600" />
                        <span class="ml-3 text-xl font-bold text-gray-800">CampaignHub</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex items-center justify-center min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Thank You for Your Generosity!
            </h1>
            
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                Your donation of <strong class="text-green-600">${{ number_format(session('donation_amount', 0), 2) }}</strong> 
                to <strong class="text-blue-600">{{ session('campaign_name', 'the campaign') }}</strong> 
                will make a real difference in people's lives.
            </p>

            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your Impact</h2>
                <p class="text-gray-600 mb-4">
                    Because of supporters like you, we're one step closer to achieving our goal. 
                    Every contribution helps create positive change in our community.
                </p>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ session('total_donors', 0) }}+</div>
                        <div class="text-sm text-gray-600">Total Supporters</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">${{ number_format(session('total_raised', 0)) }}</div>
                        <div class="text-sm text-gray-600">Total Raised</div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="space-y-4">
                <a href="{{ route('home') }}" 
                   class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Return to Home
                </a>
                
                <a href="{{ route('campaigns.index') }}" 
                   class="inline-block ml-4 border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-xl hover:bg-blue-600 hover:text-white font-semibold transition-all duration-300">
                    Explore More Campaigns
                </a>
            </div>

            <!-- Share Options -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <p class="text-gray-600 mb-4">Share your support with others:</p>
                <div class="flex justify-center space-x-4">
                    <button class="p-3 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-极s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button class="p-3 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3', '#54a0ff'];
            
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    document.body.appendChild(confetti);
                    
                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }, i * 100);
            }
        });
    </script>
</body>
</html>
