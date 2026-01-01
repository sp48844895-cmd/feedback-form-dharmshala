@extends('layouts.app')

@section('title', 'Admin Feedback Report')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 max-w-7xl">
    <!-- Minimal Header -->
    <div class="mb-6 sm:mb-8">
        <h1 class="text-3xl sm:text-4xl font-light text-gray-800 tracking-tight mb-2">Feedback Report</h1>
        <p class="text-gray-500 text-sm sm:text-base">Guest feedback overview</p>
    </div>

    <!-- Count Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Count -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Feedbacks</p>
                    <p class="text-3xl font-bold">{{ number_format($totalCount) }}</p>
                    <p class="text-blue-100 text-xs mt-1">कुल फीडबैक</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Week Count -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">This Week</p>
                    <p class="text-3xl font-bold">{{ number_format($weekCount) }}</p>
                    <p class="text-green-100 text-xs mt-1">इस सप्ताह</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Month Count -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">This Month</p>
                    <p class="text-3xl font-bold">{{ number_format($monthCount) }}</p>
                    <p class="text-purple-100 text-xs mt-1">इस महीने</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Current/Filtered Count -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-5 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">
                        @if(request('search') || request('filter'))
                            Current Results
                        @else
                            Showing
                        @endif
                    </p>
                    <p class="text-3xl font-bold">{{ number_format($currentCount) }}</p>
                    <p class="text-orange-100 text-xs mt-1">
                        @if(request('search'))
                            Search Results / खोज परिणाम
                        @elseif(request('filter') == 'week')
                            Week Filter / सप्ताह फ़िल्टर
                        @elseif(request('filter') == 'month')
                            Month Filter / महीना फ़िल्टर
                        @else
                            All Results / सभी परिणाम
                        @endif
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if(request('search') && $searchCount > 0)
    <!-- Search Count Badge -->
    <div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <p class="text-sm text-blue-800">
            <span class="font-semibold">{{ number_format($searchCount) }}</span> result(s) found for "<span class="font-semibold">{{ request('search') }}</span>"
            <span class="text-blue-600">/ "<span class="font-semibold">{{ request('search') }}</span>" के लिए <span class="font-semibold">{{ number_format($searchCount) }}</span> परिणाम मिले</span>
        </p>
    </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-4 sm:p-6 mb-6">
        <form method="GET" action="{{ route('admin.list') }}" class="space-y-4">
            <!-- Search Input -->
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by name, mobile, or suggestions / नाम, मोबाइल या सुझाव से खोजें"
                    class="w-full px-5 py-3 pl-12 bg-white border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm"
                >
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Buttons (Desktop/Tablet) -->
            <div class="hidden md:flex flex-wrap items-center gap-3">
                <span class="text-sm font-medium text-gray-700">Filter:</span>
                @php
                    // Get all query parameters except filter
                    $queryParams = request()->except('filter');
                    // Add new filter value
                    $weekParams = array_merge($queryParams, ['filter' => 'week']);
                    $monthParams = array_merge($queryParams, ['filter' => 'month']);
                @endphp
                <a 
                    href="{{ route('admin.list', $weekParams) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request('filter') == 'week' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                >
                    This Week / इस सप्ताह
                </a>
                <a 
                    href="{{ route('admin.list', $monthParams) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request('filter') == 'month' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                >
                    This Month / इस महीने
                </a>
                <a 
                    href="{{ route('admin.list', request()->except('filter')) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ !request('filter') ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                >
                    All / सभी
                </a>
                @if(request('search') || request('filter'))
                <a 
                    href="{{ route('admin.list') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 transition-all duration-200"
                >
                    Clear / साफ करें
                </a>
                @endif
            </div>

            <!-- Filter Dropdown (Mobile Only) -->
            <div class="md:hidden space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter / फ़िल्टर</label>
                    <select 
                        name="filter" 
                        id="filterSelect"
                        onchange="handleFilterChange(this)"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 outline-none text-sm text-gray-800 shadow-sm"
                    >
                        <option value="" {{ !request('filter') ? 'selected' : '' }}>All / सभी</option>
                        <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>This Week / इस सप्ताह</option>
                        <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month / इस महीने</option>
                    </select>
                </div>
                @if(request('search') || request('filter'))
                <a 
                    href="{{ route('admin.list') }}"
                    class="block w-full px-4 py-3 text-center rounded-xl text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 transition-all duration-200"
                >
                    Clear / साफ करें
                </a>
                @endif
            </div>

            <!-- Hidden field to preserve search when filtering -->
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
        </form>
    </div>

    <script>
    // Handle filter change - remove old filter first, then apply new one
    function handleFilterChange(selectElement) {
        const form = selectElement.form;
        const newFilterValue = selectElement.value;
        
        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        // Remove old filter parameter
        urlParams.delete('filter');
        
        // Add new filter value if not empty
        if (newFilterValue) {
            urlParams.set('filter', newFilterValue);
        }
        
        // Preserve search parameter if exists
        const searchValue = urlParams.get('search');
        if (searchValue) {
            urlParams.set('search', searchValue);
        }
        
        // Build new URL
        const newUrl = '{{ route("admin.list") }}' + (urlParams.toString() ? '?' + urlParams.toString() : '');
        
        // Redirect to new URL
        window.location.href = newUrl;
    }
    </script>

    <!-- Cards Grid Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 sm:gap-5">
        @forelse($feedbacks as $feedback)
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-all duration-300">
            <div class="space-y-4">
                <div class="flex justify-between items-start pb-3 border-b border-gray-200">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 mb-1">{{ $feedback->name ?? 'Anonymous / अज्ञात' }}</h3>
                        <p class="text-sm text-gray-600">{{ $feedback->mobile }}</p>
                    </div>
                    @php
                        $overallColors = [
                            'excellent' => 'bg-green-100 text-green-800',
                            'good' => 'bg-blue-100 text-blue-800',
                            'average' => 'bg-yellow-100 text-yellow-800',
                            'poor' => 'bg-red-100 text-red-800'
                        ];
                        $overallLabels = [
                            'excellent' => 'Excellent',
                            'good' => 'Good',
                            'average' => 'Average',
                            'poor' => 'Poor'
                        ];
                        $color = $overallColors[$feedback->overall_experience] ?? 'bg-gray-100 text-gray-800';
                        $label = $overallLabels[$feedback->overall_experience] ?? ucfirst($feedback->overall_experience);
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $color }}">{{ $label }}</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide block mb-1">Cleanliness</span>
                        @php
                            $cleanLabels = [
                                'very_satisfied' => 'Very Satisfied',
                                'satisfied' => 'Satisfied',
                                'somewhat_satisfied' => 'Somewhat',
                                'not_satisfied' => 'Not Satisfied'
                            ];
                            echo '<p class="text-sm font-medium text-gray-900">' . ($cleanLabels[$feedback->cleanliness] ?? ucfirst(str_replace('_', ' ', $feedback->cleanliness))) . '</p>';
                        @endphp
                    </div>
                    <div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide block mb-1">Staff</span>
                        @php
                            $staffLabels = [
                                'very_good' => 'Very Good',
                                'good' => 'Good',
                                'average' => 'Average',
                                'poor' => 'Poor'
                            ];
                            echo '<p class="text-sm font-medium text-gray-900">' . ($staffLabels[$feedback->staff_behaviour] ?? ucfirst(str_replace('_', ' ', $feedback->staff_behaviour))) . '</p>';
                        @endphp
                    </div>
                    <div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide block mb-1">Room</span>
                        @php
                            $roomLabels = [
                                'excellent' => 'Excellent',
                                'good' => 'Good',
                                'average' => 'Average',
                                'poor' => 'Poor'
                            ];
                            echo '<p class="text-sm font-medium text-gray-900">' . ($roomLabels[$feedback->room_condition] ?? ucfirst($feedback->room_condition)) . '</p>';
                        @endphp
                    </div>
                    <div>
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide block mb-1">Recommend</span>
                        @php
                            $recommendColor = $feedback->recommend === 'yes' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800';
                            $recommendLabel = ucfirst($feedback->recommend);
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $recommendColor }}">{{ $recommendLabel }}</span>
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-200">
                    <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="inline-flex items-center gap-2 w-full justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Full Details
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-8 text-center">
            @if(request('search') || request('filter'))
                <p class="text-sm text-gray-500 mb-2">No feedback found matching your search criteria.</p>
                <p class="text-xs text-gray-400">कोई फीडबैक नहीं मिला जो आपकी खोज मानदंड से मेल खाता हो।</p>
            @else
                <p class="text-sm text-gray-500">No feedback submissions yet.</p>
                <p class="text-xs text-gray-400">अभी तक कोई फीडबैक प्रस्तुत नहीं किया गया है।</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View (Hidden on smaller screens, shown only on large screens) -->
    <div class="hidden lg:block mt-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Mobile</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Overall Experience</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Cleanliness</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Staff</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Recommend</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $feedback->name ?? 'Anonymous' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $feedback->mobile }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                @php
                                    $overallColors = [
                                        'excellent' => 'bg-green-100 text-green-800',
                                        'good' => 'bg-blue-100 text-blue-800',
                                        'average' => 'bg-yellow-100 text-yellow-800',
                                        'poor' => 'bg-red-100 text-red-800'
                                    ];
                                    $overallLabels = [
                                        'excellent' => 'Excellent',
                                        'good' => 'Good',
                                        'average' => 'Average',
                                        'poor' => 'Poor'
                                    ];
                                    $color = $overallColors[$feedback->overall_experience] ?? 'bg-gray-100 text-gray-800';
                                    $label = $overallLabels[$feedback->overall_experience] ?? ucfirst($feedback->overall_experience);
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">{{ $label }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                @php
                                    $cleanLabels = [
                                        'very_satisfied' => 'Very Satisfied',
                                        'satisfied' => 'Satisfied',
                                        'somewhat_satisfied' => 'Somewhat Satisfied',
                                        'not_satisfied' => 'Not Satisfied'
                                    ];
                                    echo $cleanLabels[$feedback->cleanliness] ?? ucfirst(str_replace('_', ' ', $feedback->cleanliness));
                                @endphp
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                @php
                                    $staffLabels = [
                                        'very_good' => 'Very Good',
                                        'good' => 'Good',
                                        'average' => 'Average',
                                        'poor' => 'Poor'
                                    ];
                                    echo $staffLabels[$feedback->staff_behaviour] ?? ucfirst(str_replace('_', ' ', $feedback->staff_behaviour));
                                @endphp
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                @php
                                    $recommendColor = $feedback->recommend === 'yes' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800';
                                    $recommendLabel = ucfirst($feedback->recommend);
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $recommendColor }}">{{ $recommendLabel }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-xs font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                @if(request('search') || request('filter'))
                                    <p class="text-sm text-gray-500 mb-1">No feedback found matching your search criteria.</p>
                                    <p class="text-xs text-gray-400">कोई फीडबैक नहीं मिला जो आपकी खोज मानदंड से मेल खाता हो।</p>
                                @else
                                    <p class="text-sm text-gray-500">No feedback submissions yet.</p>
                                    <p class="text-xs text-gray-400">अभी तक कोई फीडबैक प्रस्तुत नहीं किया गया है।</p>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($feedbacks->hasPages())
    <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-4 sm:p-6">
        <!-- Mobile View: Simplified Pagination -->
        <div class="md:hidden space-y-4">
            <div class="text-center text-xs text-gray-600">
                Page <span class="font-semibold text-gray-800">{{ $feedbacks->currentPage() }}</span> of <span class="font-semibold text-gray-800">{{ $feedbacks->lastPage() }}</span>
            </div>
            <div class="flex items-center justify-between gap-2">
                <!-- Previous Button -->
                @if($feedbacks->onFirstPage())
                    <span class="flex-1 px-3 py-2.5 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm font-medium text-center">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </span>
                @else
                    <a href="{{ $feedbacks->previousPageUrl() }}" class="flex-1 px-3 py-2.5 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all text-sm font-medium shadow-sm text-center flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </a>
                @endif

                <!-- Current Page Badge -->
                <div class="px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-bold shadow-md min-w-[50px] text-center">
                    {{ $feedbacks->currentPage() }}
                </div>

                <!-- Next Button -->
                @if($feedbacks->hasMorePages())
                    <a href="{{ $feedbacks->nextPageUrl() }}" class="flex-1 px-3 py-2.5 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all text-sm font-medium shadow-sm text-center flex items-center justify-center gap-1">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <span class="flex-1 px-3 py-2.5 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm font-medium text-center flex items-center justify-center gap-1">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                @endif
            </div>
            <div class="text-center text-xs text-gray-500">
                Showing {{ $feedbacks->firstItem() }}-{{ $feedbacks->lastItem() }} of {{ $feedbacks->total() }}
            </div>
        </div>

        <!-- Desktop/Tablet View: Full Pagination -->
        <div class="hidden md:flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-700">
                Showing <span class="font-semibold">{{ $feedbacks->firstItem() }}</span> to <span class="font-semibold">{{ $feedbacks->lastItem() }}</span> of <span class="font-semibold">{{ $feedbacks->total() }}</span> results
            </div>
            <div class="flex items-center gap-2">
                <!-- Previous Button -->
                @if($feedbacks->onFirstPage())
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm font-medium">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </span>
                @else
                    <a href="{{ $feedbacks->previousPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium shadow-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </a>
                @endif

                <!-- Page Numbers -->
                <div class="flex items-center gap-1">
                    @php
                        $currentPage = $feedbacks->currentPage();
                        $lastPage = $feedbacks->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($startPage > 1)
                        <a href="{{ $feedbacks->url(1) }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium shadow-sm">1</a>
                        @if($startPage > 2)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                    @endif

                    @for($page = $startPage; $page <= $endPage; $page++)
                        @if($page == $currentPage)
                            <span class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $feedbacks->url($page) }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                        <a href="{{ $feedbacks->url($lastPage) }}" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium shadow-sm">{{ $lastPage }}</a>
                    @endif
                </div>

                <!-- Next Button -->
                @if($feedbacks->hasMorePages())
                    <a href="{{ $feedbacks->nextPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium shadow-sm flex items-center gap-1">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed text-sm font-medium flex items-center gap-1">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Session Keep-Alive Script -->
<script>
// Keep session alive by pinging server periodically
(function() {
    // Ping every 15 minutes (900000 ms) when page is active
    const KEEP_ALIVE_INTERVAL = 15 * 60 * 1000; // 15 minutes
    
    let keepAliveTimer = null;
    
    // Function to ping server and refresh session
    function pingServer() {
        // Make a lightweight request to refresh session
        fetch('{{ route("admin.list") }}', {
            method: 'HEAD',
            credentials: 'same-origin',
            cache: 'no-cache'
        }).catch(function(error) {
            // Silently handle errors - don't disturb user experience
            console.log('Session keep-alive ping failed:', error);
        });
    }
    
    // Start keep-alive when page becomes visible
    function startKeepAlive() {
        if (keepAliveTimer) {
            clearInterval(keepAliveTimer);
        }
        // Ping immediately, then set interval
        pingServer();
        keepAliveTimer = setInterval(pingServer, KEEP_ALIVE_INTERVAL);
    }
    
    // Stop keep-alive when page is hidden (background)
    function stopKeepAlive() {
        if (keepAliveTimer) {
            clearInterval(keepAliveTimer);
            keepAliveTimer = null;
        }
    }
    
    // Handle page visibility changes
    if (document.hidden !== undefined) {
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                startKeepAlive();
            } else {
                stopKeepAlive();
            }
        });
    }
    
    // Start keep-alive on page load if visible
    if (!document.hidden) {
        startKeepAlive();
    }
    
    // Also start on window focus
    window.addEventListener('focus', startKeepAlive);
    window.addEventListener('blur', stopKeepAlive);
})();
</script>
@endsection
