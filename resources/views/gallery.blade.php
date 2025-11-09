@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="font-artistic-heading text-5xl font-bold mb-4 text-gradient">Mawingu Collections</h1>
        <p class="font-artistic-body text-xl text-gray-300 max-w-2xl mx-auto">Discover our curated photography collections that capture the essence of rebellion, movement, and artistic expression</p>
    </div>
</div>

<!-- Collections Grid -->
<div class="max-w-7xl mx-auto py-16 px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($collections as $collection)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white">
                <a href="{{ route('gallery.collection', $collection['id']) }}" class="block h-full">
                    <!-- Collection Cover Image with Fixed Height -->
                    <div class="relative h-80 overflow-hidden">
                        <img src="{{ asset('Images/' . $collection['cover_image']) }}" 
                             alt="{{ $collection['title'] }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="font-artistic-heading text-2xl font-bold mb-2 line-clamp-1">{{ $collection['title'] }}</h3>
                            <p class="font-artistic-body text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100 line-clamp-3 text-sm leading-relaxed">
                                {{ Str::limit($collection['description'], 120) }}
                            </p>
                            
                            <!-- Photo Count & Collection Info -->
                            <div class="flex items-center justify-between mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-sm font-medium">{{ count($collection['photos']) }} photos</span>
                                </div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">
                                    Mawingu Collection
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hover Effect Arrow -->
                        <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured Statistics -->
<div class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ collect($collections)->sum(function($c) { return count($c['photos']); }) }}</div>
                <div class="text-gray-600">Total Photos</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ count($collections) }}</div>
                <div class="text-gray-600">Collections</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">3+</div>
                <div class="text-gray-600">Years Experience</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900 mb-2">∞</div>
                <div class="text-gray-600">Creative Vision</div>
            </div>
        </div>
    </div>
</div>
@endsection
