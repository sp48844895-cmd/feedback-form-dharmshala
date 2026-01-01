@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 py-8 sm:py-12">
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden backdrop-blur-xl">
        <!-- Header -->
        <div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 px-6 sm:px-10 py-8 sm:py-12 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-400/20 rounded-full -ml-24 -mb-24 blur-2xl"></div>
            
            <div class="relative z-10 text-center">
                <h1 class="text-2xl sm:text-3xl font-semibold text-white tracking-tight mb-1">Shree Ram Bhavan Dharmashala</h1>
                <p class="text-blue-100 text-sm sm:text-base font-light mb-3">श्रीराम भवन धर्मशाला</p>
                <h2 class="text-xl sm:text-2xl font-semibold text-white tracking-tight mb-2">Login</h2>
                <p class="text-blue-100 text-base sm:text-lg font-light">Access your account</p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="p-6 sm:p-10 md:p-12 bg-gradient-to-b from-gray-50/50 to-white">
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm font-medium">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 tracking-wide">
                        Username
                    </label>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                        <input 
                            type="text" 
                            name="username"
                            class="relative w-full px-5 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm hover:border-blue-300 hover:shadow-md"
                            placeholder="Enter your username"
                            required
                            autofocus
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 tracking-wide">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-xl"></div>
                        <input 
                            type="password" 
                            name="password"
                            class="relative w-full px-5 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 outline-none text-sm text-gray-800 placeholder:text-gray-400 shadow-sm hover:border-indigo-300 hover:shadow-md"
                            placeholder="Enter your password"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="relative w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02] overflow-hidden group"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span>Login</span>
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
</div>
@endsection

