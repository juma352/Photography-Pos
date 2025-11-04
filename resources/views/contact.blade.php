@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-16 px-6">
    <h2 class="font-artistic-heading text-4xl font-bold mb-6 text-center text-gradient underline-artistic">Contact Me</h2>
    <p class="font-artistic-script text-xl text-center text-gray-600 mb-8">Let's capture your special moments together</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6 font-artistic-body">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-artistic-sub font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="font-artistic-body w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
            @error('name') <p class="font-artistic-body text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-artistic-sub font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="font-artistic-body w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">
            @error('email') <p class="font-artistic-body text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-artistic-sub font-medium">Message</label>
            <textarea name="message" rows="5" 
                      class="font-artistic-body w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200">{{ old('message') }}</textarea>
            @error('message') <p class="font-artistic-body text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="font-artistic-sub bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
            Send Message
        </button>
    </form>

    <div class="text-center mt-8">
        <p class="font-artistic-script text-lg text-gray-600">Follow me:</p>
        <div class="space-x-4 mt-2">
            <a href="#" class="font-artistic-body text-blue-500 hover:text-purple-600 transition-colors duration-300">Instagram</a>
            <a href="#" class="font-artistic-body text-blue-500 hover:text-purple-600 transition-colors duration-300">Facebook</a>
        </div>
    </div>
</div>
@endsection
