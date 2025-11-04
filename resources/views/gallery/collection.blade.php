@extends('layouts.app')

@section('content')
<!-- Collection Hero -->
<div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-20">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('gallery') }}" class="inline-flex items-center text-gray-300 hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Gallery
            </a>
        </div>
        
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">{{ $collection['title'] }}</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-6">{{ $collection['description'] }}</p>
            <div class="flex items-center justify-center space-x-6 text-sm text-gray-400">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                    {{ count($collection['photos']) }} Photos
                </span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    Grace Matu Photography
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Photos Grid -->
<div class="max-w-7xl mx-auto py-16 px-6">
    <!-- Masonry Grid Layout -->
    <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
        @foreach($collection['photos'] as $index => $photo)
            <div class="break-inside-avoid group cursor-pointer" 
                 x-data="{ showInfo: false }"
                 x-on:click="$dispatch('open-lightbox', { src: '{{ asset('Images/' . $photo['src']) }}', title: '{{ $photo['title'] }}', description: '{{ $photo['description'] }}', index: {{ $index }} })">
                
                <div class="relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 bg-white">
                    <!-- Image -->
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('Images/' . $photo['src']) }}" 
                             alt="{{ $photo['title'] }}"
                             class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white">
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Photo Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-1">{{ $photo['title'] }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ $photo['description'] }}</p>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="text-xs text-blue-600 hover:text-blue-800 font-medium">View Details</button>
                            <div class="flex space-x-2">
                                <button class="p-1 text-gray-400 hover:text-red-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <button class="p-1 text-gray-400 hover:text-blue-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Lightbox Modal -->
<div x-data="{ 
    open: false, 
    currentPhoto: null, 
    currentIndex: 0,
    photos: @json($collection['photos']),
    showInfo: false,
    nextPhoto() {
        this.currentIndex = (this.currentIndex + 1) % this.photos.length;
        this.currentPhoto = this.photos[this.currentIndex];
    },
    prevPhoto() {
        this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;
        this.currentPhoto = this.photos[this.currentIndex];
    }
}" 
@open-lightbox.window="
    open = true; 
    currentIndex = $event.detail.index; 
    currentPhoto = photos[currentIndex];
"
@keydown.escape.window="open = false"
@keydown.arrow-right.window="if(open) nextPhoto()"
@keydown.arrow-left.window="if(open) prevPhoto()">
    
    <template x-if="open && currentPhoto">
        <div class="fixed inset-0 bg-black/95 flex items-center justify-center z-50 p-4" 
             x-on:click.self="open = false">
            
            <!-- Close Button -->
            <button @click="open = false" 
                    class="absolute top-6 right-6 text-white/70 hover:text-white z-10 p-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Navigation Arrows -->
            <button @click="prevPhoto()" 
                    class="absolute left-6 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white z-10 p-2"
                    x-show="photos.length > 1">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button @click="nextPhoto()" 
                    class="absolute right-6 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white z-10 p-2"
                    x-show="photos.length > 1">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Image Container -->
            <div class="flex flex-col lg:flex-row max-w-7xl w-full h-full">
                <!-- Image -->
                <div class="flex-1 flex items-center justify-center">
                    <img :src="`{{ asset('Images/') }}/${currentPhoto.src}`" 
                         :alt="currentPhoto.title"
                         class="max-w-full max-h-full object-contain rounded-lg">
                </div>
                
                <!-- Info Panel -->
                <div class="lg:w-80 bg-white/95 backdrop-blur-sm p-6 lg:h-full overflow-y-auto" 
                     x-show="showInfo" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0">
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="currentPhoto.title"></h3>
                    <p class="text-gray-600 mb-4" x-text="currentPhoto.description"></p>
                    
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>Collection: {{ $collection['title'] }}</div>
                        <div>Photographer: Grace Matu</div>
                        <div x-text="`Photo ${currentIndex + 1} of ${photos.length}`"></div>
                    </div>
                </div>
            </div>
            
            <!-- Info Toggle Button -->
            <button @click="showInfo = !showInfo" 
                    class="absolute bottom-6 right-6 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>
            
            <!-- Photo Counter -->
            <div class="absolute bottom-6 left-6 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm"
                 x-show="photos.length > 1">
                <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
            </div>
        </div>
    </template>
</div>
@endsection