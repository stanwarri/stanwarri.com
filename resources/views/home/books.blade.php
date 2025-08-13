@extends('layouts.app')

@section('content')
<!-- Page Header -->
<section class="bg-white py-16 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">📚 Books I've Shared</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                These are the amazing books that have found their way to wonderful people in our community. 
                Each one carries a story, not just in its pages, but in the connections it creates.
            </p>
        </div>
    </div>
</section>

<!-- Books Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Book Cover -->
                    <div class="h-64 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center relative overflow-hidden">
                        @if($book->cover_image_url)
                            <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="h-56 w-auto object-cover rounded shadow-md">
                        @else
                            <div class="text-6xl opacity-60">📖</div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3 bg-white rounded-full px-3 py-1 text-xs font-medium text-blue-600 shadow-sm">
                            {{ $book->distributions->count() }} shared
                        </div>
                    </div>
                    
                    <!-- Book Info -->
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 mb-3 font-medium">by {{ $book->author }}</p>
                        
                        @if($book->description)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-3">{{ $book->description }}</p>
                        @endif
                        
                        <!-- Book Stats -->
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $book->distributions->where('status', 'registered')->count() }} joined
                                </span>
                                
                                <span class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $book->distributions->where('status', 'distributed')->count() }} out there
                                </span>
                            </div>
                        </div>
                        
                        <!-- Distribution History -->
                        @if($book->distributions->where('status', '!=', 'pending')->count() > 0)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400 mb-2">Recently shared:</p>
                                <div class="space-y-1">
                                    @foreach($book->distributions->where('status', '!=', 'pending')->sortByDesc('distribution_date')->take(2) as $distribution)
                                        <div class="text-xs text-gray-500 flex items-center">
                                            <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                            {{ $distribution->distribution_location ?? 'Unknown location' }}
                                            @if($distribution->distribution_date)
                                                • {{ $distribution->distribution_date->format('M j') }}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $books->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📚</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Books Shared Yet</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Check back soon! I'm always adding new books to share with the community.
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Community Impact Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 md:p-12">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Found One of These Books?</h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    If you have one of these books with a QR code, you're holding more than just pages – 
                    you're holding an invitation to join an amazing community of readers and thinkers.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <div class="bg-white rounded-lg p-4 shadow-sm border-2 border-dashed border-gray-300">
                        <div class="text-2xl mb-2">📱</div>
                        <div class="text-sm font-medium text-gray-700">Scan the QR code</div>
                        <div class="text-xs text-gray-500">with your phone camera</div>
                    </div>
                    
                    <div class="text-2xl text-gray-400 rotate-90 sm:rotate-0">→</div>
                    
                    <div class="bg-white rounded-lg p-4 shadow-sm border-2 border-blue-200">
                        <div class="text-2xl mb-2">🤝</div>
                        <div class="text-sm font-medium text-gray-700">Join our community</div>
                        <div class="text-xs text-gray-500">and share your thoughts</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection