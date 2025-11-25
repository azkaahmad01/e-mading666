@extends('layouts.app')

@section('content')
<div class="min-h-screen">
<!-- Hero Section -->
    <section class="min-h-screen h-screen bg-cover bg-center bg-no-repeat text-white relative overflow-hidden flex items-center" style="background-image: url('{{ asset('storage/posts/bn.jpg') }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/20"></div>
        <div class="w-full py-8 sm:py-16 md:py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center relative z-10">
                <div class="mb-6 sm:mb-8">
                    <img src="{{ asset('storage/posts/bnn.png') }}" alt="Logo SMK Bakti Nusantara 666" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mx-auto object-contain drop-shadow-2xl">
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-8 sm:mb-12 text-white leading-relaxed pb-2 sm:pb-4 welcome-title">
                    Selamat Datang di E-Mading Digital
                </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-8 sm:mb-10 text-gray-300 max-w-xs sm:max-w-2xl md:max-w-3xl mx-auto leading-relaxed px-2 welcome-text">Website e-mading digital memudahkan siswa dalam mengakses informasi dengan mudah</p>
            </div>
        </div>
    </section>

    <!-- Postingan Section -->
    <section id="postingan" class="min-h-screen py-12 sm:py-16 md:py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    @if(request()->has('search'))
                        Hasil Pencarian
                    @else
                        Semua Postingan
                    @endif
                </h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                    @if(request()->has('search'))
                        Menampilkan hasil pencarian untuk "{{ request('search') }}"
                    @else
                        Temukan semua postingan terbaru dari berbagai kategori
                    @endif
                </p>
            </div>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto mb-8">
                <form action="{{ route('home') }}#postingan" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="flex items-center bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg focus-within:ring-4 focus-within:ring-blue-500/20 focus-within:bg-white transition-all duration-300">
                        <div class="pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" class="flex-1 px-4 py-4 bg-transparent border-0 focus:outline-none text-gray-900 placeholder-gray-500" 
                            placeholder="Cari postingan..." 
                            value="{{ request('search') }}">
                        <button class="px-6 py-2 mx-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300" type="submit">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
           <!-- Filter Categories -->
            <div class="mb-12">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('home') }}#postingan" 
                    class="group px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 transform hover:scale-105 {{ !request('category') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-white hover:shadow-lg' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Semua Kategori
                        </span>
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('posts.category', $category->slug) }}" 
                        class="group px-6 py-3 rounded-2xl text-sm font-semibold flex items-center transition-all duration-300 transform hover:scale-105 hover:shadow-lg bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-white hover:shadow-lg">
                            {{ $category->name }}
                            <span class="ml-2 px-2 py-1 bg-white/20 rounded-full text-xs font-bold">{{ $category->posts_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($posts as $post)
                    <div class="group bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border border-white/50">
                        <div class="relative overflow-hidden">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <a href="{{ route('posts.category', $post->category->slug) }}" class="px-4 py-2 text-xs font-semibold text-white rounded-full shadow-lg backdrop-blur-sm hover:shadow-xl transition-all duration-300 transform hover:scale-105" style="background: linear-gradient(135deg, {{ $post->category->color }}, {{ $post->category->color }}cc)">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                            <div class="absolute top-4 right-4">
                                <div class="flex items-center px-3 py-1 bg-black/50 backdrop-blur-sm text-white text-xs rounded-full">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $post->view_count ?? 0 }}
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                    {{ Str::limit($post->title, 50) }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $post->user->name }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $post->created_at->format('d M Y') }}
                                </div>
                            </div>
                            
                            <!-- Like Section -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    @auth
                                        <button class="like-btn flex items-center space-x-1 px-3 py-1 rounded-full transition-all duration-200 {{ $post->isLikedBy(auth()->user()) ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                                                data-post-id="{{ $post->id }}"
                                                data-liked="{{ $post->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
                                            <svg class="w-4 h-4 {{ $post->isLikedBy(auth()->user()) ? 'fill-current' : '' }}" 
                                                 fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" 
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                            <span class="like-text text-xs">{{ $post->isLikedBy(auth()->user()) ? 'Disukai' : 'Suka' }}</span>
                                        </button>
                                    @else
                                        <div class="flex items-center space-x-1 px-3 py-1 bg-gray-100 text-gray-600 rounded-full">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                            <span class="text-xs">Suka</span>
                                        </div>
                                    @endauth
                                    <span class="likes-count text-xs text-gray-500">
                                        <span class="font-semibold">{{ number_format($post->likesCount()) }}</span> suka
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada postingan</h3>
                        <p class="text-gray-500">Belum ada postingan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="flex justify-center">
                    {{ $posts->appends(request()->query())->fragment('postingan')->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Modal untuk menampilkan postingan -->
    <div id="postModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-800"></h2>
                    <button onclick="closePostModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="prose max-w-none">
                    <!-- Content akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showPostModal(postId) {
    fetch(`/posts/${postId}/modal`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = data.title;
            document.getElementById('modalContent').innerHTML = data.content;
            document.getElementById('postModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
}

function closePostModal() {
    document.getElementById('postModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('postModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePostModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to posts section when page loads with hash or filter
    if (window.location.hash === '#postingan' || {{ request()->has('category') || request()->has('search') ? 'true' : 'false' }}) {
        setTimeout(function() {
            const element = document.getElementById('postingan');
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }, 100);
    }
    
    // Like functionality for home page cards
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const postId = this.dataset.postId;
            const isLiked = this.dataset.liked === 'true';
            
            console.log('Like button clicked:', { postId, isLiked });
            
            // Disable button during request
            this.disabled = true;
            this.style.opacity = '0.7';
            
            // Add loading animation
            const originalContent = this.innerHTML;
            this.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-xs">Loading...</span>
            `;
            
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Error response:', text);
                        throw new Error(`HTTP error! status: ${response.status}, message: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                // Update button state
                this.dataset.liked = data.liked;
                const likesCountElement = this.parentElement.querySelector('.likes-count');
                
                if (data.liked) {
                    this.className = 'like-btn flex items-center space-x-1 px-3 py-1 rounded-full transition-all duration-200 bg-red-100 text-red-600 hover:bg-red-200';
                    this.innerHTML = `
                        <svg class="w-4 h-4 fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="like-text text-xs">Disukai</span>
                    `;
                } else {
                    this.className = 'like-btn flex items-center space-x-1 px-3 py-1 rounded-full transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-gray-200';
                    this.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="like-text text-xs">Suka</span>
                    `;
                }
                
                // Update count with animation
                if (likesCountElement) {
                    likesCountElement.style.transform = 'scale(1.1)';
                    likesCountElement.innerHTML = `<span class="font-semibold">${data.likes_count.toLocaleString()}</span> suka`;
                    setTimeout(() => {
                        likesCountElement.style.transform = 'scale(1)';
                    }, 200);
                }
                
                // Re-enable button
                this.disabled = false;
                this.style.opacity = '1';
                
                // Add success animation
                this.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Restore original content
                this.innerHTML = originalContent;
                this.disabled = false;
                this.style.opacity = '1';
                
                // Show error message
                const errorMsg = document.createElement('div');
                errorMsg.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                errorMsg.textContent = 'Gagal memproses like. Silakan coba lagi.';
                document.body.appendChild(errorMsg);
                
                setTimeout(() => {
                    errorMsg.remove();
                }, 3000);
            });
        });
    });
    
    // Add smooth transition styles for like counts
    document.querySelectorAll('.likes-count').forEach(element => {
        element.style.transition = 'transform 0.2s ease';
    });
});


</script>
@endsection

@push('styles')
<style>
.welcome-title {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1.2s ease-out 0.5s forwards;
}

.welcome-text {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 1s ease-out 1.2s forwards, typeWriter 3s steps(60) 2.5s forwards;
    overflow: hidden;
    white-space: nowrap;
    border-right: 3px solid #60A5FA;
    width: 0;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes typeWriter {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}

.welcome-text::after {
    content: '';
    animation: blink 0.8s infinite 5.5s;
}

@keyframes blink {
    0%, 50% {
        border-color: #60A5FA;
    }
    51%, 100% {
        border-color: transparent;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const welcomeText = document.querySelector('.welcome-text');
    
    if (welcomeText) {
        // Remove border after typing animation completes
        setTimeout(() => {
            welcomeText.style.borderRight = 'none';
            welcomeText.style.whiteSpace = 'normal';
            welcomeText.style.overflow = 'visible';
            welcomeText.style.width = 'auto';
        }, 8500);
    }
});
</script>
@endpush