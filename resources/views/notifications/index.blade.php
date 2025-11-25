@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Notifikasi</h1>
            @if(auth()->user()->unreadNotifications()->count() > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="bg-white rounded-lg shadow-md p-4 {{ !$notification->is_read ? 'border-l-4 border-blue-500' : '' }}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-gray-800 {{ !$notification->is_read ? 'font-semibold' : '' }}">
                                    {{ $notification->message }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$notification->is_read)
                                <a href="{{ route('notifications.read', $notification->id) }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                    Lihat
                                </a>
                            @else
                                @if($notification->post)
                                    <a href="{{ route('posts.show', $notification->post->slug) }}" 
                                       class="text-blue-500 hover:text-blue-700 text-sm">
                                        Lihat Artikel
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">Artikel dihapus</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada notifikasi</p>
            </div>
        @endif
    </div>
</div>
@endsection