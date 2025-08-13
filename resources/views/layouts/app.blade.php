<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Stanley\'s Community' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                        📚 Stanley's Community
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('books') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('books') ? 'text-blue-600' : '' }}">
                        Books
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-600">
                    Building community one book at a time 📖
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    Found a book with a QR code? Scan it to join our community!
                </p>
            </div>
        </div>
    </footer>

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