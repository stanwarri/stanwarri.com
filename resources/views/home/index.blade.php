@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl lg:max-w-5xl">
    <div class="max-w-2xl">
        <!-- Hero Section -->
        <div class="px-6 py-16 sm:px-8 sm:py-24 lg:px-12">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                I'm Stanley Ojadovwa, a community builder who believes in the power of shared knowledge.
            </h1>
            <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                I have a simple mission: to create connections between people through books. Every book I share carries a QR code that leads curious minds to this community. It's my way of turning individual reading moments into collective wisdom.
            </p>
            <div class="mt-6 flex gap-6">
                <a href="#" class="group -m-1 p-1">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                        <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                <a href="#" class="group -m-1 p-1">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                        <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="group -m-1 p-1">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="mailto:stanley.warri@gmail.com" class="group -m-1 p-1">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                        <path fill-rule="evenodd" d="M6 5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H6Zm.245 2.187a.75.75 0 0 0-.99 1.126l6.25 5.5a.75.75 0 0 0 .99 0l6.25-5.5a.75.75 0 0 0-.99-1.126L12 12.251 6.245 7.187Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:grid-rows-[auto_1fr] lg:gap-y-12">
                <!-- Portrait -->
                <div class="lg:pl-20">
                    <div class="max-w-xs px-2.5 lg:max-w-none">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.5&w=512&h=512&q=80" alt="Stanley Ojadovwa" sizes="(min-width: 1024px) 32rem, 20rem" class="aspect-square rotate-3 rounded-2xl bg-zinc-100 object-cover dark:bg-zinc-800">
                    </div>
                </div>
                
                <!-- Content -->
                <div class="lg:order-first lg:row-span-2">
                    <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                        Building community through shared stories and ideas.
                    </h1>
                    
                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-100 dark:border-zinc-700 p-6">
                            <dt class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Books Shared</dt>
                            <dd class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $stats['books_given'] }}</dd>
                        </div>
                        <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-100 dark:border-zinc-700 p-6">
                            <dt class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Community Members</dt>
                            <dd class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $stats['community_members'] }}</dd>
                        </div>
                        <div class="bg-white dark:bg-zinc-800 rounded-2xl border border-zinc-100 dark:border-zinc-700 p-6">
                            <dt class="text-sm font-medium text-zinc-600 dark:text-zinc-400">In Circulation</dt>
                            <dd class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $stats['books_available'] }}</dd>
                        </div>
                    </div>

                    <!-- Story Content -->
                    <div class="mt-12 space-y-7 text-base text-zinc-600 dark:text-zinc-400">
                        <p>
                            I've always believed that the best conversations happen around books. There's something magical about discovering that a stranger has been moved by the same words that touched you. So I started an experiment: what if books could create their own communities?
                        </p>
                        <p>
                            Every book I share gets a unique QR code. When someone scans it, they're not just joining a mailing list—they're becoming part of a story. They can share what the book meant to them, see how it impacted others, and connect with people who've traveled similar intellectual journeys.
                        </p>
                        <p>
                            The magic isn't in the technology; it's in the human connections that emerge. I've seen strangers become friends over shared book recommendations, watched reading groups form organically, and witnessed how one person's insight can completely change another's perspective on a story.
                        </p>
                        <p>
                            This community grows one conversation at a time. Every QR code scan, every shared thought, every "this book changed my life" moment adds another thread to our collective story. We're not just readers—we're co-authors of a larger narrative about curiosity, growth, and the power of shared knowledge.
                        </p>
                        <p>
                            Found a book with my QR code? You're already part of this story. Welcome to a community where every page turned is a connection made, and every book shared is an invitation to grow together.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Books Section -->
@if($recentBooks->count() > 0)
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="border-t border-zinc-100 pt-16 dark:border-zinc-700">
                <h2 class="text-2xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100">
                    Books currently building connections
                </h2>
                <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                    These books are out there right now, in coffee shops and libraries, waiting to spark conversations and create new friendships.
                </p>
                
                <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recentBooks->take(6) as $book)
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
                        <p class="relative z-10 mt-6 flex text-sm text-zinc-400 dark:text-zinc-500">
                            <span class="relative z-10 flex items-center text-sm text-zinc-400 dark:text-zinc-500">
                                {{ $book->distributions->count() }} {{ Str::plural('copy', $book->distributions->count()) }} shared
                                @if($book->distributions->where('status', 'registered')->count() > 0)
                                    • {{ $book->distributions->where('status', 'registered')->count() }} joined
                                @endif
                            </span>
                        </p>
                    </article>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    <a href="{{ route('books') }}" class="text-base font-medium text-teal-500 hover:text-teal-600 dark:text-teal-400 dark:hover:text-teal-300">
                        View all books <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection