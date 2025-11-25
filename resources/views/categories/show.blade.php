@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Hero Header -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-6 shadow-2xl" style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}dd)">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-4">
                    {{ $category->name }}
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                    {{ $category->description }}
                </p>
                <div class="inline-flex items-center px-8 py-4 rounded-full text-white font-semibold shadow-xl transform hover:scale-105 transition-all duration-300" style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}cc)">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ $posts->total() }} Artikel Tersedia
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation & Search -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row justify-between items-center mb-12 gap-6">
            <a href="{{ route('home') }}" class="group inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur-sm text-gray-700 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
            
            <div class="w-full lg:w-auto">
                <form action="{{ route('posts.category', $category->slug) }}" method="GET">
                    <div class="flex items-center bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg focus-within:ring-4 focus-within:ring-blue-500/20 focus-within:bg-white transition-all duration-300 w-full lg:w-96">
                        <div class="pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" class="flex-1 px-4 py-4 bg-transparent border-0 focus:outline-none text-gray-900 placeholder-gray-500" 
                               placeholder="Cari artikel..." 
                               value="{{ request('search') }}">
                        <button class="px-4 py-2 mx-2 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300" style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}cc)" type="submit">
                            Cari
                        </button>
                    </div>
                </form>
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
                            <span class="px-4 py-2 text-xs font-semibold text-white rounded-full shadow-lg backdrop-blur-sm" style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}cc)">
                                {{ $category->name }}
                            </span>
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
                                {{ $post->title }}
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
                                {{ $post->published_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2">
                                @foreach($post->tags->take(2) as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="group inline-flex items-center px-6 py-2 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}cc)">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Artikel</h4>
                        <p class="text-gray-500 text-lg">Artikel untuk kategori ini belum tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection