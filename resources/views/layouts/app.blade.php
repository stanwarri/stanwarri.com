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
        <!-- Sidebar/Navigation -->
        <div class="hidden lg:flex lg:w-72 lg:flex-col lg:fixed lg:inset-y-0">
            <div class="flex flex-col flex-grow bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800">
                <div class="px-6 py-8">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Stanley Ojadovwa">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-zinc-900 dark:text-white">Stanley Ojadovwa</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Community Builder</p>
                        </div>
                    </div>
                </div>
                
                <nav class="flex-1 px-6">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white' : 'text-zinc-700 hover:text-zinc-900 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-zinc-800' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors">
                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                About
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('books') }}" class="{{ request()->routeIs('books') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white' : 'text-zinc-700 hover:text-zinc-900 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:text-white dark:hover:bg-zinc-800' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors">
                                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Books
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Social Links -->
                <div class="px-6 py-6">
                    <div class="flex space-x-4">
                        <a href="#" class="text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="mailto:stanley.warri@gmail.com" class="text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300">
                            <span class="sr-only">Email</span>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button type="button" class="bg-zinc-100 dark:bg-zinc-800 rounded-md p-2 inline-flex items-center justify-center text-zinc-400 hover:text-zinc-500 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Main content -->
        <div class="lg:pl-72 flex flex-col w-0 flex-1">
            <main class="flex-1">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="border-t border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center justify-between space-y-4 sm:flex-row sm:space-y-0">
                        <div class="flex space-x-6 text-sm text-zinc-600 dark:text-zinc-400">
                            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-white transition-colors">About</a>
                            <a href="{{ route('books') }}" class="hover:text-zinc-900 dark:hover:text-white transition-colors">Books</a>
                        </div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            © {{ date('Y') }} Stanley Ojadovwa. Building community through shared knowledge.
                        </p>
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