@extends('admin.layout')

@section('title', 'Upload Photo')
@section('page-title', 'Upload New Photo')

@section('breadcrumbs')
    <span class="text-gray-500">Admin</span> / 
    <a href="{{ route('admin.photos.index') }}" class="text-blue-600 hover:text-blue-800">Photos</a> / 
    <span class="text-gray-900">Upload</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Photo Details</h3>
            <p class="text-sm text-gray-600 mt-1">Upload a new photo to your portfolio</p>
        </div>
        
        <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <!-- Photo Upload -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                    Photo <span class="text-red-500">*</span>
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
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload a file</span>
                                <input id="photo" 
                                       name="photo" 
                                       type="file" 
                                       class="sr-only" 
                                       accept="image/*"
                                       required
                                       x-ref="fileInput"
                                       @change="handleFiles($event.target.files)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                    
                    <div x-show="previewUrl" x-cloak class="space-y-2">
                        <img :src="previewUrl" class="mx-auto max-h-48 rounded-lg">
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
                       value="{{ old('title') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="e.g., Urban Portrait, Sunset Landscape..."
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
                          placeholder="Describe the photo, its story, or technical details..."
                          required>{{ old('description') }}</textarea>
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
                    <option value="">Select a collection</option>
                    @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
                            {{ $collection->title }}
                        </option>
                    @endforeach
                </select>
                @error('collection_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($collections->count() === 0)
                    <p class="mt-1 text-sm text-gray-500">
                        No collections available. <a href="{{ route('admin.collections.create') }}" class="text-blue-600 hover:text-blue-800">Create a collection first</a>
                    </p>
                @endif
            </div>

            <!-- Alt Text -->
            <div>
                <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">
                    Alt Text (for accessibility)
                </label>
                <input type="text" 
                       id="alt_text" 
                       name="alt_text" 
                       value="{{ old('alt_text') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alt_text') border-red-500 @enderror"
                       placeholder="Brief description for screen readers">
                @error('alt_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Helps visually impaired users understand the image content
                </p>
            </div>

            <!-- Featured -->
            <div>
                <div class="flex items-center">
                    <input id="is_featured" 
                           name="is_featured" 
                           type="checkbox" 
                           value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
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
                <a href="{{ route('admin.photos.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Photo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection