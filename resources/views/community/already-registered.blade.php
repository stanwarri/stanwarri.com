@extends('layouts.app')

@section('content')
<!-- Already Registered Hero -->
<section class="bg-gradient-to-br from-yellow-50 to-orange-50 py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Info Icon -->
        <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            This Book is Already Registered
        </h1>
        
        <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
            Great news! Someone has already joined our community through this book. 
            Here's what we know about its journey so far.
        </p>
    </div>
</section>

<!-- Book and Member Info -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Book Card -->
            <div class="bg-gray-50 rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">The Book</h2>
                <div class="h-32 w-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    @if($distribution->book->cover_image_url)
                        <img src="{{ $distribution->book->cover_image_url }}" alt="{{ $distribution->book->title }}" class="h-28 w-auto object-cover rounded">
                    @else
                        <span class="text-3xl">📖</span>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $distribution->book->title }}</h3>
                <p class="text-gray-600 mb-4">by {{ $distribution->book->author }}</p>
                
                @if($distribution->distribution_location && $distribution->distribution_date)
                    <div class="bg-white rounded-lg p-4 mt-4">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Originally shared:</span><br>
                            {{ $distribution->distribution_location }}<br>
                            {{ $distribution->distribution_date->format('F j, Y') }}
                        </p>
                    </div>
                @endif
            </div>
            
            <!-- Member Card -->
            <div class="bg-blue-50 rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Community Member</h2>
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl text-white">👤</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $member->name }}</h3>
                <p class="text-gray-600 mb-4">
                    Joined on {{ $member->registered_at->format('F j, Y') }}
                </p>
                
                @if($member->how_found)
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">How they found it:</span><br>
                            {{ $member->how_found }}
                        </p>
                    </div>
                @endif
                
                @if($member->message)
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2 font-medium">Their thoughts:</p>
                        <p class="text-sm text-gray-700 italic">"{{ Str::limit($member->message, 150) }}"</p>
                    </div>
                @endif
                
                @if($member->interests && count($member->interests) > 0)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2 font-medium">Interests:</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            @foreach(array_slice($member->interests, 0, 3) as $interest)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $interest }}
                                </span>
                            @endforeach
                            @if(count($member->interests) > 3)
                                <span class="text-xs text-gray-500">+{{ count($member->interests) - 3 }} more</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Still Want to Join -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Still Want to Connect?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Even though this specific book is already registered, you can still be part of our amazing community of readers and thinkers.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Explore More Books</h3>
                    <p class="text-sm text-gray-600">
                        Browse other books in our community and see their impact
                    </p>
                </div>
                
                <div class="p-6">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M9 20H4v-2a3 3 0 015.196-2.121M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Learn Our Mission</h3>
                    <p class="text-sm text-gray-600">
                        Understand how we're building community through shared knowledge
                    </p>
                </div>
                
                <div class="p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Share the Love</h3>
                    <p class="text-sm text-gray-600">
                        Pass on knowledge to others and keep the circle growing
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('books') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    📚 Explore Our Books
                </a>
                <a href="{{ route('home') }}" class="bg-white text-blue-600 border border-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                    🏠 Learn More About Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Community Impact -->
<section class="py-16 bg-white border-t">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">You're Part of Something Amazing</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                By finding this book, you've discovered a network of people who believe in the power of shared knowledge. 
                Even though this specific QR code is already used, you're still connected to our mission.
            </p>
            
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-8">
                <div class="text-4xl mb-4">🌟</div>
                <p class="text-gray-700 font-medium">
                    "Every book that finds its way to the right person at the right time creates ripples of positive change."
                </p>
                <p class="text-sm text-gray-500 mt-2">- Stanley, Community Builder</p>
            </div>
        </div>
    </div>
</section>
@endsection