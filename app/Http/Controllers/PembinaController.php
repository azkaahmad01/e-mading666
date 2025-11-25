<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    public function dashboard()
    {
        $pendingPosts = Post::where('status', 'draft')->with(['category', 'user'])->latest()->take(5)->get();
        $totalPending = Post::where('status', 'draft')->count();
        $totalPublished = Post::where('status', 'published')->count();
        
        return view('pembina.dashboard', compact('pendingPosts', 'totalPending', 'totalPublished'));
    }

    public function pendingPosts()
    {
        $posts = Post::where('status', 'draft')->with(['category', 'user'])->latest()->paginate(10);
        return view('pembina.posts.pending', compact('posts'));
    }

    public function approvePost(Post $post)
    {
        $post->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        // Create notification for the author if siswa
        if ($post->user->isSiswa()) {
            Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'title' => 'Artikel Disetujui',
                'message' => 'Artikel "' . $post->title . '" telah disetujui dan dipublikasikan!',
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with('success', 'Artikel berhasil disetujui dan dipublikasi!');
    }

    public function rejectPost(Post $post)
    {
        // Create notification for the author if siswa
        if ($post->user->isSiswa()) {
            Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'title' => 'Artikel Ditolak',
                'message' => 'Artikel "' . $post->title . '" tidak disetujui dan telah dihapus.',
                'type' => 'error'
            ]);
        }

        $post->delete();
        return redirect()->route('pembina.posts.pending')->with('success', 'Artikel berhasil ditolak dan dihapus!');
    }
}