<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white shadow-lg" x-data="{ open: true }">
            <!-- Logo/Header -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center">
                    <img src="{{ asset('Images/Grace-logo.jpg') }}" alt="Grace Photography" class="h-10 w-10 rounded-lg">
                    <div class="ml-3">
                        <h2 class="text-lg font-semibold">Grace Photography</h2>
                        <p class="text-sm text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-6 py-2">
                    <p class="text-xs uppercase text-gray-400 font-semibold tracking-wider">Main</p>
                </div>
                
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white border-r-4 border-blue-500' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>

                <div class="px-6 py-2 mt-6">
                    <p class="text-xs uppercase text-gray-400 font-semibold tracking-wider">Content</p>
                </div>

                <!-- Collections -->
                <a href="{{ route('admin.collections.index') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('admin.collections.*') ? 'bg-gray-800 text-white border-r-4 border-blue-500' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Collections
                </a>

                <!-- Photos -->
                <a href="{{ route('admin.photos.index') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('admin.photos.*') ? 'bg-gray-800 text-white border-r-4 border-blue-500' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Photos
                </a>

                <div class="px-6 py-2 mt-6">
                    <p class="text-xs uppercase text-gray-400 font-semibold tracking-wider">Account</p>
                </div>

                <!-- Profile -->
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>

                <!-- View Site -->
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View Site
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-800 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('breadcrumbs')
                            <nav class="text-sm text-gray-500 mt-1">
                                @yield('breadcrumbs')
                            </nav>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- User Info -->
                        <div class="flex items-center text-sm text-gray-600">
                            <span>Welcome, {{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center justify-between">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="text-green-700 hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center justify-between">
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="text-red-700 hover:text-red-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>