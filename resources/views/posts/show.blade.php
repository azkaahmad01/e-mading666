@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-4xl mx-auto px-4 py-4">
        <!-- Breadcrumb -->
        <nav class="mb-3">
            <ol class="flex items-center text-sm text-gray-500 bg-white/60 backdrop-blur-sm rounded-full px-4 py-2 shadow-sm">
                <li><a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">🏠 Beranda</a></li>
                <li class="mx-2 text-gray-300">/</li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-blue-600 transition-colors">📰 Postingan</a></li>
                <li class="mx-2 text-gray-300">/</li>
                <li class="text-gray-700 font-medium">{{ Str::limit($post->title, 40) }}</li>
            </ol>
        </nav>

        <!-- Main Article Container -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/50">
            <!-- Article Header -->
            @if($post->featured_image)
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         class="w-full h-full object-cover" alt="{{ $post->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 text-white text-sm font-semibold rounded-full shadow-lg backdrop-blur-sm" 
                              style="background: linear-gradient(135deg, {{ $post->category->color }}, {{ $post->category->color }}cc)">
                            {{ $post->category->name }}
                        </span>
                    </div>
                    
                    <div class="absolute top-4 right-4">
                        <div class="flex items-center px-3 py-1 bg-black/50 backdrop-blur-sm text-white text-sm rounded-full">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            {{ number_format($post->view_count) }}
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Like Section -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @auth
                            <form id="likeForm" action="{{ route('posts.like', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="button" id="likeBtn" 
                                        data-post-id="{{ $post->id }}" 
                                        data-liked="{{ $isLiked ? 'true' : 'false' }}"
                                        class="flex items-center space-x-2 px-4 py-2 rounded-full transition-all duration-200 {{ $isLiked ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <svg class="w-5 h-5 {{ $isLiked ? 'fill-current' : '' }}" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span>{{ $isLiked ? 'Disukai' : 'Suka' }}</span>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-full">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>Suka</span>
                            </div>
                        @endauth
                        <span id="likesCount" class="text-sm text-gray-500">
                            <span class="font-semibold">{{ number_format($post->likesCount()) }}</span> suka
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Article Content -->
            <div class="p-6">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-3 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full flex items-center justify-center font-bold text-xs mr-2">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ ($post->published_at ?? $post->created_at)->format('d M Y, H:i') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ ceil(str_word_count($post->content) / 200) }} min read
                    </div>
                </div>

                <!-- Excerpt -->
                @if($post->excerpt)
                    <div class="text-lg text-gray-700 mb-4 p-4 bg-blue-50/50 rounded-xl border-l-4 border-blue-500 italic">
                        "{{ $post->excerpt }}"
                    </div>
                @endif
                
                <!-- Article Body -->
                <div class="prose max-w-none text-gray-800 leading-relaxed mb-6">
                    <div class="article-content">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <!-- Tags -->
                @if($post->tags->count() > 0)
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag) }}" 
                                   class="px-3 py-1 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 text-sm rounded-full hover:from-blue-200 hover:to-purple-200 transition-all">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share Section -->
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <h6 class="text-gray-700 font-semibold flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Bagikan artikel ini:
                        </h6>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-all">
                                📘 Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" 
                               target="_blank" class="px-3 py-1 bg-sky-500 text-white text-sm rounded-lg hover:bg-sky-600 transition-all">
                                🐦 Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->fullUrl()) }}" 
                               target="_blank" class="px-3 py-1 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition-all">
                                💬 WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="border-t border-gray-200 pt-4">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Komentar ({{ $post->comments->where('status', 'approved')->count() }})
                    </h4>
                    
                    @if($post->comments->where('status', 'approved')->count() > 0)
                        <div class="space-y-3 mb-6">
                            @foreach($post->comments->where('status', 'approved') as $comment)
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                                {{ substr($comment->user->name ?? 'G', 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <h6 class="font-semibold text-gray-800 text-sm">
                                                    {{ $comment->user ? $comment->user->name : $comment->guest_name }}
                                                </h6>
                                                <span class="text-xs text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 mb-6">
                            <div class="text-4xl mb-2">💭</div>
                            <p class="text-gray-500 text-sm mb-1">Belum ada komentar untuk postingan ini.</p>
                            <p class="text-gray-400 text-xs">Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endif

                    <!-- Add Comment Form -->
                    <div class="border-t border-gray-200 pt-4">
                        <h5 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Tambahkan Komentar
                        </h5>
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @auth
                            <form method="POST" action="{{ route('comments.store', $post) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <textarea name="content" rows="3" required
                                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 resize-none transition-all text-sm" 
                                              placeholder="Tulis komentar Anda di sini...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="text-red-500 text-xs mt-1 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg font-semibold flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Komentar
                                </button>
                            </form>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                                <div class="text-3xl mb-2">🔐</div>
                                <p class="text-blue-800 mb-3 text-sm font-medium">Silakan login untuk menambahkan komentar</p>
                                <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg font-semibold inline-flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login Sekarang
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Posts -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
            <div class="mt-4 bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/50">
                <div class="p-4">
                    <h5 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Postingan Terkait
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="group bg-gray-50 rounded-xl p-3 border border-gray-100 hover:shadow-md transition-all">
                                <div class="flex items-start space-x-3">
                                    @if($relatedPost->featured_image)
                                        <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                                             class="w-12 h-12 rounded-lg object-cover" alt="{{ $relatedPost->title }}">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h6 class="font-semibold text-gray-800 mb-1 group-hover:text-blue-600 transition-colors text-sm">
                                            <a href="{{ route('posts.show', $relatedPost) }}" class="hover:underline">
                                                {{ Str::limit($relatedPost->title, 40) }}
                                            </a>
                                        </h6>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ ($relatedPost->published_at ?? $relatedPost->created_at)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.article-content {
    font-size: 1rem;
    line-height: 1.7;
    color: #374151;
}

.article-content p {
    margin-bottom: 1rem;
}

.article-content h1, .article-content h2, .article-content h3, .article-content h4, .article-content h5, .article-content h6 {
    font-weight: 700;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1f2937;
}

.article-content h1 { font-size: 1.75rem; }
.article-content h2 { font-size: 1.5rem; }
.article-content h3 { font-size: 1.25rem; }
.article-content h4 { font-size: 1.125rem; }

.article-content ul, .article-content ol {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.article-content li {
    margin-bottom: 0.25rem;
}

.article-content blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background: #f8fafc;
    padding: 1rem;
    border-radius: 0.5rem;
}

.article-content code {
    background: #f1f5f9;
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
}

.article-content pre {
    background: #1e293b;
    color: #e2e8f0;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background: transparent;
    padding: 0;
    color: inherit;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.article-content a {
    color: #3b82f6;
    text-decoration: underline;
    font-weight: 500;
}

.article-content a:hover {
    color: #1d4ed8;
}

.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.article-content th, .article-content td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.article-content th {
    background: #f8fafc;
    font-weight: 600;
    color: #374151;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeBtn = document.getElementById('likeBtn');
    const likeForm = document.getElementById('likeForm');
    
    if (likeBtn && likeForm) {
        likeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Disable button
            this.disabled = true;
            this.style.opacity = '0.7';
            
            // Get form data
            const formData = new FormData(likeForm);
            
            fetch(likeForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Update button state
                    this.dataset.liked = data.liked ? 'true' : 'false';
                    
                    if (data.liked) {
                        this.className = 'flex items-center space-x-2 px-4 py-2 rounded-full transition-all duration-200 bg-red-100 text-red-600 hover:bg-red-200';
                        this.querySelector('svg').setAttribute('fill', 'currentColor');
                        this.querySelector('svg').classList.add('fill-current');
                        this.querySelector('span').textContent = 'Disukai';
                    } else {
                        this.className = 'flex items-center space-x-2 px-4 py-2 rounded-full transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-gray-200';
                        this.querySelector('svg').setAttribute('fill', 'none');
                        this.querySelector('svg').classList.remove('fill-current');
                        this.querySelector('span').textContent = 'Suka';
                    }
                    
                    // Update count
                    const count = document.getElementById('likesCount');
                    if (count) {
                        count.innerHTML = `<span class="font-semibold">${data.likes_count}</span> suka`;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memproses like. Silakan coba lagi.');
            })
            .finally(() => {
                // Re-enable button
                this.disabled = false;
                this.style.opacity = '1';
            });
        });
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add reading progress indicator
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        z-index: 9999;
        transition: width 0.3s ease;
    `;
    document.body.appendChild(progressBar);
    
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    });
    
    // Add copy functionality to code blocks
    document.querySelectorAll('pre code').forEach(codeBlock => {
        const button = document.createElement('button');
        button.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
        `;
        button.className = 'absolute top-3 right-3 p-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors';
        button.onclick = () => {
            navigator.clipboard.writeText(codeBlock.textContent);
            button.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            `;
            setTimeout(() => {
                button.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                `;
            }, 2000);
        };
        codeBlock.parentElement.style.position = 'relative';
        codeBlock.parentElement.appendChild(button);
    });
    
    // Add smooth transition styles for like count
    const likesCount = document.getElementById('likesCount');
    if (likesCount) {
        likesCount.style.transition = 'transform 0.2s ease';
    }
});
</script>
@endpush