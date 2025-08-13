@extends('layouts.app')

@section('content')
<!-- Success Hero -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="py-20 text-center">
                <!-- Success Animation/Icon -->
                <div class="w-20 h-20 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 mb-6">
                    Welcome to the community!
                </h1>
                
                <p class="text-base text-zinc-600 dark:text-zinc-400 mb-12 max-w-2xl mx-auto">
                    Thank you {{ $member->name }} for joining our community! You're now part of a network of readers and thinkers who believe in the power of shared knowledge.
                </p>
                
                <!-- Book Reference -->
                <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm ring-1 ring-zinc-900/5 dark:ring-zinc-700/50 p-8 max-w-sm mx-auto">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-20 bg-zinc-100 dark:bg-zinc-700 rounded-xl flex-shrink-0 flex items-center justify-center">
                            <span class="text-2xl">📖</span>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-zinc-800 dark:text-zinc-100">{{ $book->title }}</h3>
                            <p class="text-zinc-600 dark:text-zinc-400">by {{ $book->author }}</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-teal-100 dark:bg-teal-900/20 text-teal-800 dark:text-teal-400">
                                    Registration Complete
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- What's Next -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="border-t border-zinc-100 dark:border-zinc-700/40 pt-16">
                <div class="text-center mb-16">
                    <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 mb-6">What happens next?</h2>
                    <p class="text-base text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                        You're now connected to a community of people who've been touched by the same stories. Here's how you can stay engaged:
                    </p>
                </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Community Connection -->
                <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl p-8">
                    <div class="w-12 h-12 bg-teal-600 dark:bg-teal-500 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M9 20H4v-2a3 3 0 015.196-2.121M15 10a3 3 0 11-6 0 3 3 0 016 0zm4 2v6m-2-4h4m-8-2V6a3 3 0 00-3-3H6a3 3 0 00-3 3v6a3 3 0 003 3h6a3 3 0 003-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100 mb-4">Stay connected</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-6">
                        Your registration helps us understand the impact of shared books and builds connections between readers.
                    </p>
                    <ul class="space-y-3 text-sm text-zinc-600 dark:text-zinc-400">
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                            You'll be part of our community statistics
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                            Your thoughts help other readers discover books
                        </li>
                    </ul>
                </div>
                
                <!-- Explore More -->
                <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl p-8">
                    <div class="w-12 h-12 bg-teal-600 dark:bg-teal-500 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100 mb-4">Discover more books</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-6">
                        Explore other books that have been shared with our community and see the amazing network we're building together.
                    </p>
                    <a href="{{ route('books') }}" class="inline-flex items-center text-teal-600 dark:text-teal-400 hover:text-teal-700 dark:hover:text-teal-300 font-medium">
                        Browse our books
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Member Details Summary -->
@if($member->message || $member->interests)
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Your Community Profile</h3>
            
            @if($member->message)
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Your thoughts on "{{ $book->title }}":</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 italic">"{{ $member->message }}"</p>
                    </div>
                </div>
            @endif
            
            @if($member->interests && count($member->interests) > 0)
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Your interests:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($member->interests as $interest)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $interest }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Registered on {{ $member->registered_at->format('F j, Y') }} at {{ $member->registered_at->format('g:i A') }}
                </p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Share the Journey -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Keep the Circle Going</h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Now that you're part of our community, consider sharing knowledge with others. 
            Every book you pass on creates new connections and spreads ideas that matter.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                🏠 Visit Our Home
            </a>
            <a href="{{ route('books') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-800 transition-colors">
                📚 Explore More Books
            </a>
        </div>
    </div>
</section>
@endsection