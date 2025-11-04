@extends('admin.layout')

@section('title', 'Photos')
@section('page-title', 'Photos')

@section('breadcrumbs')
    <span class="text-gray-500">Admin</span> / <span class="text-gray-900">Photos</span>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Photo Gallery</h2>
        <p class="text-gray-600">Manage your photography portfolio</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.photos.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Upload Photo
        </a>
        <button @click="showBulkUpload = true" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            Bulk Upload
        </button>
    </div>
</div>

@if($photos->count() > 0)
    <!-- Bulk Actions Bar -->
    <div x-data="{ 
        selectedPhotos: [],
        showBulkActions: false,
        selectAll() {
            this.selectedPhotos = this.selectedPhotos.length === {{ $photos->count() }} ? [] : [...document.querySelectorAll('input[name=\'photo_ids[]\']')].map(input => input.value);
            this.showBulkActions = this.selectedPhotos.length > 0;
        },
        togglePhoto(photoId) {
            if (this.selectedPhotos.includes(photoId)) {
                this.selectedPhotos = this.selectedPhotos.filter(id => id !== photoId);
            } else {
                this.selectedPhotos.push(photoId);
            }
            this.showBulkActions = this.selectedPhotos.length > 0;
        }
    }" class="mb-6">
        
        <!-- Bulk Actions Panel -->
        <div x-show="showBulkActions" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-blue-800" x-text="`${selectedPhotos.length} photo(s) selected`"></span>
                <div class="flex space-x-3">
                    <form method="POST" action="{{ route('admin.photos.bulk-update') }}" class="inline">
                        @csrf
                        <input type="hidden" name="action" value="feature">
                        <template x-for="photoId in selectedPhotos">
                            <input type="hidden" name="photo_ids[]" :value="photoId">
                        </template>
                        <button type="submit" class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Mark Featured
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.photos.bulk-update') }}" class="inline">
                        @csrf
                        <input type="hidden" name="action" value="unfeature">
                        <template x-for="photoId in selectedPhotos">
                            <input type="hidden" name="photo_ids[]" :value="photoId">
                        </template>
                        <button type="submit" class="text-sm bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                            Unmark Featured
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.photos.bulk-update') }}" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete selected photos?')">
                        @csrf
                        <input type="hidden" name="action" value="delete">
                        <template x-for="photoId in selectedPhotos">
                            <input type="hidden" name="photo_ids[]" :value="photoId">
                        </template>
                        <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Delete Selected
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Photos Grid -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">All Photos ({{ $photos->total() }})</h3>
                <label class="flex items-center">
                    <input type="checkbox" 
                           @change="selectAll()"
                           :checked="selectedPhotos.length === {{ $photos->count() }} && selectedPhotos.length > 0"
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Select All</span>
                </label>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 p-6">
                @foreach($photos as $photo)
                    <div class="relative group">
                        <!-- Selection Checkbox -->
                        <div class="absolute top-2 left-2 z-10">
                            <input type="checkbox" 
                                   name="photo_ids[]"
                                   value="{{ $photo->id }}"
                                   @change="togglePhoto('{{ $photo->id }}')"
                                   :checked="selectedPhotos.includes('{{ $photo->id }}')"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <!-- Photo Card -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">
                            <div class="aspect-square relative overflow-hidden">
                                <img src="{{ $photo->image_url }}" 
                                     alt="{{ $photo->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                
                                <!-- Featured Badge -->
                                @if($photo->is_featured)
                                    <div class="absolute top-2 right-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            Featured
                                        </span>
                                    </div>
                                @endif

                                <!-- Overlay with Actions -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex space-x-2">
                                        <a href="{{ route('admin.photos.show', $photo) }}" 
                                           class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" 
                                           title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.photos.edit', $photo) }}" 
                                           class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" 
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Photo Info -->
                            <div class="p-3">
                                <h4 class="font-medium text-gray-900 text-sm truncate">{{ $photo->title }}</h4>
                                <p class="text-xs text-gray-500 truncate">{{ $photo->collection->title }}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-400">{{ $photo->created_at->format('M j, Y') }}</span>
                                    <div class="flex space-x-1">
                                        <form method="POST" action="{{ route('admin.photos.toggle-featured', $photo) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="text-yellow-600 hover:text-yellow-800 p-1" 
                                                    title="{{ $photo->is_featured ? 'Unmark Featured' : 'Mark Featured' }}">
                                                @if($photo->is_featured)
                                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}" 
                                              class="inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this photo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-1" 
                                                    title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($photos->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $photos->links() }}
                </div>
            @endif
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No photos uploaded</h3>
        <p class="mt-2 text-gray-500">Get started by uploading your first photo.</p>
        <div class="mt-6">
            <a href="{{ route('admin.photos.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                Upload Photo
            </a>
        </div>
    </div>
@endif

<!-- Bulk Upload Modal -->
<div x-data="{ showBulkUpload: false }" 
     x-show="showBulkUpload" 
     x-cloak
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Bulk Upload Photos</h3>
        </div>
        <form action="{{ route('admin.photos.upload') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Collection</label>
                <select name="collection_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">Select Collection</option>
                    @foreach(\App\Models\Collection::active()->orderBy('title')->get() as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Photos</label>
                <input type="file" name="photos[]" multiple accept="image/*" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" @click="showBulkUpload = false"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Upload Photos
                </button>
            </div>
        </form>
    </div>
</div>
@endsection