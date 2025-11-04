@extends('layouts.app')

@section('content')
<!-- Hero Section with Profile -->
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white min-h-[95vh] flex items-center justify-center overflow-hidden">
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <!-- Profile Image Section -->
            <div class="flex justify-center lg:justify-end order-2 lg:order-1 animate-fade-in-up">
                <div class="relative group">
                    <!-- Main Profile Image -->
                    <div class="w-80 h-80 lg:w-96 lg:h-96 rounded-full overflow-hidden border-4 border-white/30 shadow-2xl transition-all duration-500 group-hover:border-white/50 group-hover:shadow-purple-500/20 group-hover:shadow-2xl animate-float">
                        <img src="{{ asset('Images/profile.jpg') }}" 
                             alt="Grace Matu - Professional Photographer" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    
                    <!-- Enhanced Decorative Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-blue-500/40 rounded-full blur-xl animate-pulse-slow"></div>
                    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-purple-500/30 rounded-full blur-xl animate-pulse-slow delay-1000"></div>
                    <div class="absolute top-1/2 -left-4 w-16 h-16 bg-pink-500/20 rounded-full blur-lg animate-bounce-slow"></div>
                    
                    <!-- Enhanced Photography Badge -->
                    <div class="absolute bottom-6 right-6 bg-white/95 backdrop-blur-sm rounded-full px-5 py-3 shadow-xl transition-all duration-300 hover:scale-105 hover:bg-white">
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-gray-800 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm font-bold text-gray-800 letter-spacing-wide">Photographer</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Text Content Section -->
            <div class="text-center lg:text-left order-1 lg:order-2 animate-fade-in-left">
                <div class="mb-8">
                    <h2 class="font-artistic-script text-2xl lg:text-3xl font-medium text-blue-400 mb-4 animate-fade-in-down delay-300">Hello, I'm</h2>
                    <h1 class="font-artistic-heading text-6xl lg:text-7xl font-bold mb-6 leading-tight text-gradient text-shadow-elegant animate-fade-in-down delay-500">
                        Grace Matu
                    </h1>
                    <h3 class="font-artistic-sub text-3xl lg:text-4xl font-light text-gray-300 mb-8 letter-spacing-wider animate-fade-in-down delay-700">
                        Professional Photographer
                    </h3>
                </div>
                
                <p class="font-artistic-body text-xl lg:text-2xl text-gray-300 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0 animate-fade-in-up delay-1000">
                    Capturing moments that last forever. Through my lens, I tell stories that connect hearts and preserve memories for generations to come.
                </p>
                
                <!-- Enhanced Call to Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center lg:justify-start animate-fade-in-up delay-1000">
                    <a href="{{ route('gallery') }}" 
                       class="btn-gradient text-white px-10 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-blue-500/25 flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        View My Work
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="border-2 border-white/50 hover:border-white text-white hover:bg-white hover:text-gray-900 px-10 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105 backdrop-blur-sm flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Get In Touch
                    </a>
                </div>
                
                <!-- Enhanced Social Stats -->
                <div class="mt-16 flex justify-center lg:justify-start space-x-12 animate-fade-in-up delay-1000">
                    <div class="text-center group cursor-pointer">
                        <div class="text-3xl font-bold text-white transition-all duration-300 group-hover:text-blue-400 group-hover:scale-110">500+</div>
                        <div class="text-sm text-gray-400 letter-spacing-wide transition-colors duration-300 group-hover:text-gray-300">Happy Clients</div>
                    </div>
                    <div class="text-center group cursor-pointer">
                        <div class="text-3xl font-bold text-white transition-all duration-300 group-hover:text-purple-400 group-hover:scale-110">1000+</div>
                        <div class="text-sm text-gray-400 letter-spacing-wide transition-colors duration-300 group-hover:text-gray-300">Photos Taken</div>
                    </div>
                    <div class="text-center group cursor-pointer">
                        <div class="text-3xl font-bold text-white transition-all duration-300 group-hover:text-pink-400 group-hover:scale-110">5+</div>
                        <div class="text-sm text-gray-400 letter-spacing-wide transition-colors duration-300 group-hover:text-gray-300">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Background Effects -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.15"><circle cx="20" cy="20" r="3"/><circle cx="60" cy="60" r="3"/><circle cx="40" cy="40" r="2"/><circle cx="70" cy="20" r="2"/><circle cx="10" cy="60" r="2"/></g></svg>')"></div>
    </div>
    
    <!-- Animated Background Particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-blue-400 rounded-full animate-ping opacity-75"></div>
        <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-purple-400 rounded-full animate-pulse opacity-60"></div>
        <div class="absolute top-1/2 left-3/4 w-1 h-1 bg-pink-400 rounded-full animate-bounce opacity-80"></div>
        <div class="absolute bottom-1/4 left-1/2 w-2 h-2 bg-indigo-400 rounded-full animate-ping opacity-50 delay-1000"></div>
    </div>
</section>

<!-- About Section -->
<section class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="font-artistic-heading text-5xl font-bold text-gray-900 mb-8 underline-artistic">My Photography Journey</h2>
            <p class="font-artistic-body text-xl text-gray-600 leading-relaxed mb-12 max-w-3xl mx-auto">
                Photography is more than just capturing images—it's about freezing emotions, preserving stories, and creating art that speaks to the soul. With over 5 years of experience, I specialize in portrait, landscape, and event photography, bringing a unique perspective to every shot.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-16">
                <div class="text-center group transition-all duration-500 hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-blue-200">
                        <svg class="w-10 h-10 text-blue-600 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-artistic-sub text-2xl font-semibold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-blue-600">Creative Vision</h3>
                    <p class="font-artistic-body text-gray-600 leading-relaxed">Bringing unique perspectives and artistic flair to every photograph.</p>
                </div>
                <div class="text-center group transition-all duration-500 hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-purple-200">
                        <svg class="w-10 h-10 text-purple-600 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-artistic-sub text-2xl font-semibold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-purple-600">Passionate Work</h3>
                    <p class="font-artistic-body text-gray-600 leading-relaxed">Every shoot is approached with genuine passion and dedication.</p>
                </div>
                <div class="text-center group transition-all duration-500 hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-green-200">
                        <svg class="w-10 h-10 text-green-600 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="font-artistic-sub text-2xl font-semibold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-green-600">Quality Results</h3>
                    <p class="font-artistic-body text-gray-600 leading-relaxed">Delivering high-quality images that exceed expectations.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
