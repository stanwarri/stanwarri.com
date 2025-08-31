@extends('layouts.app')

@section('content')
    <!-- Hero Section with Book Info -->
    <div class="mx-auto max-w-7xl lg:px-8">
        <div class="relative px-4 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                <div class="py-16 sm:py-20">
                    <div class="text-center mb-12">
                        <div
                            class="inline-flex items-center bg-teal-50 dark:bg-teal-900/20 rounded-full px-4 py-2 ring-1 ring-teal-600/10 mb-6">
                            <span class="text-teal-600 dark:text-teal-400 font-medium text-sm">✅ QR Code Verified</span>
                        </div>
                        <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl mb-6">
                            Welcome to our community
                        </h1>
                        <p class="text-base text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                            You've found a special book, and now you're invited to join a network of readers and
                            thinkers who believe in the power of shared knowledge.
                        </p>
                    </div>

                    <!-- Book Display -->
                    <div
                        class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm ring-1 ring-zinc-900/5 dark:ring-zinc-700/50 p-8 max-w-md mx-auto">
                        <div class="text-center">
                            <div
                                class="h-32 w-24 bg-zinc-100 dark:bg-zinc-700 rounded-xl mx-auto mb-6 flex items-center justify-center overflow-hidden">
                                @if($book->cover_image_url)
                                    <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}"
                                         class="h-full w-full object-cover rounded-xl">
                                    <div class="hidden h-full w-full items-center justify-center">
                                        <span class="text-3xl">📖</span>
                                    </div>
                                @else
                                    <span class="text-3xl">📖</span>
                                @endif
                            </div>
                            <h2 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100 mb-2">{{ $book->title }}</h2>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-1">by {{ $book->author }}</p>
                            @if($book->description)
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-4">{{ Str::limit($book->description, 120) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="mx-auto max-w-7xl lg:px-8">
        <div class="relative px-4 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                <div class="border-t border-zinc-100 dark:border-zinc-700/40">
                    <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl p-8 lg:p-12">
                        @if($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Please fix the following
                                            errors:</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc pl-5 space-y-1">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('community.register', $distribution->qr_code) }}" method="POST"
                              class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label for="name"
                                       class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Your Name *
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors @error('name') border-red-300 @enderror"
                                    placeholder="Enter your full name"
                                >
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                       class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Email Address *
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors @error('email') border-red-300 @enderror"
                                    placeholder="your.email@example.com"
                                >
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone (Optional) -->
                            <div>
                                <label for="phone"
                                       class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Phone Number <span class="text-zinc-400 dark:text-zinc-500">(optional)</span>
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors @error('phone') border-red-300 @enderror"
                                    placeholder="+1 (555) 123-4567"
                                >
                                @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Interests -->
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-3">
                                    What topics interest you? <span
                                        class="text-zinc-400 dark:text-zinc-500">(optional)</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    @php
                                        $interests = [
                                            'Self-improvement',
                                            'Business & Entrepreneurship',
                                            'Psychology & Philosophy',
                                            'Technology & Innovation',
                                            'Literature & Fiction',
                                            'Health & Wellness',
                                            'History & Politics',
                                            'Science & Nature',
                                            'Travel & Culture',
                                            'Arts & Creativity'
                                        ];
                                        $oldInterests = old('interests', []);
                                    @endphp

                                    @foreach($interests as $interest)
                                        <label
                                            class="flex items-center p-3 bg-zinc-100 dark:bg-zinc-700 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-600 transition-colors cursor-pointer">
                                            <input
                                                type="checkbox"
                                                name="interests[]"
                                                value="{{ $interest }}"
                                                {{ in_array($interest, $oldInterests) ? 'checked' : '' }}
                                                class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-zinc-300 dark:border-zinc-600 rounded"
                                            >
                                            <span
                                                class="ml-3 text-sm text-zinc-700 dark:text-zinc-300">{{ $interest }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('interests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button
                                    type="submit"
                                    class="w-full bg-teal-600 text-white py-4 px-6 rounded-lg font-medium hover:bg-teal-700 focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-800 transition-all duration-200"
                                >
                                    Join the Community
                                </button>

                                <p class="text-center text-xs text-zinc-500 dark:text-zinc-400 mt-4">
                                    By joining, you're helping build a community of curious minds and lifelong learners.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Preview -->
    <div class="mx-auto max-w-7xl lg:px-8">
        <div class="relative px-4 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                <div class="border-t border-zinc-100 dark:border-zinc-700/40 pt-16">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 mb-6">You're about
                            to join something special</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <span class="text-xl">🤝</span>
                                </div>
                                <h3 class="font-semibold text-zinc-800 dark:text-zinc-100 mb-3">Connect with
                                    readers</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Share thoughts and insights with
                                    people who've read the same books</p>
                            </div>

                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <span class="text-xl">💡</span>
                                </div>
                                <h3 class="font-semibold text-zinc-800 dark:text-zinc-100 mb-3">Discover new ideas</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Learn from different perspectives
                                    and expand your worldview</p>
                            </div>

                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <span class="text-xl">📚</span>
                                </div>
                                <h3 class="font-semibold text-zinc-800 dark:text-zinc-100 mb-3">Build knowledge</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Be part of a growing library of
                                    shared wisdom and experiences</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
