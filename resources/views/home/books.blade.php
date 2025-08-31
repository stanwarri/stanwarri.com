@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="py-16 sm:py-20">
                <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                    Stories That Bring Us Together
                </h1>
                <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
                    Over the years, I’ve made it a personal mission to share books — sometimes with friends, sometimes with total strangers — simply because I believe stories are meant to travel. These are the books that have found their way into the hands of wonderful people. Each one carries more than the words on its pages; it builds connections. Every copy passed on becomes an invitation to step into a larger conversation about growth, curiosity, and the incredible power of shared knowledge.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Books Grid -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl">
            @if($books->count() > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($books as $book)
                    <div class="group relative bg-white dark:bg-zinc-800 rounded-2xl shadow-sm ring-1 ring-zinc-900/5 dark:ring-zinc-700/50 overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] cursor-pointer"
                         onclick="openBookModal({{ $loop->index }})">
                        <!-- Book Cover -->
                        <div class="aspect-[3/4] bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800 relative overflow-hidden">
                            @if($book->cover_image_url)
                                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-4xl mb-2">📚</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400 px-4 leading-tight">{{ Str::limit($book->title, 30) }}</div>
                                    </div>
                                </div>
                            @endif
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Book Information -->
                        <div class="p-6">
                            <h3 class="font-semibold text-zinc-800 dark:text-zinc-100 text-lg leading-tight mb-2 line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                                by {{ $book->author }}
                            </p>
                            @if($book->excerpt)
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3 leading-relaxed">
                                    {{ $book->excerpt }}
                                </p>
                            @elseif($book->description)
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3 leading-relaxed">
                                    {{ Str::limit($book->description, 150) }}
                                </p>
                            @endif
                        </div>

                        <!-- Hover Effect -->
                        <div class="absolute inset-0 rounded-2xl ring-2 ring-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
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
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-gradient-to-br from-teal-50 to-teal-100 dark:from-teal-900/20 dark:to-teal-800/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">📚</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100 mb-4">No books shared yet</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 max-w-md mx-auto text-lg">
                        Check back soon! I'm always adding new books to share with the community.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Animated Counter Section -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="py-8 text-center">
                <div class="bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 rounded-3xl p-8 shadow-sm ring-1 ring-teal-100 dark:ring-teal-800/50">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-2xl mb-6 shadow-lg">
                            <span class="text-2xl text-white">📚</span>
                        </div>
                        <p class="text-sm font-medium text-teal-700 dark:text-teal-300 mb-2 uppercase tracking-wide">
                            Total Books Shared
                        </p>
                        <div class="text-6xl font-bold text-teal-900 dark:text-teal-100 mb-4">
                            {{ $booksGivenOutCount }}
                        </div>
                        <p class="text-base text-teal-700/80 dark:text-teal-300/80 max-w-md">
                            Stories spreading across our community, one reader at a time
                        </p>
                    </div>
                </div>
            </div>
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

<!-- Book Modal -->
<div id="bookModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeBookModal()"></div>

        <!-- Modal content -->
        <div class="relative bg-white dark:bg-zinc-800 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
            <div class="p-8">
                <!-- Close button -->
                <button onclick="closeBookModal()" class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 text-2xl">
                    ×
                </button>

                <!-- Modal content will be populated by JavaScript -->
                <div id="modalContent">
                    <!-- Content will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Books data for JavaScript
    const books = @json($books->items());

    function openBookModal(bookIndex) {
        const book = books[bookIndex];
        const modal = document.getElementById('bookModal');
        const modalContent = document.getElementById('modalContent');

        // Build modal content
        let content = `
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3 flex-shrink-0">
                    ${book.cover_image_url
                        ? `<img src="${book.cover_image_url}" alt="${book.title}" class="w-full aspect-[3/4] object-cover rounded-lg">`
                        : `<div class="w-full aspect-[3/4] bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800 rounded-lg flex items-center justify-center">
                             <div class="text-center">
                                 <div class="text-4xl mb-2">📚</div>
                                 <div class="text-xs text-zinc-500 dark:text-zinc-400 px-4">${book.title}</div>
                             </div>
                           </div>`
                    }
                </div>
                <div class="md:w-2/3">
                    <h2 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100 mb-2">${book.title}</h2>
                    <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-6">by ${book.author}</p>

                    ${book.description ? `
                        <div>
                            <h3 class="font-semibold text-zinc-800 dark:text-zinc-100 mb-2">Description</h3>
                            <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed">${book.description}</p>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;

        modalContent.innerHTML = content;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeBookModal() {
        const modal = document.getElementById('bookModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeBookModal();
        }
    });
</script>

@endsection

