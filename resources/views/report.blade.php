@extends('layouts.app')

@section('title', 'Admin Feedback Report')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 max-w-7xl">
    <!-- Minimal Header -->
    <div class="mb-8 sm:mb-10 text-center">
        <h1 class="text-3xl sm:text-4xl font-light text-gray-800 tracking-tight mb-2">Feedback Analytics</h1>
        <p class="text-gray-500 text-sm sm:text-base">Bhawan performance overview</p>
        <p class="text-gray-600 text-sm font-medium mt-2">Total Feedbacks: <span class="text-blue-600 font-semibold">{{ $totalFeedbacks }}</span></p>
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

// Q2 - Cleanliness - Bar Chart
@php
    $cleanLabels = [];
    $cleanData = [];
    $cleanTotal = $cleanliness->sum('count');
    $cleanLabelMap = [
        'very_satisfied' => 'Very Satisfied',
        'satisfied' => 'Satisfied',
        'somewhat_satisfied' => 'Somewhat Satisfied',
        'not_satisfied' => 'Not Satisfied'
    ];
    foreach($cleanliness as $item) {
        $label = $cleanLabelMap[$item->cleanliness] ?? ucfirst(str_replace('_', ' ', $item->cleanliness));
        $cleanLabels[] = $label;
        $cleanData[] = $cleanTotal > 0 ? round(($item->count / $cleanTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q2'), {
    type: 'bar',
    data: {
        labels: @json($cleanLabels),
        datasets: [{
            data: @json($cleanData),
            backgroundColor: colors.primary[0],
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: percentOptions
});

// Q3 - Room Condition - Bar Chart
@php
    $roomLabels = [];
    $roomData = [];
    $roomTotal = $roomCondition->sum('count');
    foreach($roomCondition as $item) {
        $label = ucfirst($item->room_condition);
        $roomLabels[] = $label;
        $roomData[] = $roomTotal > 0 ? round(($item->count / $roomTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q3'), {
    type: 'bar',
    data: {
        labels: @json($roomLabels),
        datasets: [{
            data: @json($roomData),
            backgroundColor: colors.success[0],
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: percentOptions
});

// Q4 - Bathroom Cleanliness - Bar Chart
@php
    $bathroomLabels = [];
    $bathroomData = [];
    $bathroomTotal = $bathroomCleanliness->sum('count');
    foreach($bathroomCleanliness as $item) {
        $label = ucfirst($item->bathroom_cleanliness);
        $bathroomLabels[] = $label;
        $bathroomData[] = $bathroomTotal > 0 ? round(($item->count / $bathroomTotal) * 100, 1) : 0;
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
    options: percentOptions
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

// Q7 - Basic Facilities - Bar Chart
@php
    $facilitiesLabels = [];
    $facilitiesData = [];
    $facilitiesTotal = $basicFacilities->sum('count');
    $facilitiesLabelMap = [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'average' => 'Average',
        'faced_problems' => 'Faced Problems'
    ];
    foreach($basicFacilities as $item) {
        $label = $facilitiesLabelMap[$item->basic_facilities] ?? ucfirst(str_replace('_', ' ', $item->basic_facilities));
        $facilitiesLabels[] = $label;
        $facilitiesData[] = $facilitiesTotal > 0 ? round(($item->count / $facilitiesTotal) * 100, 1) : 0;
    }
@endphp
new Chart(document.getElementById('q7'), {
    type: 'bar',
    data: {
        labels: @json($facilitiesLabels),
        datasets: [{
            data: @json($facilitiesData),
            backgroundColor: colors.warning[0],
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: percentOptions
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
    foreach($stayAgain as $item) {
        $label = ucfirst($item->stay_again);
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
                colors.warning[0]
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
    foreach($recommend as $item) {
        $label = ucfirst($item->recommend);
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
                colors.warning[0]
            ],
            borderWidth: 0
        }]
    },
    options: pieOptions
});
</script>
@endsection
