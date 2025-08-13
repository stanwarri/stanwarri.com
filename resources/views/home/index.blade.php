@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Building Community
                <span class="text-blue-600">One Book at a Time</span>
            </h1>
            <p class="text-xl text-gray-700 mb-8 max-w-3xl mx-auto">
                Hi, I'm Stanley! I love sharing knowledge and connecting with people through books. 
                Every book I give away carries a QR code that leads to this community. 
                Welcome to a network of curious minds and lifelong learners.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('books') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    📚 View Books I've Shared
                </a>
                <div class="text-gray-600">
                    or scan a QR code from one of my books
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['books_given'] }}</div>
                <div class="text-gray-600 font-medium">Books Shared</div>
                <div class="text-sm text-gray-500 mt-1">Making knowledge accessible to everyone</div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $stats['community_members'] }}</div>
                <div class="text-gray-600 font-medium">Community Members</div>
                <div class="text-sm text-gray-500 mt-1">Amazing people who joined our network</div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-purple-600 mb-2">{{ $stats['books_available'] }}</div>
                <div class="text-gray-600 font-medium">Books in Circulation</div>
                <div class="text-sm text-gray-500 mt-1">Total inventory making impact</div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Books Section -->
@if($recentBooks->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Recently Shared Books</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                These are some of the amazing books I've had the pleasure of sharing with wonderful people in our community.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentBooks as $book)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                    @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="h-40 w-auto object-cover rounded">
                    @else
                        <div class="text-4xl">📖</div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 mb-3">by {{ $book->author }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                            {{ $book->distributions->count() }} {{ Str::plural('copy', $book->distributions->count()) }} shared
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('books') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                View all books →
            </a>
        </div>
    </div>
</section>
@endif

<!-- How It Works Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">How It Works</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                It's simple! Here's how you can be part of this amazing community of book lovers.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📚</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Find a Book</h3>
                <p class="text-gray-600">
                    You might find one of my books in a coffee shop, library, or receive it as a gift from someone special.
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📱</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Scan the QR Code</h3>
                <p class="text-gray-600">
                    Each book has a unique QR code sticker. Scan it with your phone camera to join our community.
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🤝</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Join the Community</h3>
                <p class="text-gray-600">
                    Share your thoughts about the book and connect with other readers who've been touched by the same stories.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-4">Ready to Explore?</h2>
        <p class="text-xl mb-8 opacity-90">
            Browse through the books I've shared and see the amazing community we're building together.
        </p>
        <a href="{{ route('books') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors">
            Discover Our Books
        </a>
    </div>
</section>
@endsection