@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                Dashboard Siswa
            </h1>
            <p class="text-gray-600">Selamat datang, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span>!</p>
        </div>
        <!-- Notification Section -->
        @if($notifications->count() > 0)
        <div class="mb-6">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
                <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    Notifikasi ({{ $notifications->count() }})
                </h2>
                <div class="space-y-2 max-h-40 overflow-y-auto">
                    @foreach($notifications as $notification)
                        <div id="notification-{{ $notification->id }}" class="p-3 border border-gray-100 rounded-lg hover:bg-blue-50/50 transition-all duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="text-gray-600 text-xs mt-1">{{ Str::limit($notification->message, 60) }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                <button onclick="markAsRead({{ $notification->id }})" class="text-blue-600 hover:text-blue-700 text-xs px-2 py-1 rounded hover:bg-blue-50 transition-colors ml-2">
                                    ✕
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Artikel Saya</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalMyPosts }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Kategori</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $categories->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Status</h3>
                        <p class="text-lg font-bold text-blue-600">Siswa</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 mb-6 border border-white/50">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('siswa.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Artikel
                </a>
                <a href="{{ route('siswa.posts') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Artikel Saya
                </a>
                <a href="{{ route('notifications.index') }}" class="relative inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5"></path>
                    </svg>
                    Notifikasi
                    @if(auth()->user()->unreadNotifications()->count() > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ auth()->user()->unreadNotifications()->count() }}
                        </span>
                    @endif
                </a>
            </div>
        </div>



        <!-- Recent Posts -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Artikel Terbaru Saya</h2>
            @if($myPosts->count() > 0)
                <div class="space-y-3">
                    @foreach($myPosts as $post)
                        <div class="bg-gray-50 rounded-xl p-4 border-l-4 border-blue-500 hover:shadow-md transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-800 mb-1">{{ Str::limit($post->title, 60) }}</h3>
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs mr-2">{{ $post->category->name }}</span>
                                        <span class="text-xs">{{ $post->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <a href="{{ route('siswa.posts.edit', $post) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 transition-colors">
                                        Edit
                                    </a>
                                    <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs rounded-lg hover:bg-green-700 transition-colors">
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg mb-4">Belum ada artikel.</p>
                    <a href="{{ route('siswa.posts.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat artikel pertama Anda!
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function markAsRead(notificationId) {
    fetch(`/siswa/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notification = document.getElementById(`notification-${notificationId}`);
            notification.style.opacity = '0.5';
            setTimeout(() => {
                notification.remove();
                location.reload();
            }, 300);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection