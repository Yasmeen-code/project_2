<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($donatedCampaigns->count() > 0)
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Campaigns You've Supported</h3>
                    <p class="text-gray-600">Thank you for your generous contributions to these campaigns!</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($donatedCampaigns as $campaign)
                        @php
                            $userDonations = $campaign->donations->where('user_id', auth()->id());
                            $totalDonated = $userDonations->sum('amount');
                        @endphp
                        
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                                        <span>Your Total Donation</span>
                                        <span class="font-semibold text-green-600">${{ number_format($totalDonated, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Campaign Progress</span>
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
                                
                                <div class="flex space-x-3">
                                    <a href="{{ route('campaign.show', $campaign->id) }}" 
                                       class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-semibold transition-colors duration-200 text-center">
                                        View Campaign
                                    </a>
                                    @if($campaign->status === 'active')
                                        <a href="{{ route('campaign.show', $campaign->id) }}#donate" 
                                           class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 font-semibold transition-colors duration-200 text-center">
                                            Donate Again
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Campaigns Yet</h3>
                        <p class="text-gray-600 mb-4">You haven't donated to any campaigns yet.</p>
                        <a href="{{ route('campaigns.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 font-semibold text-lg transition-all duration-300">
                            Explore Campaigns
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
