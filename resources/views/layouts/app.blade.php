<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Photo Portfolio') }}</title>
    
    <!-- Google Fonts for Artistic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Dancing+Script:wght@400;500;600;700&family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom Typography Styles -->
    <style>
        /* Primary Heading Font - Elegant and Artistic */
        .font-artistic-heading {
            font-family: 'Playfair Display', serif;
        }
        
        /* Secondary Heading Font - Modern and Clean */
        .font-artistic-sub {
            font-family: 'Crimson Text', serif;
        }
        
        /* Script Font for Signatures and Special Text */
        .font-artistic-script {
            font-family: 'Dancing Script', cursive;
        }
        
        /* Body Text - Modern and Readable */
        .font-artistic-body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Custom Text Effects */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .text-shadow-elegant {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .letter-spacing-wide {
            letter-spacing: 0.1em;
        }
        
        .letter-spacing-wider {
            letter-spacing: 0.2em;
        }
        
        /* Artistic underline effect */
        .underline-artistic {
            position: relative;
        }
        
        .underline-artistic::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
            opacity: 0.7;
        }
        
        /* Logo styling for enhanced visibility */
        .logo-enhanced {
            filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3)) contrast(1.3) brightness(0.8) saturate(1.4);
            transition: all 0.3s ease;
        }
        
        .logo-enhanced:hover {
            filter: drop-shadow(0 0 15px rgba(0, 0, 0, 0.4)) contrast(1.4) brightness(0.7) saturate(1.6);
            transform: scale(1.05);
        }
        
        /* Dark backdrop for logo */
        .logo-container {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.1) 100%);
            border-radius: 12px;
            padding: 8px 12px;
            backdrop-filter: blur(2px);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .logo-container:hover {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.08) 0%, rgba(0, 0, 0, 0.15) 100%);
            border-color: rgba(0, 0, 0, 0.2);
        }
        
        /* Enhanced Animations for Engagement */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes pulseSlow {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        @keyframes bounceSlow {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        /* Animation Classes */
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        
        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
            opacity: 0;
        }
        
        .animate-fade-in-left {
            animation: fadeInLeft 1s ease-out forwards;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-pulse-slow {
            animation: pulseSlow 4s ease-in-out infinite;
        }
        
        .animate-bounce-slow {
            animation: bounceSlow 3s infinite;
        }
        
        /* Delay Classes */
        .delay-300 {
            animation-delay: 0.3s;
        }
        
        .delay-500 {
            animation-delay: 0.5s;
        }
        
        .delay-700 {
            animation-delay: 0.7s;
        }
        
        .delay-1000 {
            animation-delay: 1s;
        }
        
        /* Enhanced Button Styles */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen font-artistic-body">

    {{-- Navbar --}}
    <nav class="bg-white/95 backdrop-blur-sm shadow-xl border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center group transition-all duration-300 hover:scale-105 logo-container">
                <img src="{{ asset('Images/88f4e623-f6d7-4fa6-8bc8-ee0e3d9d004e.png') }}" alt="Mawingu Photography Logo" 
                     class="h-28 w-auto logo-enhanced">
            </a>
            <div class="flex space-x-10">
                <a href="{{ route('gallery') }}" class="relative font-artistic-sub text-gray-700 font-semibold text-lg hover:text-blue-600 transition-all duration-300 letter-spacing-wide after:content-[''] after:absolute after:w-0 after:h-1 after:bottom-0 after:left-0 after:bg-gradient-to-r after:from-blue-600 after:to-purple-600 after:transition-all after:duration-300 hover:after:w-full after:rounded-full transform hover:-translate-y-1">Gallery</a>
                <a href="{{ route('about') }}" class="relative font-artistic-sub text-gray-700 font-semibold text-lg hover:text-blue-600 transition-all duration-300 letter-spacing-wide after:content-[''] after:absolute after:w-0 after:h-1 after:bottom-0 after:left-0 after:bg-gradient-to-r after:from-blue-600 after:to-purple-600 after:transition-all after:duration-300 hover:after:w-full after:rounded-full transform hover:-translate-y-1">About</a>
                <a href="{{ route('contact') }}" class="relative font-artistic-sub text-gray-700 font-semibold text-lg hover:text-blue-600 transition-all duration-300 letter-spacing-wide after:content-[''] after:absolute after:w-0 after:h-1 after:bottom-0 after:left-0 after:bg-gradient-to-r after:from-blue-600 after:to-purple-600 after:transition-all after:duration-300 hover:after:w-full after:rounded-full transform hover:-translate-y-1">Contact</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="relative font-artistic-sub bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg">Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Grace Matu Photography — All rights reserved.</p>
    </footer>

</body>
</html>
