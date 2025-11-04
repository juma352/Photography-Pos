@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Collections -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_collections'] }}</h3>
                <p class="text-gray-600">Total Collections</p>
            </div>
        </div>
    </div>

    <!-- Active Collections -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['active_collections'] }}</h3>
                <p class="text-gray-600">Active Collections</p>
            </div>
        </div>
    </div>

    <!-- Total Photos -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_photos'] }}</h3>
                <p class="text-gray-600">Total Photos</p>
            </div>
        </div>
    </div>

    <!-- Featured Photos -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-900">{{ $stats['featured_photos'] }}</h3>
                <p class="text-gray-600">Featured Photos</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Quick Actions Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.collections.create') }}" 
               class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 group">
                <div class="p-2 bg-blue-500 text-white rounded-lg group-hover:bg-blue-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-gray-900">Create New Collection</p>
                    <p class="text-sm text-gray-600">Add a new photo collection</p>
                </div>
            </a>

            <a href="{{ route('admin.photos.create') }}" 
               class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200 group">
                <div class="p-2 bg-green-500 text-white rounded-lg group-hover:bg-green-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-gray-900">Upload Photos</p>
                    <p class="text-sm text-gray-600">Add new photos to collections</p>
                </div>
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200 group">
                <div class="p-2 bg-purple-500 text-white rounded-lg group-hover:bg-purple-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-gray-900">View Portfolio</p>
                    <p class="text-sm text-gray-600">See your live website</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Collections -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Recent Collections</h3>
            <a href="{{ route('admin.collections.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
        </div>
        
        @if($stats['recent_collections']->count() > 0)
            <div class="space-y-3">
                @foreach($stats['recent_collections'] as $collection)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">{{ $collection->title }}</p>
                            <p class="text-sm text-gray-600">{{ $collection->photos_count }} photos</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($collection->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            @endif
                            <a href="{{ route('admin.collections.edit', $collection) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">No collections yet. <a href="{{ route('admin.collections.create') }}" class="text-blue-600 hover:text-blue-800">Create your first collection</a></p>
        @endif
    </div>
</div>

<!-- Recent Photos -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Recent Photos</h3>
            <a href="{{ route('admin.photos.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
        </div>
    </div>
    
    @if($stats['recent_photos']->count() > 0)
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                @foreach($stats['recent_photos'] as $photo)
                    <div class="group relative">
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ $photo->image_url }}" 
                                 alt="{{ $photo->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                        </div>
                        <div class="mt-2">
                            <p class="font-medium text-gray-900 text-sm truncate">{{ $photo->title }}</p>
                            <p class="text-xs text-gray-600">{{ $photo->collection->title }}</p>
                            <p class="text-xs text-gray-500">{{ $photo->created_at->diffForHumans() }}</p>
                        </div>
                        @if($photo->is_featured)
                            <div class="absolute top-2 left-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Featured
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="p-6">
            <p class="text-gray-500 text-center py-8">No photos yet. <a href="{{ route('admin.photos.create') }}" class="text-blue-600 hover:text-blue-800">Upload your first photo</a></p>
        </div>
    @endif
</div>
@endsection