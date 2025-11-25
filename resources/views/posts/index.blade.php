@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Hero Header -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-16">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-6 bg-gradient-to-br from-blue-600 to-purple-600 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-4">
                    @if(request()->has('search'))
                        Hasil Pencarian
                    @else
                        Semua Postingan
                    @endif
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                    @if(request()->has('search'))
                        Menampilkan hasil pencarian untuk "{{ request('search') }}"
                    @else
                        Temukan semua postingan terbaru dari berbagai kategori
                    @endif
                </p>
            </div>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('posts.index') }}" method="GET" class="relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" class="w-full px-6 py-4 pl-12 bg-white/80 backdrop-blur-sm border-0 rounded-2xl shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:bg-white transition-all duration-300" 
                           placeholder="Cari postingan..." 
                           value="{{ request('search') }}">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" type="submit">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Filter Categories -->
        <div class="mb-12" id="posts-section">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('posts.index') }}#posts-section" 
                   class="group px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 transform hover:scale-105 {{ !request('category') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-white hover:shadow-lg' }}">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Semua Kategori
                    </span>
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->slug]) }}#posts-section" 
                       class="group px-6 py-3 rounded-2xl text-sm font-semibold flex items-center transition-all duration-300 transform hover:scale-105 hover:shadow-lg {{ request('category') == $category->slug ? 'text-white shadow-lg' : 'bg-white/80 backdrop-blur-sm text-gray-700 hover:bg-white' }}"
                       style="{{ request('category') == $category->slug ? 'background: linear-gradient(135deg, ' . $category->color . ', ' . $category->color . 'cc)' : '' }}">
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
                            <span class="px-4 py-2 text-xs font-semibold text-white rounded-full shadow-lg backdrop-blur-sm" style="background: linear-gradient(135deg, {{ $post->category->color }}, {{ $post->category->color }}cc)">
                                {{ $post->category->name }}
                            </span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="flex items-center px-3 py-1 bg-black/50 backdrop-blur-sm text-white text-xs rounded-full">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $post->view_count }}
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit($post->excerpt, 120) }}</p>
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
                                {{ $post->published_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2">
                                @foreach($post->tags->take(2) as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="group inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                Baca Artikel
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-700 mb-3">Tidak Ada Postingan Ditemukan</h4>
                        <p class="text-gray-500 text-lg mb-6">
                            @if(request()->has('search'))
                                Coba kata kunci lain atau
                            @endif
                            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline font-semibold">lihat semua postingan</a>
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
html {
    scroll-behavior: smooth;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to posts section when page loads with hash
    if (window.location.hash === '#posts-section') {
        setTimeout(function() {
            const element = document.getElementById('posts-section');
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }, 100);
    }
});
</script>
@endsection