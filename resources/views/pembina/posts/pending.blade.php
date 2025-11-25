@extends('layouts.app')

@section('content')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.modal-enter {
    animation: modalEnter 0.3s ease-out;
}

.modal-leave {
    animation: modalLeave 0.2s ease-in;
}

@keyframes modalEnter {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes modalLeave {
    from {
        opacity: 1;
        transform: scale(1);
    }
    to {
        opacity: 0;
        transform: scale(0.9);
    }
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
}
</style>
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Artikel Menunggu Konfirmasi</h1>
        <a href="{{ route('pembina.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            Kembali
        </a>
    </div>

    @if($posts->count() > 0)
        <div class="space-y-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg card-hover p-6">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $post->title }}</h3>
                            <div class="flex flex-wrap items-center text-sm text-gray-600 mb-3 gap-2">
                                <span class="px-2 py-1 rounded-full text-xs font-medium" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $post->user->name }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $post->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 200) }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 lg:ml-6 mt-4 lg:mt-0">
                            <a href="{{ route('posts.show', $post) }}" class="bg-blue-100 text-blue-700 px-3 py-2 rounded-lg hover:bg-blue-200 text-sm font-medium transition duration-200 text-center">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat
                            </a>
                            <form method="POST" action="{{ route('pembina.posts.approve', $post) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui artikel ini?')">
                                @csrf
                                <button type="submit" class="w-full bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-sm font-medium transition duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Setujui
                                </button>
                            </form>
                            <form method="POST" action="{{ route('pembina.posts.reject', $post) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak artikel ini? Artikel akan dihapus dan tidak dapat dikembalikan.')">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 text-sm font-medium transition duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Tidak ada artikel yang menunggu konfirmasi</p>
        </div>
    @endif
</div>


@endsection
