@extends('layouts.app')

@section('title', 'Admin Feedback Report')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 max-w-7xl">
    <!-- Minimal Header -->
    <div class="mb-8 sm:mb-10">
        <div class="text-center mb-6">
            <h1 class="text-3xl sm:text-4xl font-light text-gray-800 tracking-tight mb-2">Feedback Analytics</h1>
            <p class="text-gray-500 text-sm sm:text-base">Bhawan performance overview</p>
            <p class="text-gray-600 text-sm font-medium mt-2">Total Feedbacks: <span class="text-blue-600 font-semibold">{{ $totalFeedbacks }}</span></p>
        </div>
        
        <!-- Date Filter -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-3 sm:p-5 md:p-6 max-w-2xl mx-auto">
            <form method="GET" action="{{ route('report') }}" class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-stretch sm:items-end">
                <div class="flex-1 w-full sm:w-auto">
                    <label class="block text-xs font-medium text-gray-700 mb-1.5 sm:mb-2">From Date / प्रारंभ तिथि</label>
                    <input 
                        type="date" 
                        name="date_from" 
                        value="{{ request('date_from') }}"
                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm sm:text-base"
                    >
                </div>
                <div class="flex-1 w-full sm:w-auto">
                    <label class="block text-xs font-medium text-gray-700 mb-1.5 sm:mb-2">To Date / अंतिम तिथि</label>
                    <input 
                        type="date" 
                        name="date_to" 
                        value="{{ request('date_to') }}"
                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm sm:text-base"
                    >
                </div>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto sm:flex-shrink-0">
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors text-sm font-medium whitespace-nowrap"
                    >
                        Filter / फ़िल्टर
                    </button>
                    @if(request('date_from') || request('date_to'))
                    <a 
                        href="{{ route('report') }}" 
                        class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 active:bg-gray-400 transition-colors text-sm font-medium whitespace-nowrap text-center"
                    >
                        Clear / साफ़ करें
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
        <!-- Q1 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">आपका कुल ठहरने का अनुभव कैसा रहा?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q1"></canvas>
            </div>
        </div>

        <!-- Q2 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">सफाई से आप कितने संतुष्ट हैं?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q2"></canvas>
            </div>
        </div>

        <!-- Q3 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">कमरे की स्थिति कैसी थी?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q3"></canvas>
            </div>
        </div>

        <!-- Q4 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">बाथरूम / शौचालय की सफाई कैसी थी?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q4"></canvas>
            </div>
        </div>

        <!-- Q5 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">स्टाफ / सेवक का व्यवहार कैसा था?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q5"></canvas>
            </div>
        </div>

        <!-- Q7 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">पानी, बिजली और अन्य सुविधाएँ कैसी थीं?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q7"></canvas>
            </div>
        </div>

        <!-- Q8 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">आपका बकाया पैसा पूरा वापस हुआ की नहीं?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q8"></canvas>
            </div>
        </div>

        <!-- Q9 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">क्या आप भविष्य में दोबारा यहाँ ठहरना चाहेंगे?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q9"></canvas>
            </div>
        </div>

        <!-- Q10 Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-5 sm:p-6 hover:shadow-xl transition-shadow">
            <h6 class="text-sm font-medium text-gray-700 mb-4 text-center">क्या आप इस भवन को दूसरों को सुझाएंगे?</h6>
            <div class="h-56 sm:h-64">
                <canvas id="q10"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Modern color palette
const colors = {
    primary: ['#3b82f6', '#6366f1', '#8b5cf6'],
    success: ['#10b981', '#059669', '#047857'],
    warning: ['#f59e0b', '#d97706'],
    danger: ['#ef4444', '#dc2626'],
    info: ['#06b6d4', '#0891b2']
};

// Common options with % sign
const percentOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 12, weight: '500' },
            bodyFont: { size: 11 },
            cornerRadius: 8,
            displayColors: false,
            callbacks: {
                label: function(context) {
                    return context.raw + '%';
                }
            }
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 10,
                padding: 10,
                font: { size: 11, weight: '400' },
                usePointStyle: true
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 100,
            grid: {
                color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
            },
            ticks: {
                callback: (value) => value + '%',
                font: { size: 10 },
                color: '#6b7280'
            }
        },
        x: {
            grid: {
                display: false
            },
            ticks: {
                font: { size: 10 },
                color: '#6b7280'
            }
        }
    }
};

// Pie chart options
const pieOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 12, weight: '500' },
            bodyFont: { size: 11 },
            cornerRadius: 8,
            callbacks: {
                label: function(context) {
                    return context.label + ': ' + context.raw + '%';
                }
            }
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 10,
                padding: 10,
                font: { size: 11, weight: '400' },
                usePointStyle: true
            }
        }
    }
};

// Horizontal bar chart options
const horizontalBarOptions = {
    responsive: true,
    maintainAspectRatio: false,
    indexAxis: 'y',
    plugins: {
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 12, weight: '500' },
            bodyFont: { size: 11 },
            cornerRadius: 8,
            displayColors: false,
            callbacks: {
                label: function(context) {
                    return context.raw + '%';
                }
            }
        },
        legend: {
            display: false
        }
    },
    scales: {
        x: {
            beginAtZero: true,
            max: 100,
            grid: {
                color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
            },
            ticks: {
                callback: (value) => value + '%',
                font: { size: 10 },
                color: '#6b7280'
            }
        },
        y: {
            grid: {
                display: false
            },
            ticks: {
                font: { size: 10 },
                color: '#6b7280'
            }
        }
    }
};

// Line chart options
const lineOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 12, weight: '500' },
            bodyFont: { size: 11 },
            cornerRadius: 8,
            displayColors: false,
            callbacks: {
                label: function(context) {
                    return context.raw + '%';
                }
            }
        },
        legend: {
            display: false
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 100,
            grid: {
                color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
            },
            ticks: {
                callback: (value) => value + '%',
                font: { size: 10 },
                color: '#6b7280'
            }
        },
        x: {
            grid: {
                display: false
            },
            ticks: {
                font: { size: 10 },
                color: '#6b7280'
            }
        }
    }
};

// Q1 - Overall Experience - Pie Chart
@php
    $overallLabels = [];
    $overallData = [];
    $overallTotal = $overallExperience->sum('count');
    foreach($overallExperience as $item) {
        $label = ucfirst(str_replace('_', ' ', $item->overall_experience));
        $overallLabels[] = $label;
        $overallData[] = $overallTotal > 0 ? round(($item->count / $overallTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q1'), {
    type: 'pie',
    data: {
        labels: @json($overallLabels),
        datasets: [{
            data: @json($overallData),
            backgroundColor: [
                colors.success[0],
                colors.primary[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q2 - Cleanliness - Doughnut Chart
@php
    $cleanLabels = [];
    $cleanData = [];
    // Filter out null/empty values
    $cleanFiltered = $cleanliness->filter(function($item) {
        return !empty($item->cleanliness) && !is_null($item->cleanliness);
    });
    $cleanTotal = $cleanFiltered->sum('count');
    $cleanLabelMap = [
        'very_satisfied' => 'Very Satisfied',
        'satisfied' => 'Satisfied',
        'somewhat_satisfied' => 'Somewhat Satisfied',
        'not_satisfied' => 'Not Satisfied'
    ];
    foreach($cleanFiltered as $item) {
        $value = $item->cleanliness ?? '';
        if (!empty($value)) {
            $label = $cleanLabelMap[$value] ?? ucfirst(str_replace('_', ' ', $value));
            $cleanLabels[] = $label;
            $cleanData[] = $cleanTotal > 0 ? round(($item->count / $cleanTotal) * 100, 1) : 0;
        }
    }
@endphp
new Chart(document.getElementById('q2'), {
    type: 'doughnut',
    data: {
        labels: @json($cleanLabels),
        datasets: [{
            data: @json($cleanData),
            backgroundColor: [
                colors.success[0],
                colors.primary[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q3 - Room Condition - Line Chart
@php
    $roomLabels = [];
    $roomData = [];
    // Filter out null/empty values
    $roomFiltered = $roomCondition->filter(function($item) {
        return !empty($item->room_condition) && !is_null($item->room_condition);
    });
    $roomTotal = $roomFiltered->sum('count');
    $roomLabelMap = [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'average' => 'Average',
        'poor' => 'Poor'
    ];
    foreach($roomFiltered as $item) {
        $value = $item->room_condition ?? '';
        if (!empty($value)) {
            $label = $roomLabelMap[$value] ?? ucfirst($value);
            $roomLabels[] = $label;
            $roomData[] = $roomTotal > 0 ? round(($item->count / $roomTotal) * 100, 1) : 0;
        }
    }
@endphp
new Chart(document.getElementById('q3'), {
    type: 'line',
    data: {
        labels: @json($roomLabels),
        datasets: [{
            data: @json($roomData),
            backgroundColor: colors.success[0],
            borderColor: colors.success[1],
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: colors.success[0],
            pointBorderColor: '#fff',
            pointBorderWidth: 2
        }]
    },
    options: lineOptions
});

// Q4 - Bathroom Cleanliness - Horizontal Bar Chart
@php
    $bathroomLabels = [];
    $bathroomData = [];
    // Filter out null/empty values
    $bathroomFiltered = $bathroomCleanliness->filter(function($item) {
        return !empty($item->bathroom_cleanliness) && !is_null($item->bathroom_cleanliness);
    });
    $bathroomTotal = $bathroomFiltered->sum('count');
    $bathroomLabelMap = [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'average' => 'Average',
        'poor' => 'Poor'
    ];
    foreach($bathroomFiltered as $item) {
        $value = $item->bathroom_cleanliness ?? '';
        if (!empty($value)) {
            $label = $bathroomLabelMap[$value] ?? ucfirst($value);
            $bathroomLabels[] = $label;
            $bathroomData[] = $bathroomTotal > 0 ? round(($item->count / $bathroomTotal) * 100, 1) : 0;
        }
    }
@endphp
new Chart(document.getElementById('q4'), {
    type: 'bar',
    data: {
        labels: @json($bathroomLabels),
        datasets: [{
            data: @json($bathroomData),
            backgroundColor: colors.primary[2],
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: horizontalBarOptions
});

// Q5 - Staff Behaviour - Pie Chart
@php
    $staffLabels = [];
    $staffData = [];
    $staffTotal = $staffBehaviour->sum('count');
    $staffLabelMap = [
        'very_good' => 'Very Good',
        'good' => 'Good',
        'average' => 'Average',
        'poor' => 'Poor'
    ];
    foreach($staffBehaviour as $item) {
        $label = $staffLabelMap[$item->staff_behaviour] ?? ucfirst(str_replace('_', ' ', $item->staff_behaviour));
        $staffLabels[] = $label;
        $staffData[] = $staffTotal > 0 ? round(($item->count / $staffTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q5'), {
    type: 'pie',
    data: {
        labels: @json($staffLabels),
        datasets: [{
            data: @json($staffData),
            backgroundColor: [
                colors.success[0],
                colors.primary[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q7 - Basic Facilities - Doughnut Chart
@php
    $facilitiesLabels = [];
    $facilitiesData = [];
    // Filter out null/empty values
    $facilitiesFiltered = $basicFacilities->filter(function($item) {
        return !empty($item->basic_facilities) && !is_null($item->basic_facilities);
    });
    $facilitiesTotal = $facilitiesFiltered->sum('count');
    $facilitiesLabelMap = [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'average' => 'Average',
        'faced_problems' => 'Faced Problems'
    ];
    foreach($facilitiesFiltered as $item) {
        $value = $item->basic_facilities ?? '';
        if (!empty($value)) {
            $label = $facilitiesLabelMap[$value] ?? ucfirst(str_replace('_', ' ', $value));
            $facilitiesLabels[] = $label;
            $facilitiesData[] = $facilitiesTotal > 0 ? round(($item->count / $facilitiesTotal) * 100, 1) : 0;
        }
    }
@endphp
new Chart(document.getElementById('q7'), {
    type: 'doughnut',
    data: {
        labels: @json($facilitiesLabels),
        datasets: [{
            data: @json($facilitiesData),
            backgroundColor: [
                colors.success[0],
                colors.primary[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q8 - Money Return - Pie Chart
@php
    $moneyLabels = [];
    $moneyData = [];
    $moneyTotal = $moneyReturn->sum('count');
    foreach($moneyReturn as $item) {
        $label = ucfirst($item->money_return);
        $moneyLabels[] = $label;
        $moneyData[] = $moneyTotal > 0 ? round(($item->count / $moneyTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q8'), {
    type: 'pie',
    data: {
        labels: @json($moneyLabels),
        datasets: [{
            data: @json($moneyData),
            backgroundColor: [
                colors.success[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q9 - Stay Again - Pie Chart
@php
    $stayLabels = [];
    $stayData = [];
    $stayTotal = $stayAgain->sum('count');
    $stayLabelMap = [
        'yes' => 'Yes',
        'maybe' => 'Maybe',
        'no' => 'No'
    ];
    foreach($stayAgain as $item) {
        $label = $stayLabelMap[$item->stay_again] ?? ucfirst($item->stay_again);
        $stayLabels[] = $label;
        $stayData[] = $stayTotal > 0 ? round(($item->count / $stayTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q9'), {
    type: 'pie',
    data: {
        labels: @json($stayLabels),
        datasets: [{
            data: @json($stayData),
            backgroundColor: [
                colors.success[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});

// Q10 - Recommend - Pie Chart
@php
    $recommendLabels = [];
    $recommendData = [];
    $recommendTotal = $recommend->sum('count');
    $recommendLabelMap = [
        'yes' => 'Yes',
        'maybe' => 'Maybe',
        'no' => 'No'
    ];
    foreach($recommend as $item) {
        $label = $recommendLabelMap[$item->recommend] ?? ucfirst($item->recommend);
        $recommendLabels[] = $label;
        $recommendData[] = $recommendTotal > 0 ? round(($item->count / $recommendTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q10'), {
    type: 'pie',
    data: {
        labels: @json($recommendLabels),
        datasets: [{
            data: @json($recommendData),
            backgroundColor: [
                colors.success[0],
                colors.warning[0],
                colors.danger[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});
</script>

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
        fetch('{{ route("report") }}', {
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
