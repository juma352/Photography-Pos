@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Profile Image -->
            <div class="flex justify-center lg:justify-start">
                <div class="relative">
                    <div class="w-80 h-80 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20">
                        <img src="{{ asset('Images/profile.jpg') }}" 
                             alt="Grace Matu - Visual Storyteller" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-blue-500/30 rounded-full blur-xl"></div>
                    <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-purple-500/20 rounded-full blur-xl"></div>
                </div>
            </div>
            
            <!-- Text Content -->
            <div class="text-center lg:text-left">
                <h1 class="font-artistic-heading text-5xl lg:text-6xl font-bold mb-4 text-gradient">Grace Matu</h1>
                <h2 class="font-artistic-script text-2xl lg:text-3xl text-blue-400 mb-6">Visual Storyteller & Photographer</h2>
                <p class="font-artistic-body text-lg text-gray-300 leading-relaxed">
                    Passionate visual storyteller with a rich background in Theatre Arts and Film, celebrating the vibrancy of everyday life through photography.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-5xl mx-auto py-16 px-6">
    <!-- Biography Section -->
    <section class="mb-16">
        <h3 class="font-artistic-heading text-3xl font-bold mb-8 text-center underline-artistic">About Grace</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div class="space-y-6">
                <p class="font-artistic-body text-lg text-gray-700 leading-relaxed">
                    Grace Matu is a passionate visual storyteller with a rich background in Theatre Arts and Film. Her photography celebrates the vibrancy of everyday life, with a signature attention to color that transforms ordinary moments into extraordinary reflections of beauty, resilience, and truth.
                </p>
                
                <p class="font-artistic-body text-lg text-gray-700 leading-relaxed">
                    Guided by empathy, curiosity, and a commitment to justice, Grace uses her lens to explore critical social issues such as Ableism and inequality. Her work invites viewers to look closer in order to see not just what's visible, but what's often overlooked.
                </p>
            </div>
            
            <div class="space-y-6">
                <p class="font-artistic-body text-lg text-gray-700 leading-relaxed">
                    Her dedication to storytelling has earned international recognition, including the Cinemonitor Cineonu Award from Duemila30 and Rome University. Her films have also been featured at festivals such as the European Film Festival Integration You and Me, underscoring her creative excellence and advocacy.
                </p>
                
                <p class="font-artistic-body text-lg text-gray-700 leading-relaxed">
                    Whether documenting quiet moments or bold movements, Grace's photography educates, empowers, and uplifts, always with a focus on building equitable, decolonial communities through art.
                </p>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="mb-16 bg-gray-50 rounded-2xl p-8">
        <h3 class="font-artistic-heading text-3xl font-bold mb-8 text-center text-gradient">Recognition & Achievements</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h4 class="font-artistic-sub text-xl font-semibold text-gray-900">International Award</h4>
                </div>
                <p class="font-artistic-body text-gray-600">
                    Cinemonitor Cineonu Award from Duemila30 and Rome University
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0V3a1 1 0 00-1 1v14a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H7z"></path>
                        </svg>
                    </div>
                    <h4 class="font-artistic-sub text-xl font-semibold text-gray-900">Film Festival</h4>
                </div>
                <p class="font-artistic-body text-gray-600">
                    Featured at European Film Festival Integration You and Me
                </p>
            </div>
        </div>
    </section>

    <!-- Artistic Vision Section -->
    <section class="mb-16">
        <h3 class="font-artistic-heading text-3xl font-bold mb-8 text-center underline-artistic">Artistic Vision</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h4 class="font-artistic-sub text-xl font-semibold text-gray-900 mb-3">Color & Beauty</h4>
                <p class="font-artistic-body text-gray-600">
                    Signature attention to color that transforms ordinary moments into extraordinary reflections
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h4 class="font-artistic-sub text-xl font-semibold text-gray-900 mb-3">Social Justice</h4>
                <p class="font-artistic-body text-gray-600">
                    Exploring critical social issues such as Ableism and inequality through empathetic storytelling
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h4 class="font-artistic-sub text-xl font-semibold text-gray-900 mb-3">Community Building</h4>
                <p class="font-artistic-body text-gray-600">
                    Building equitable, decolonial communities through art that educates, empowers, and uplifts
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 text-center">
        <h3 class="font-artistic-heading text-3xl font-bold mb-6 text-gradient">Let's Connect</h3>
        <p class="font-artistic-script text-xl text-gray-600 mb-8">
            Ready to tell your story through photography?
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="mailto:productionmawingu@gmail.com" 
               class="font-artistic-body bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Email Me
            </a>
            
            <a href="https://youtube.com/@mawinguprod.?si=LwKKMtefrWR-J0gX" 
               target="_blank"
               class="font-artistic-body bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                YouTube Channel
            </a>
        </div>
    </section>
</div>
@endsection
