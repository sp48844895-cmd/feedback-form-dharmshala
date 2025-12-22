<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Guest Feedback Form')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen">
    @if(Session::has('user_id'))
    <!-- Modern Navigation Bar -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6">
            <!-- Mobile/Tablet View -->
            <div class="lg:hidden">
                <div class="flex items-center justify-between py-3">
                    <!-- Logo -->
                    <a href="{{ Session::get('user_role') === 'admin' ? route('admin.list') : route('feedback.index') }}" class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Feedback
                    </a>
                    
                    <!-- Hamburger Menu Button -->
                    <button id="mobile-menu-toggle" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Dropdown -->
                <div id="mobile-menu" class="hidden pb-4 space-y-2">
                    <!-- User Info -->
                    <div class="px-3 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl mb-3">
                        <p class="text-xs text-gray-500 mb-1">Logged in as</p>
                        <p class="text-sm font-semibold text-gray-800">{{ Session::get('username') }}</p>
                    </div>

                    <!-- Navigation Links -->
                    @if(Session::get('user_role') !== 'admin')
                    <a href="{{ route('feedback.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all {{ request()->routeIs('feedback.*') && !request()->routeIs('admin.*') && !request()->routeIs('report') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Feedback Form</span>
                    </a>
                    @endif

                    @if(Session::get('user_role') === 'admin')
                    <a href="{{ route('admin.list') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Feedback List</span>
                    </a>
                    <a href="{{ route('report') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all {{ request()->routeIs('report') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Reports</span>
                    </a>
                    @endif

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="pt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Desktop View -->
            <div class="hidden lg:flex items-center justify-between py-3">
                <div class="flex items-center gap-8">
                    <a href="{{ Session::get('user_role') === 'admin' ? route('admin.list') : route('feedback.index') }}" class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Feedback System
                    </a>
                    @if(Session::get('user_role') === 'admin')
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.list') }}" class="px-4 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                            Feedback List
                        </a>
                        <a href="{{ route('report') }}" class="px-4 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all {{ request()->routeIs('report') ? 'bg-blue-50 text-blue-600' : '' }}">
                            Reports
                        </a>
                    </div>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Welcome, <span class="font-semibold text-gray-800">{{ Session::get('username') }}</span></span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all text-sm font-medium shadow-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = mobileMenu.contains(event.target) || menuToggle.contains(event.target);
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            // Close menu when clicking on a link
            const menuLinks = mobileMenu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        });
    </script>
    @endif

    @yield('content')
</body>
</html>

