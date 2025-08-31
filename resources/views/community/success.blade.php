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
                    Thank you {{ $member->name }} for joining our community! You're now part of a network of readers and thinkers who believe in the power of shared knowledge. We will be in touch for next meetup or hangout!!!
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
@endsection
