<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Stanley Ojadovwa - Community Builder' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-full bg-zinc-50 dark:bg-black">
    <div class="flex w-full">
        <div class="flex w-full flex-col">
            <!-- Header -->
            <header class="pointer-events-none relative z-50 flex flex-none flex-col" style="height:var(--header-height);margin-bottom:var(--header-mb)">
                <div class="top-0 z-10 h-16 pt-6">
                    <div class="sm:px-8 top-[var(--header-top,theme(spacing.6))] w-full">
                        <div class="mx-auto w-full max-w-7xl lg:px-8">
                            <div class="relative px-4 sm:px-8 lg:px-12">
                                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                                    <div class="relative flex gap-4">
                                        <div class="flex flex-1">
                                            <div class="h-10 w-10 rounded-full bg-white/90 p-0.5 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:ring-white/10">
                                                <a aria-label="Home" class="pointer-events-auto" href="{{ route('home') }}">
                                                    <img alt="" sizes="2.25rem" src="{{ asset('image/profile.png') }}" class="rounded-full bg-zinc-100 object-cover dark:bg-zinc-800 h-9 w-9">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 justify-end md:justify-center">
                                            <div class="pointer-events-auto md:hidden">
                                                <button id="mobile-menu-button" class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10 dark:hover:ring-white/20" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle navigation menu">
                                                    Menu
                                                    <svg id="menu-icon-closed" viewBox="0 0 8 6" aria-hidden="true" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400 transition-transform">
                                                        <path d="m1.5 1 3 3 3-3" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <svg id="menu-icon-open" viewBox="0 0 8 6" aria-hidden="true" class="ml-3 h-auto w-2 stroke-zinc-500 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-400 transition-transform rotate-180 hidden">
                                                        <path d="m1.5 1 3 3 3-3" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <!-- Mobile Navigation Menu -->
                                                <div id="mobile-menu" class="absolute top-16 left-4 right-4 hidden">
                                                    <nav class="rounded-xl bg-white/90 px-4 py-4 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                                                        <ul class="space-y-2">
                                                            <li>
                                                                <a class="block px-3 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'text-teal-500 dark:text-teal-400 bg-teal-50 dark:bg-teal-900/20' : 'hover:text-teal-500 dark:hover:text-teal-400 hover:bg-zinc-100 dark:hover:bg-zinc-700' }}" href="{{ route('home') }}">
                                                                    About
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="block px-3 py-2 rounded-lg transition {{ request()->routeIs('books') ? 'text-teal-500 dark:text-teal-400 bg-teal-50 dark:bg-teal-900/20' : 'hover:text-teal-500 dark:hover:text-teal-400 hover:bg-zinc-100 dark:hover:bg-zinc-700' }}" href="{{ route('books') }}">
                                                                    Books
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                            <nav class="pointer-events-auto hidden md:block">
                                                <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                                                    <li>
                                                        <a class="relative block px-3 py-2 transition {{ request()->routeIs('home') ? 'text-teal-500 dark:text-teal-400' : 'hover:text-teal-500 dark:hover:text-teal-400' }}" href="{{ route('home') }}">
                                                            About
                                                            @if(request()->routeIs('home'))
                                                                <span class="absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-teal-500/0 via-teal-500/40 to-teal-500/0 dark:from-teal-400/0 dark:via-teal-400/40 dark:to-teal-400/0"></span>
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="relative block px-3 py-2 transition {{ request()->routeIs('books') ? 'text-teal-500 dark:text-teal-400' : 'hover:text-teal-500 dark:hover:text-teal-400' }}" href="{{ route('books') }}">
                                                            Books
                                                            @if(request()->routeIs('books'))
                                                                <span class="absolute inset-x-1 -bottom-px h-px bg-gradient-to-r from-teal-500/0 via-teal-500/40 to-teal-500/0 dark:from-teal-400/0 dark:via-teal-400/40 dark:to-teal-400/0"></span>
                                                            @endif
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="flex justify-end md:flex-1">
                                            <div class="pointer-events-auto">
                                                <button id="theme-toggle" type="button" aria-label="Switch theme" class="group rounded-full bg-white/90 px-3 py-2 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur transition dark:bg-zinc-800/90 dark:ring-white/10 dark:hover:ring-white/20">
                                                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-6 w-6 fill-zinc-100 stroke-zinc-500 transition group-hover:fill-zinc-200 group-hover:stroke-zinc-700 dark:hidden [@media(prefers-color-scheme:dark)]:fill-teal-50 [@media(prefers-color-scheme:dark)]:stroke-teal-500 [@media(prefers-color-scheme:dark)]:group-hover:fill-teal-50 [@media(prefers-color-scheme:dark)]:group-hover:stroke-teal-600">
                                                        <path d="M8 12.25A4.25 4.25 0 0 1 12.25 8v0a4.25 4.25 0 0 1 4.25 4.25 4.25 4.25 0 0 1-4.25 4.25v0A4.25 4.25 0 0 1 8 12.25v0Z"></path>
                                                        <path d="M12.25 3v1.5M21.5 12.25H20M18.791 5.709l-1.06 1.06M18.791 18.791l-1.06-1.06M12.25 20v1.5M4.5 12.25H3M6.77 6.77 5.709 5.709M6.77 17.73l-1.061 1.061"></path>
                                                    </svg>
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="hidden h-6 w-6 fill-zinc-700 stroke-zinc-500 transition dark:block [@media(prefers-color-scheme:dark)]:group-hover:stroke-zinc-400 [@media_not_(prefers-color-scheme:dark)]:fill-teal-400/10 [@media_not_(prefers-color-scheme:dark)]:stroke-teal-500">
                                                        <path d="M17.25 16.22a6.937 6.937 0 0 1-9.47-9.47 7.451 7.451 0 1 0 9.47 9.47ZM12.75 7C17 7 17 2.75 17 2.75S17 7 21.25 7C17 7 17 11.25 17 11.25S17 7 12.75 7Z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="mt-32 flex-none">
                <div class="sm:px-8">
                    <div class="mx-auto w-full max-w-7xl lg:px-8">
                        <div class="border-t border-zinc-100 pb-16 pt-10 dark:border-zinc-700/40">
                            <div class="relative px-4 sm:px-8 lg:px-12">
                                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                                    <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                                        <div class="flex flex-wrap justify-center gap-x-6 gap-y-1 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                                            <a class="transition hover:text-teal-500 dark:hover:text-teal-400" href="{{ route('home') }}">About</a>
                                            <a class="transition hover:text-teal-500 dark:hover:text-teal-400" href="{{ route('books') }}">Books</a>
                                        </div>
                                        <p class="text-sm text-zinc-400 dark:text-zinc-500">© {{ date('Y') }} Stanley Ojadovwa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @if(session('success'))
        <div id="flash-message" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('flash-message').style.display = 'none';
            }, 5000);
        </script>
    @endif

    @if(session('error'))
        <div id="flash-error" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('flash-error').style.display = 'none';
            }, 5000);
        </script>
    @endif
</body>
</html>
