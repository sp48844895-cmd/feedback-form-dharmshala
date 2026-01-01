@extends('layouts.app')

@section('title', 'Feedback Details')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 max-w-5xl">
    <!-- Header with Back Button -->
    <div class="mb-6 sm:mb-8">
        <a href="{{ route('admin.list') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium text-sm mb-4 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Feedback List
        </a>
        <h1 class="text-3xl sm:text-4xl font-light text-gray-800 tracking-tight mb-2">Feedback Details</h1>
        <p class="text-gray-500 text-sm sm:text-base">Complete feedback information</p>
    </div>

    <!-- Feedback Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
        <!-- Personal Information Section -->
        <div class="p-6 sm:p-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-sm font-semibold">1</div>
                Personal Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Name / नाम</label>
                    <p class="text-base font-medium text-gray-900">{{ $feedback->name ?? 'Not provided / प्रदान नहीं किया गया' }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Mobile Number / मोबाइल नंबर</label>
                    <p class="text-base font-medium text-gray-900">{{ $feedback->mobile }}</p>
                </div>
            </div>
        </div>

        <!-- Experience Questions Section -->
        <div class="p-6 sm:p-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 text-white flex items-center justify-center text-sm font-semibold">2</div>
                Experience Questions
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Q1: Overall Experience -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">आपका कुल ठहरने का अनुभव कैसा रहा?</label>
                    <p class="text-xs text-gray-500 mb-3">How was your overall stay experience?</p>
                    @php
                        $overallColors = [
                            'excellent' => 'bg-green-100 text-green-800',
                            'good' => 'bg-blue-100 text-blue-800',
                            'average' => 'bg-yellow-100 text-yellow-800',
                            'poor' => 'bg-red-100 text-red-800'
                        ];
                        $overallLabels = [
                            'excellent' => 'Excellent / बहुत अच्छा',
                            'good' => 'Good / अच्छा',
                            'average' => 'Average / ठीक-ठाक',
                            'poor' => 'Poor / खराब'
                        ];
                        $color = $overallColors[$feedback->overall_experience] ?? 'bg-gray-100 text-gray-800';
                        $label = $overallLabels[$feedback->overall_experience] ?? ucfirst($feedback->overall_experience);
                    @endphp
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium {{ $color }}">{{ $label }}</span>
                </div>

                <!-- Q2: Cleanliness -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">कमरे की सफाई से आप कितने संतुष्ट हैं?</label>
                    <p class="text-xs text-gray-500 mb-3">How satisfied are you with the cleanliness?</p>
                    @php
                        $cleanLabels = [
                            'very_satisfied' => 'Very Satisfied / बहुत अधिक संतुष्ट',
                            'satisfied' => 'Satisfied / संतुष्ट',
                            'somewhat_satisfied' => 'Somewhat Satisfied / कुछ हद तक संतुष्ट',
                            'not_satisfied' => 'Not Satisfied / बिल्कुल संतुष्ट नहीं'
                        ];
                        $cleanLabel = $cleanLabels[$feedback->cleanliness] ?? ucfirst(str_replace('_', ' ', $feedback->cleanliness));
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $cleanLabel }}</p>
                </div>

                <!-- Q3: Room Condition -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">कमरे की स्थिति कैसी थी?</label>
                    <p class="text-xs text-gray-500 mb-3">How was the condition of the room?</p>
                    @php
                        $roomLabels = [
                            'excellent' => 'Excellent / बहुत बढ़िया',
                            'good' => 'Good / अच्छी',
                            'average' => 'Average / ठीक-ठाक',
                            'poor' => 'Poor / खराब'
                        ];
                        $roomLabel = $roomLabels[$feedback->room_condition] ?? ucfirst($feedback->room_condition);
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $roomLabel }}</p>
                </div>

                <!-- Q4: Bathroom Cleanliness -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">बाथरूम / शौचालय की सफाई कैसी थी?</label>
                    <p class="text-xs text-gray-500 mb-3">How was the bathroom cleanliness?</p>
                    @php
                        $bathroomLabels = [
                            'excellent' => 'Excellent / बहुत अच्छी',
                            'good' => 'Good / अच्छी',
                            'average' => 'Average / ठीक-ठाक',
                            'poor' => 'Poor / खराब'
                        ];
                        $bathroomLabel = $bathroomLabels[$feedback->bathroom_cleanliness] ?? ucfirst($feedback->bathroom_cleanliness);
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $bathroomLabel }}</p>
                </div>

                <!-- Q5: Staff Behaviour -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">स्टाफ का व्यवहार कैसा था?</label>
                    <p class="text-xs text-gray-500 mb-3">How was the staff behaviour?</p>
                    @php
                        $staffLabels = [
                            'very_good' => 'Very Good / बहुत अच्छा',
                            'good' => 'Good / अच्छा',
                            'average' => 'Average / सामान्य',
                            'poor' => 'Poor / अच्छा नहीं था'
                        ];
                        $staffLabel = $staffLabels[$feedback->staff_behaviour] ?? ucfirst(str_replace('_', ' ', $feedback->staff_behaviour));
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $staffLabel }}</p>
                </div>

                <!-- Q7: Basic Facilities -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">पानी, बिजली और अन्य मूलभूत सुविधाएँ कैसी थीं?</label>
                    <p class="text-xs text-gray-500 mb-3">How were the basic facilities?</p>
                    @php
                        $facilitiesLabels = [
                            'excellent' => 'Excellent / बहुत अच्छी',
                            'good' => 'Good / अच्छी',
                            'average' => 'Average / ठीक-ठाक',
                            'faced_problems' => 'Faced Problems / समस्या हुई'
                        ];
                        $facilitiesLabel = $facilitiesLabels[$feedback->basic_facilities] ?? ucfirst(str_replace('_', ' ', $feedback->basic_facilities));
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $facilitiesLabel }}</p>
                </div>

                <!-- Q8: Money Return -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">आपका बकाया पैसा पूरा वापस हुआ की नहीं?</label>
                    <p class="text-xs text-gray-500 mb-3">Was your remaining money fully returned?</p>
                    @php
                        $moneyColor = $feedback->money_return === 'yes' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                        $moneyLabel = $feedback->money_return === 'yes' ? 'Yes / हाँ' : 'No / नहीं';
                    @endphp
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium {{ $moneyColor }}">{{ $moneyLabel }}</span>
                </div>

                <!-- Q9: Stay Again -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">क्या आप भविष्य में दोबारा यहाँ ठहरना चाहेंगे?</label>
                    <p class="text-xs text-gray-500 mb-3">Would you like to stay here again?</p>
                    @php
                        $stayLabels = [
                            'yes' => 'Yes (हाँ)',
                            'maybe' => 'Maybe (शायद)',
                            'no' => 'No (नहीं)'
                        ];
                        $stayLabel = $stayLabels[$feedback->stay_again] ?? ucfirst($feedback->stay_again);
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $stayLabel }}</p>
                </div>

                <!-- Q10: Recommend -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1">क्या आप इस भवन को दूसरों को सुझाएंगे?</label>
                    <p class="text-xs text-gray-500 mb-3">Would you recommend this Bhawan to others?</p>
                    @php
                        $recommendLabels = [
                            'yes' => 'Yes (हाँ)',
                            'maybe' => 'Maybe (शायद)',
                            'no' => 'No (नहीं)'
                        ];
                        $recommendLabel = $recommendLabels[$feedback->recommend] ?? ucfirst($feedback->recommend);
                    @endphp
                    <p class="text-sm font-medium text-gray-900">{{ $recommendLabel }}</p>
                </div>
            </div>
        </div>

        <!-- Suggestions Section -->
        <div class="p-6 sm:p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-rose-500 to-pink-600 text-white flex items-center justify-center text-sm font-semibold">3</div>
                Suggestions / Comments
            </h2>
            <div class="bg-gray-50 rounded-xl p-5">
                @if($feedback->suggestions)
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $feedback->suggestions }}</p>
                @else
                    <p class="text-sm text-gray-400 italic">No suggestions provided / कोई सुझाव प्रदान नहीं किया गया</p>
                @endif
            </div>
        </div>

        <!-- Footer with Timestamp -->
        <div class="px-6 sm:px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500">Submitted on / प्रस्तुत किया गया</p>
                <p class="text-sm font-medium text-gray-700">
                    @php
                        // Parse the created_at timestamp and format it properly
                        $date = \Carbon\Carbon::parse($feedback->created_at);
                        echo $date->format('d M Y, h:i A');
                    @endphp
                </p>
            </div>
            <a href="{{ route('admin.list') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                Back to List
            </a>
        </div>
    </div>
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

