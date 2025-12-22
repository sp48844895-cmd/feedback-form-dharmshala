@extends('layouts.app')

@section('title', 'Guest Feedback Form')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 max-w-4xl">
    <!-- Premium Card Container -->
    <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden backdrop-blur-xl">
        <!-- Enhanced Header with Gradient -->
        <div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 px-6 sm:px-10 py-8 sm:py-12 overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-400/20 rounded-full -ml-24 -mb-1.54 blur-2xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-1.5">
                    <div class="w-1 h-8 bg-white/30 rounded-full"></div>
                    <h1 class="text-3xl sm:text-4xl font-semibold text-white tracking-tight">Guest Feedback</h1>
                </div>
                <p class="text-blue-100 text-base sm:text-lg ml-4 font-light">Share your valuable experience with us</p>
            </div>
        </div>

        <!-- Form Body with Enhanced Spacing -->
        <div class="p-6 sm:p-10 md:p-12 bg-gradient-to-b from-gray-50/50 to-white">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm font-medium">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST" class="space-y-8 sm:space-y-10" onsubmit="return submitForm(event)">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-sm font-semibold shadow-lg">1</div>
                        <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
                        <div class="flex-1 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 tracking-wide">
                                नाम / Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                                <input 
                                    type="text" 
                                    name="name"
                                    class="relative w-full px-5 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm hover:border-blue-300 hover:shadow-md"
                                    placeholder="Enter your full name (optional)"
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Field -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 tracking-wide">
                                मोबाइल नंबर / Mobile Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                                <input 
                                    type="tel" 
                                    name="mobile"
                                    class="relative w-full px-5 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm hover:border-indigo-300 hover:shadow-md"
                                    placeholder="Enter mobile number"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience Questions Section -->
                <div class="space-y-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 text-white text-sm font-semibold shadow-lg">2</div>
                        <h2 class="text-lg font-semibold text-gray-800">Your Experience</h2>
                        <div class="flex-1 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
                    </div>

                    <!-- Q1: Overall Experience -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                आपका कुल ठहरने का अनुभव कैसा रहा?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How was your overall stay experience?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="overall_excellent" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-blue-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत अच्छा (Excellent)</span>
                                <input type="radio" name="overall_experience" value="excellent" id="overall_excellent" class="w-4 h-4 absolute accent-blue-500 right-2.5" required>
                            </label>
                            <label for="overall_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-blue-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छा (Good)</span>
                                <input type="radio" name="overall_experience" value="good" id="overall_good" class="w-4 h-4 absolute accent-blue-500 right-2.5">
                            </label>
                            <label for="overall_average" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-blue-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">ठीक-ठाक (Average)</span>
                                <input type="radio" name="overall_experience" value="average" id="overall_average" class="w-4 h-4 absolute accent-blue-500 right-2.5">
                            </label>
                            <label for="overall_poor" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-blue-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">खराब (Poor)</span>
                                <input type="radio" name="overall_experience" value="poor" id="overall_poor" class="w-4 h-4 absolute accent-blue-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q2: Cleanliness -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                कमरे की सफाई से आप कितने संतुष्ट हैं?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How satisfied are you with the cleanliness?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="cleanliness_very_satisfied" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:ring-indigo-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत अधिक संतुष्ट (Very Satisfied)</span>
                                <input type="radio" name="cleanliness" value="very_satisfied" id="cleanliness_very_satisfied" class="w-4 h-4 absolute accent-indigo-500 right-2.5" required>
                            </label>
                            <label for="cleanliness_satisfied" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:ring-indigo-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">संतुष्ट (Satisfied)</span>
                                <input type="radio" name="cleanliness" value="satisfied" id="cleanliness_satisfied" class="w-4 h-4 absolute accent-indigo-500 right-2.5">
                            </label>
                            <label for="cleanliness_somewhat" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:ring-indigo-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">कुछ हद तक संतुष्ट (Somewhat Satisfied)</span>
                                <input type="radio" name="cleanliness" value="somewhat_satisfied" id="cleanliness_somewhat" class="w-4 h-4 absolute accent-indigo-500 right-2.5">
                            </label>
                            <label for="cleanliness_not_satisfied" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:ring-indigo-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बिल्कुल संतुष्ट नहीं (Not Satisfied)</span>
                                <input type="radio" name="cleanliness" value="not_satisfied" id="cleanliness_not_satisfied" class="w-4 h-4 absolute accent-indigo-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q3: Room Condition -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                कमरे की स्थिति कैसी थी?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How was the condition of the room?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="room_excellent" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:ring-purple-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत बढ़िया (Excellent)</span>
                                <input type="radio" name="room_condition" value="excellent" id="room_excellent" class="w-4 h-4 absolute accent-purple-500 right-2.5" required>
                            </label>
                            <label for="room_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:ring-purple-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छी (Good)</span>
                                <input type="radio" name="room_condition" value="good" id="room_good" class="w-4 h-4 absolute accent-purple-500 right-2.5">
                            </label>
                            <label for="room_average" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:ring-purple-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">ठीक-ठाक (Average)</span>
                                <input type="radio" name="room_condition" value="average" id="room_average" class="w-4 h-4 absolute accent-purple-500 right-2.5">
                            </label>
                            <label for="room_poor" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:ring-purple-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">खराब (Poor)</span>
                                <input type="radio" name="room_condition" value="poor" id="room_poor" class="w-4 h-4 absolute accent-purple-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q4: Bathroom Cleanliness -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                बाथरूम / शौचालय की सफाई कैसी थी?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How was the bathroom cleanliness?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="bathroom_excellent" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-pink-500 has-[:checked]:bg-pink-50 has-[:checked]:ring-pink-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत अच्छी (Excellent)</span>
                                <input type="radio" name="bathroom_cleanliness" value="excellent" id="bathroom_excellent" class="w-4 h-4 absolute accent-pink-500 right-2.5" required>
                            </label>
                            <label for="bathroom_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-pink-500 has-[:checked]:bg-pink-50 has-[:checked]:ring-pink-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छी (Good)</span>
                                <input type="radio" name="bathroom_cleanliness" value="good" id="bathroom_good" class="w-4 h-4 absolute accent-pink-500 right-2.5">
                            </label>
                            <label for="bathroom_average" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-pink-500 has-[:checked]:bg-pink-50 has-[:checked]:ring-pink-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">ठीक-ठाक (Average)</span>
                                <input type="radio" name="bathroom_cleanliness" value="average" id="bathroom_average" class="w-4 h-4 absolute accent-pink-500 right-2.5">
                            </label>
                            <label for="bathroom_poor" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-pink-500 has-[:checked]:bg-pink-50 has-[:checked]:ring-pink-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">खराब (Poor)</span>
                                <input type="radio" name="bathroom_cleanliness" value="poor" id="bathroom_poor" class="w-4 h-4 absolute accent-pink-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q5: Staff Behaviour -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                स्टाफ का व्यवहार कैसा था?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How was the staff behaviour?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="staff_very_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-emerald-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत अच्छा (Very Good)</span>
                                <input type="radio" name="staff_behaviour" value="very_good" id="staff_very_good" class="w-4 h-4 absolute accent-emerald-500 right-2.5" required>
                            </label>
                            <label for="staff_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-emerald-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छा (Good)</span>
                                <input type="radio" name="staff_behaviour" value="good" id="staff_good" class="w-4 h-4 absolute accent-emerald-500 right-2.5">
                            </label>
                            <label for="staff_average" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-emerald-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">सामान्य (Average)</span>
                                <input type="radio" name="staff_behaviour" value="average" id="staff_average" class="w-4 h-4 absolute accent-emerald-500 right-2.5">
                            </label>
                            <label for="staff_poor" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-emerald-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छा नहीं था (Poor)</span>
                                <input type="radio" name="staff_behaviour" value="poor" id="staff_poor" class="w-4 h-4 absolute accent-emerald-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q7: Basic Facilities -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                पानी, बिजली और अन्य मूलभूत सुविधाएँ कैसी थीं?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">How were the basic facilities?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="facilities_excellent" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:ring-amber-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">बहुत अच्छी (Excellent)</span>
                                <input type="radio" name="basic_facilities" value="excellent" id="facilities_excellent" class="w-4 h-4 absolute accent-amber-500 right-2.5" required>
                            </label>
                            <label for="facilities_good" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:ring-amber-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">अच्छी (Good)</span>
                                <input type="radio" name="basic_facilities" value="good" id="facilities_good" class="w-4 h-4 absolute accent-amber-500 right-2.5">
                            </label>
                            <label for="facilities_average" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:ring-amber-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">ठीक-ठाक (Average)</span>
                                <input type="radio" name="basic_facilities" value="average" id="facilities_average" class="w-4 h-4 absolute accent-amber-500 right-2.5">
                            </label>
                            <label for="facilities_problems" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:ring-amber-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">समस्या हुई (Faced Problems)</span>
                                <input type="radio" name="basic_facilities" value="faced_problems" id="facilities_problems" class="w-4 h-4 absolute accent-amber-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q8: Money Return -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                आपका बकाया पैसा पूरा वापस हुआ की नहीं?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">Was your remaining money fully returned?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="money_yes" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-green-500 has-[:checked]:bg-green-50 has-[:checked]:ring-green-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">हाँ (Yes)</span>
                                <input type="radio" name="money_return" value="yes" id="money_yes" class="w-4 h-4 absolute accent-green-500 right-2.5" required>
                            </label>
                            <label for="money_no" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-red-500 has-[:checked]:bg-red-50 has-[:checked]:ring-red-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">नहीं (No)</span>
                                <input type="radio" name="money_return" value="no" id="money_no" class="w-4 h-4 absolute accent-red-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q9: Stay Again -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                क्या आप भविष्य में दोबारा यहाँ ठहरना चाहेंगे?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">Would you like to stay here again?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="stay_yes" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-cyan-500 has-[:checked]:bg-cyan-50 has-[:checked]:ring-cyan-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">हाँ, ज़रूर (Yes)</span>
                                <input type="radio" name="stay_again" value="yes" id="stay_yes" class="w-4 h-4 absolute accent-cyan-500 right-2.5" required>
                            </label>
                            <label for="stay_maybe" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-cyan-500 has-[:checked]:bg-cyan-50 has-[:checked]:ring-cyan-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">शायद (Maybe)</span>
                                <input type="radio" name="stay_again" value="maybe" id="stay_maybe" class="w-4 h-4 absolute accent-cyan-500 right-2.5">
                            </label>
                        </div>
                    </div>

                    <!-- Q10: Recommend -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="mb-3">
                            <label class="block text-base font-semibold text-gray-800 mb-1.5">
                                क्या आप इस भवन को दूसरों को सुझाएंगे?
                            </label>
                            <p class="text-xs text-gray-500 font-medium">Would you recommend this Bhawan?</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label for="recommend_yes" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:ring-violet-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">हाँ (Yes)</span>
                                <input type="radio" name="recommend" value="yes" id="recommend_yes" class="w-4 h-4 absolute accent-violet-500 right-2.5" required>
                            </label>
                            <label for="recommend_maybe" class="font-medium h-11 relative hover:bg-zinc-100 flex items-center px-2.5 rounded-lg has-[:checked]:text-violet-500 has-[:checked]:bg-violet-50 has-[:checked]:ring-violet-300 has-[:checked]:ring-1 select-none border border-gray-200 transition-all shadow-[0px_0px_15px_rgba(0,0,0,0.09)]">
                                <span class="pr-10 text-sm">शायद (Maybe)</span>
                                <input type="radio" name="recommend" value="maybe" id="recommend_maybe" class="w-4 h-4 absolute accent-violet-500 right-2.5">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Additional Comments Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-rose-500 to-pink-600 text-white text-sm font-semibold shadow-lg">3</div>
                        <h2 class="text-lg font-semibold text-gray-800">Additional Comments</h2>
                        <div class="flex-1 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 tracking-wide">
                                    सुझाव / शिकायत
                                </label>
                                <p class="text-xs text-gray-500 mt-1 font-medium">Suggestions / Complaints</p>
                            </div>
                            <button 
                                type="button" 
                                id="voiceBtn" 
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg text-sm font-medium"
                                title="Click to speak / बोलने के लिए क्लिक करें"
                            >
                                <svg id="micIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                                <span id="voiceBtnText">Voice</span>
                            </button>
                        </div>
                        <div class="relative">
                            <textarea 
                                name="suggestions"
                                id="suggestionsTextarea"
                                rows="5"
                                class="w-full px-5 py-4 pr-12 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-300 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm hover:border-rose-300 hover:shadow-md resize-none"
                                placeholder="Share your thoughts, suggestions, or any complaints (optional) / अपने विचार, सुझाव या शिकायत साझा करें (वैकल्पिक)"
                            ></textarea>
                            <div id="recordingIndicator" class="hidden absolute top-3 right-3 flex items-center gap-2 text-red-600">
                                <div class="w-3 h-3 bg-red-600 rounded-full animate-pulse"></div>
                                <span class="text-xs font-medium">Recording...</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Click the Voice button and speak in Hindi or English / वॉइस बटन पर क्लिक करें और हिंदी या अंग्रेजी में बोलें
                        </p>
                    </div>
                </div>

                <!-- Premium Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="relative w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02] overflow-hidden group"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span>Submit Feedback</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Notification Container -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl border border-gray-200 p-4 min-w-[320px] max-w-md transform transition-all duration-300 ease-in-out">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-gray-900 mb-1">Success / सफलता</h4>
                <p class="text-sm text-gray-700 mb-1">Thank you for your feedback! / आपके फीडबैक के लिए धन्यवाद!</p>
                <p class="text-xs text-gray-500">Your response has been recorded successfully. / आपकी प्रतिक्रिया सफलतापूर्वक दर्ज की गई है।</p>
            </div>
            <button onclick="closeToast()" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
// Ensure form submits via POST only (AJAX to hide data from URL)
function submitForm(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Disable submit button to prevent double submission
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="relative z-10 flex items-center justify-center gap-2"><span>Submitting...</span></span>';
    
    // Submit via POST using fetch API (data will not appear in URL)
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        return response.text().then(text => {
            throw new Error(text || 'Network response was not ok');
        });
    })
    .then(data => {
        // Show success toast
        showToast();
        // Reset form
        form.reset();
        // Clean URL - remove any query parameters
        if (window.history && window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        // Re-enable submit button
        submitButton.disabled = false;
        submitButton.innerHTML = '<span class="relative z-10 flex items-center justify-center gap-2"><span>Submit Feedback</span><svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg></span>';
    })
    .catch(error => {
        console.error('Error:', error);
        // Re-enable submit button
        submitButton.disabled = false;
        submitButton.innerHTML = '<span class="relative z-10 flex items-center justify-center gap-2"><span>Submit Feedback</span><svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg></span>';
        // Show error message
        alert('Error submitting feedback. Please try again.');
    });
    
    return false;
}

// Show toast notification
function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');
    toast.classList.add('animate-slide-in');
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        closeToast();
    }, 5000);
}

// Close toast notification
function closeToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('hidden');
    toast.classList.remove('animate-slide-in');
}

// Show toast if success message exists (for page reload after redirect)
@if(session('success'))
    document.addEventListener('DOMContentLoaded', function() {
        showToast();
        // Reset form after showing toast
        document.getElementById('feedbackForm').reset();
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    });
@endif

// Speech Recognition for Suggestions Box
(function() {
    const voiceBtn = document.getElementById('voiceBtn');
    const micIcon = document.getElementById('micIcon');
    const voiceBtnText = document.getElementById('voiceBtnText');
    const suggestionsTextarea = document.getElementById('suggestionsTextarea');
    const recordingIndicator = document.getElementById('recordingIndicator');
    
    let recognition = null;
    let isRecording = false;
    let lastFinalIndex = 0;
    let baseText = ''; // Store text before current recognition session
    let interimText = ''; // Store interim text separately
    
    // Check if browser supports speech recognition
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        
        // Configure recognition for Hindi and English (Hinglish)
        recognition.continuous = false; // Changed to false for better accuracy
        recognition.interimResults = true;
        recognition.lang = 'hi-IN,en-US'; // Hindi (India) and English (US)
        recognition.maxAlternatives = 1; // Only get best result
        
        recognition.onstart = function() {
            isRecording = true;
            // Store current text as base before starting new recognition
            baseText = suggestionsTextarea.value;
            interimText = '';
            lastFinalIndex = 0;
            
            voiceBtn.classList.remove('from-blue-500', 'to-indigo-600');
            voiceBtn.classList.add('from-red-500', 'to-red-600');
            voiceBtnText.textContent = 'Stop';
            recordingIndicator.classList.remove('hidden');
            micIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>';
        };
        
        recognition.onresult = function(event) {
            let finalTranscript = '';
            let newInterimTranscript = '';
            
            // Process only new results (from lastFinalIndex)
            for (let i = event.resultIndex; i < event.results.length; i++) {
                const transcript = event.results[i][0].transcript.trim();
                
                if (event.results[i].isFinal) {
                    // Only add final results, avoid duplicates
                    if (transcript && !finalTranscript.includes(transcript)) {
                        finalTranscript += transcript + ' ';
                    }
                    lastFinalIndex = i + 1;
                } else {
                    // Store interim results separately
                    newInterimTranscript = transcript;
                }
            }
            
            // Update textarea: baseText + final results + interim results
            if (finalTranscript) {
                // Add final transcript to base
                baseText += finalTranscript;
                interimText = ''; // Clear interim when we get final
                suggestionsTextarea.value = baseText;
            } else if (newInterimTranscript) {
                // Show interim results temporarily
                interimText = newInterimTranscript;
                suggestionsTextarea.value = baseText + ' ' + interimText;
            }
        };
        
        recognition.onerror = function(event) {
            console.error('Speech recognition error:', event.error);
            stopRecording();
            
            let errorMsg = 'Speech recognition error. Please try again.';
            if (event.error === 'no-speech') {
                errorMsg = 'No speech detected. Please try again. / कोई भाषण नहीं मिला। कृपया पुनः प्रयास करें।';
            } else if (event.error === 'not-allowed') {
                errorMsg = 'Microphone permission denied. Please allow microphone access. / माइक्रोफोन अनुमति अस्वीकृत। कृपया माइक्रोफोन पहुंच की अनुमति दें।';
            }
            
            alert(errorMsg);
        };
        
        recognition.onend = function() {
            // When recognition ends, finalize any remaining interim text
            if (interimText) {
                baseText += ' ' + interimText;
                interimText = '';
                suggestionsTextarea.value = baseText;
            }
            stopRecording();
        };
        
        function stopRecording() {
            if (recognition && isRecording) {
                recognition.stop();
            }
            isRecording = false;
            
            // Finalize any interim text
            if (interimText) {
                baseText += ' ' + interimText;
                interimText = '';
                suggestionsTextarea.value = baseText;
            }
            
            voiceBtn.classList.remove('from-red-500', 'to-red-600');
            voiceBtn.classList.add('from-blue-500', 'to-indigo-600');
            voiceBtnText.textContent = 'Voice';
            recordingIndicator.classList.add('hidden');
            micIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>';
        }
        
        voiceBtn.addEventListener('click', function() {
            if (!isRecording) {
                // Start recording - save current text as base
                baseText = suggestionsTextarea.value;
                interimText = '';
                lastFinalIndex = 0;
                
                try {
                    recognition.start();
                } catch (error) {
                    console.error('Error starting recognition:', error);
                    alert('Error starting voice recognition. Please try again. / वॉइस रिकॉग्निशन शुरू करने में त्रुटि। कृपया पुनः प्रयास करें।');
                }
            } else {
                // Stop recording
                stopRecording();
            }
        });
    } else {
        // Browser doesn't support speech recognition
        voiceBtn.style.display = 'none';
        console.warn('Speech recognition not supported in this browser');
    }
})();
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
@endsection
