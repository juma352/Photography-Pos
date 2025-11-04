@extends('admin.layout')

@section('title', $photo->title)
@section('page-title', 'Photo Details')

@section('breadcrumbs')
    <span class="text-gray-500">Admin</span> / 
    <a href="{{ route('admin.photos.index') }}" class="text-blue-600 hover:text-blue-800">Photos</a> / 
    <span class="text-gray-900">{{ $photo->title }}</span>
@endsection

@section('content')
<div class="max-w-6xl">
    <!-- Photo Header -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-semibold text-gray-900">{{ $photo->title }}</h1>
                @if($photo->is_featured)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Featured
                    </span>
                @endif
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.photos.edit', $photo) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Photo
                </a>
                <button onclick="openDeleteModal()" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Photo Display -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="aspect-auto bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ $photo->image_url }}" 
                         alt="{{ $photo->alt_text ?: $photo->title }}" 
                         class="w-full h-auto object-contain">
                </div>
                
                <!-- Photo Actions -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="flex space-x-4">
                        <a href="{{ $photo->image_url }}" 
                           target="_blank"
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            View Full Size
                        </a>
                        <button onclick="copyImageUrl()" 
                                class="text-gray-600 hover:text-gray-800 font-medium text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Copy URL
                        </button>
                    </div>
                    @if($photo->is_featured)
                        <form action="{{ route('admin.photos.toggle-featured', $photo) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="text-yellow-600 hover:text-yellow-800 font-medium text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Remove from Featured
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.photos.toggle-featured', $photo) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="text-gray-600 hover:text-yellow-600 font-medium text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 20 20" stroke-width="2">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Make Featured
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Photo Information -->
        <div class="space-y-6">
            <!-- Details Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Photo Details</h3>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $photo->description }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Collection</dt>
                        <dd class="mt-1">
                            <a href="{{ route('admin.collections.show', $photo->collection) }}" 
                               class="text-sm text-blue-600 hover:text-blue-800">{{ $photo->collection->title }}</a>
                        </dd>
                    </div>
                    @if($photo->alt_text)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Alt Text</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $photo->alt_text }}</dd>
                    </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Original Filename</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $photo->original_filename }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">File Path</dt>
                        <dd class="mt-1 text-sm text-gray-900 break-all">{{ $photo->file_path }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Uploaded</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $photo->created_at->format('M j, Y g:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $photo->updated_at->format('M j, Y g:i A') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Collection Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Collection Info</h3>
                <div class="space-y-3">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $photo->collection->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $photo->collection->description }}</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $photo->collection->photos()->count() }} photos in this collection
                    </div>
                    <a href="{{ route('admin.collections.show', $photo->collection) }}" 
                       class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                        View Collection
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Navigation Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Navigation</h3>
                <div class="space-y-3">
                    @if($previousPhoto)
                        <a href="{{ route('admin.photos.show', $previousPhoto) }}" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous: {{ $previousPhoto->title }}
                        </a>
                    @endif
                    
                    @if($nextPhoto)
                        <a href="{{ route('admin.photos.show', $nextPhoto) }}" 
                           class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                            Next: {{ $nextPhoto->title }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                    
                    <a href="{{ route('admin.photos.index') }}" 
                       class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                        </svg>
                        Back to All Photos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
        <div class="flex items-center">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
        </div>
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900">Delete Photo</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete "{{ $photo->title }}"? This action cannot be undone.
                </p>
            </div>
        </div>
        <div class="mt-5 flex justify-center space-x-3">
            <button onclick="closeDeleteModal()" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium">
                Cancel
            </button>
            <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium">
                    Delete Photo
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

function copyImageUrl() {
    const url = '{{ $photo->image_url }}';
    navigator.clipboard.writeText(url).then(function() {
        // Show temporary success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = `
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Copied!
        `;
        button.classList.add('text-green-600');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('text-green-600');
        }, 2000);
    });
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Close modal on backdrop click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection