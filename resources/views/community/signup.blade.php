@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl lg:px-8">
        <div class="relative px-4 sm:px-8 lg:px-12">
            <div class="mx-auto max-w-2xl lg:max-w-5xl">
                <div class="py-16 sm:py-20">
                    <div class="text-center mb-12">
                        <div
                            class="inline-flex items-center bg-teal-50 dark:bg-teal-900/20 rounded-full px-4 py-2 ring-1 ring-teal-600/10 mb-6">
                            <span class="text-teal-600 dark:text-teal-400 font-medium text-sm">Join Our Community</span>
                        </div>
                        <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl mb-6">
                            Stories Are Meant to Travel
                        </h1>
                        <p class="text-base text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto leading-relaxed">
                            You're likely here because you received a book from me. Over the years, I've made it a personal mission to share books—sometimes with friends, sometimes with total strangers—simply because I believe that knowledge grows when it's shared. Each book that leaves my hands carries with it an invitation: to explore new ideas, challenge old assumptions, and connect with others on the same journey.
                        </p>
                        <p class="text-base text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto leading-relaxed mt-4">
                            This is more than just a book exchange—it's an invitation to join a community of curious minds who believe in the transformative power of shared wisdom. Together, we can create a space where ideas flourish, conversations deepen, and lifelong learning becomes a collective adventure.
                        </p>
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

                        <form action="{{ route('community.signup.store') }}" method="POST"
                              class="space-y-6">
                            @csrf

                            <div>
                                <label for="book_id"
                                       class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Select a Book *
                                </label>
                                <select
                                    id="book_id"
                                    name="book_id"
                                    required
                                    class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors @error('book_id') border-red-300 @enderror"
                                >
                                    <option value="">Select a book that you have received...</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} by {{ $book->author }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

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
@endsection
