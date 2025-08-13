@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="py-16 sm:py-20">
                <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                    Books creating connections
                </h1>
                <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                    These are the books that have found their way to wonderful people in our community. Each one carries a story, not just in its pages, but in the connections it creates. Every book shared is an invitation to join a larger conversation about growth, curiosity, and the power of shared knowledge.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Books Grid -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            @if($books->count() > 0)
                <div class="grid grid-cols-1 gap-16 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($books as $book)
                    <article class="group relative flex flex-col items-start">
                        <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-md shadow-zinc-800/5 ring-1 ring-zinc-900/5 dark:border dark:border-zinc-700/50 dark:bg-zinc-800 dark:ring-0">
                            @if($book->cover_image_url)
                                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="h-8 w-8 rounded object-cover">
                            @else
                                <span class="text-lg">📚</span>
                            @endif
                        </div>
                        <h2 class="mt-6 text-base font-semibold text-zinc-800 dark:text-zinc-100">
                            <div class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 dark:bg-zinc-800/50 sm:-inset-x-6 sm:rounded-2xl"></div>
                            <span class="relative z-10">{{ $book->title }}</span>
                        </h2>
                        <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">by {{ $book->author }}</p>
                        @if($book->description)
                            <p class="relative z-10 mt-6 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3">{{ $book->description }}</p>
                        @endif
                        <div class="relative z-10 mt-6 flex text-sm text-zinc-400 dark:text-zinc-500">
                            <span class="relative z-10 flex items-center text-sm text-zinc-400 dark:text-zinc-500">
                                {{ $book->distributions->count() }} {{ Str::plural('copy', $book->distributions->count()) }} shared
                                @if($book->distributions->where('status', 'registered')->count() > 0)
                                    • {{ $book->distributions->where('status', 'registered')->count() }} joined
                                @endif
                            </span>
                        </div>
                        @if($book->distributions->where('status', '!=', 'pending')->count() > 0)
                            <div class="relative z-10 mt-4 border-t border-zinc-100 pt-4 dark:border-zinc-700/40">
                                <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2">Recently shared:</p>
                                <div class="space-y-1">
                                    @foreach($book->distributions->where('status', '!=', 'pending')->sortByDesc('distribution_date')->take(2) as $distribution)
                                        <div class="text-xs text-zinc-400 dark:text-zinc-500 flex items-center">
                                            <span class="w-1.5 h-1.5 bg-teal-500 rounded-full mr-2"></span>
                                            {{ $distribution->distribution_location ?? 'Unknown location' }}
                                            @if($distribution->distribution_date)
                                                • {{ $distribution->distribution_date->format('M j') }}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($books->hasPages())
                    <div class="mt-16 border-t border-zinc-100 pt-16 dark:border-zinc-700/40">
                        {{ $books->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">📚</span>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100 mb-4">No books shared yet</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 max-w-md mx-auto">
                        Check back soon! I'm always adding new books to share with the community.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>



<!-- Community Impact Section -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="border-t border-zinc-100 pt-16 dark:border-zinc-700/40">
                <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl p-8 md:p-12">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 mb-6">
                            Found one of these books?
                        </h2>
                        <p class="text-base text-zinc-600 dark:text-zinc-400 mb-8 max-w-2xl mx-auto">
                            If you have one of these books with a QR code, you're holding more than just pages – you're holding an invitation to join a community of readers and thinkers.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-sm ring-1 ring-zinc-900/5 dark:ring-zinc-700/50">
                                <div class="text-2xl mb-3">📱</div>
                                <div class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Scan the QR code</div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">with your phone camera</div>
                            </div>

                            <div class="text-2xl text-zinc-400 rotate-90 sm:rotate-0 dark:text-zinc-500">→</div>

                            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-sm ring-1 ring-teal-600/10">
                                <div class="text-2xl mb-3">🤝</div>
                                <div class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Join our community</div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">and share your thoughts</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
