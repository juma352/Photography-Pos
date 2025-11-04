@extends('admin.layout')

@section('title', 'Edit Photo')
@section('page-title', 'Edit Photo')

@section('breadcrumbs')
    <span class="text-gray-500">Admin</span> / 
    <a href="{{ route('admin.photos.index') }}" class="text-blue-600 hover:text-blue-800">Photos</a> / 
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Current Photo Preview -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Current Photo</h3>
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                <img src="{{ $photo->image_url }}" 
                     alt="{{ $photo->title }}" 
                     class="w-full h-full object-cover">
            </div>
            <div class="mt-4 space-y-2">
                <p class="text-sm text-gray-600"><strong>Original filename:</strong> {{ $photo->original_filename }}</p>
                <p class="text-sm text-gray-600"><strong>Uploaded:</strong> {{ $photo->created_at->format('M j, Y g:i A') }}</p>
                @if($photo->is_featured)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Featured
                    </span>
                @endif
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Edit Photo Details</h3>
                <p class="text-sm text-gray-600 mt-1">Update photo information and settings</p>
            </div>
            
            <form action="{{ route('admin.photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Replace Photo (Optional) -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        Replace Photo (optional)
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200"
                         x-data="{ 
                            dragover: false,
                            previewUrl: null,
                            fileName: null,
                            handleFiles(files) {
                                if (files.length > 0) {
                                    const file = files[0];
                                    this.fileName = file.name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        this.previewUrl = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                }
                            }
                         }"
                         @dragover.prevent="dragover = true"
                         @dragleave.prevent="dragover = false"
                         @drop.prevent="dragover = false; handleFiles($event.dataTransfer.files); $refs.fileInput.files = $event.dataTransfer.files"
                         :class="{ 'border-blue-400 bg-blue-50': dragover }">
                        
                        <div x-show="!previewUrl" class="space-y-1 text-center">
                            <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload replacement</span>
                                    <input id="photo" 
                                           name="photo" 
                                           type="file" 
                                           class="sr-only" 
                                           accept="image/*"
                                           x-ref="fileInput"
                                           @change="handleFiles($event.target.files)">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">Leave empty to keep current photo</p>
                        </div>
                        
                        <div x-show="previewUrl" x-cloak class="space-y-2">
                            <img :src="previewUrl" class="mx-auto max-h-32 rounded-lg">
                            <p class="text-sm text-gray-600 text-center" x-text="fileName"></p>
                            <button type="button" @click="previewUrl = null; fileName = null; $refs.fileInput.value = ''" 
                                    class="mx-auto block text-sm text-red-600 hover:text-red-800">
                                Remove
                            </button>
                        </div>
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $photo->title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                              required>{{ old('description', $photo->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Collection -->
                <div>
                    <label for="collection_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Collection <span class="text-red-500">*</span>
                    </label>
                    <select id="collection_id" 
                            name="collection_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('collection_id') border-red-500 @enderror"
                            required>
                        @foreach($collections as $collection)
                            <option value="{{ $collection->id }}" {{ old('collection_id', $photo->collection_id) == $collection->id ? 'selected' : '' }}>
                                {{ $collection->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('collection_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alt Text -->
                <div>
                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                        Alt Text (for accessibility)
                    </label>
                    <input type="text" 
                           id="alt_text" 
                           name="alt_text" 
                           value="{{ old('alt_text', $photo->alt_text) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Brief description for screen readers">
                    @error('alt_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured -->
                <div>
                    <div class="flex items-center">
                        <input id="is_featured" 
                               name="is_featured" 
                               type="checkbox" 
                               value="1"
                               {{ old('is_featured', $photo->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                            Featured Photo
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                        Featured photos are highlighted throughout the portfolio
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.photos.index') }}" 
                           class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <a href="{{ route('admin.photos.show', $photo) }}" 
                           class="bg-purple-100 hover:bg-purple-200 text-purple-800 px-4 py-2 rounded-md font-medium transition-colors duration-200">
                            View Photo
                        </a>
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Photo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection