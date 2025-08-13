@extends('layouts.app')

@section('content')
<!-- Hero Section with Book Info -->
<section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center bg-white rounded-full px-4 py-2 shadow-sm mb-4">
                <span class="text-green-600 font-medium">✅ QR Code Verified</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to Our Community!</h1>
            <p class="text-xl text-gray-700">
                You've found a special book, and now you're invited to join an amazing network of readers and thinkers.
            </p>
        </div>
        
        <!-- Book Display -->
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto">
            <div class="text-center">
                <div class="h-32 w-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="h-28 w-auto object-cover rounded">
                    @else
                        <span class="text-3xl">📖</span>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $book->title }}</h2>
                <p class="text-gray-600 mb-1">by {{ $book->author }}</p>
                @if($book->description)
                    <p class="text-sm text-gray-500 mt-3">{{ Str::limit($book->description, 120) }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Join Our Community</h2>
                <p class="text-gray-600">
                    Share your thoughts about this book and connect with other readers who've been touched by the same stories.
                </p>
            </div>
            
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
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
            
            <form action="{{ route('community.register', $distribution->qr_code) }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Name *
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('name') border-red-300 @enderror"
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address *
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('email') border-red-300 @enderror"
                        placeholder="your.email@example.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone (Optional) -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number <span class="text-gray-400">(optional)</span>
                    </label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('phone') border-red-300 @enderror"
                        placeholder="+1 (555) 123-4567"
                    >
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- How Found -->
                <div>
                    <label for="how_found" class="block text-sm font-medium text-gray-700 mb-2">
                        How did you find this book? <span class="text-gray-400">(optional)</span>
                    </label>
                    <select 
                        id="how_found" 
                        name="how_found"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('how_found') border-red-300 @enderror"
                    >
                        <option value="">Choose an option...</option>
                        <option value="Friend recommendation" {{ old('how_found') == 'Friend recommendation' ? 'selected' : '' }}>Friend recommendation</option>
                        <option value="Found it in a café" {{ old('how_found') == 'Found it in a café' ? 'selected' : '' }}>Found it in a café</option>
                        <option value="Library book exchange" {{ old('how_found') == 'Library book exchange' ? 'selected' : '' }}>Library book exchange</option>
                        <option value="Gift from stranger" {{ old('how_found') == 'Gift from stranger' ? 'selected' : '' }}>Gift from stranger</option>
                        <option value="Found on park bench" {{ old('how_found') == 'Found on park bench' ? 'selected' : '' }}>Found on park bench</option>
                        <option value="Office book sharing" {{ old('how_found') == 'Office book sharing' ? 'selected' : '' }}>Office book sharing</option>
                        <option value="Community event" {{ old('how_found') == 'Community event' ? 'selected' : '' }}>Community event</option>
                        <option value="Random encounter" {{ old('how_found') == 'Random encounter' ? 'selected' : '' }}>Random encounter</option>
                        <option value="Other" {{ old('how_found') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('how_found')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Interests -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        What topics interest you? <span class="text-gray-400">(optional)</span>
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
                            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="interests[]" 
                                    value="{{ $interest }}"
                                    {{ in_array($interest, $oldInterests) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                >
                                <span class="ml-3 text-sm text-gray-700">{{ $interest }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('interests')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Share your thoughts about this book <span class="text-gray-400">(optional)</span>
                    </label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none @error('message') border-red-300 @enderror"
                        placeholder="What did you think of this book? How has it impacted you? Any insights you'd like to share with the community?"
                    >{{ old('message') }}</textarea>
                    <div class="mt-1 text-xs text-gray-500">
                        This helps other readers understand the book's impact and builds our community.
                    </div>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="pt-6">
                    <button 
                        type="submit"
                        class="w-full bg-blue-600 text-white py-4 px-6 rounded-lg font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200 transform hover:scale-[1.02]"
                    >
                        🎉 Join the Community
                    </button>
                    
                    <p class="text-center text-xs text-gray-500 mt-4">
                        By joining, you're helping build a community of curious minds and lifelong learners.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Community Preview -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">You're About to Join Something Special</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl">🤝</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Connect with Readers</h3>
                    <p class="text-sm text-gray-600">Share thoughts and insights with people who've read the same books</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl">💡</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Discover New Ideas</h3>
                    <p class="text-sm text-gray-600">Learn from different perspectives and expand your worldview</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl">📚</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Build Knowledge</h3>
                    <p class="text-sm text-gray-600">Be part of a growing library of shared wisdom and experiences</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection