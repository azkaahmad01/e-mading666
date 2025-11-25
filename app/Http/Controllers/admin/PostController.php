<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->where('status', 'published')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function pending()
    {
        $posts = Post::with(['category', 'user'])->where('status', 'draft')->latest()->paginate(10);
        return view('admin.posts.pending', compact('posts'));
    }



    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt ?: Str::limit($request->content, 150),
            'category_id' => $request->category_id,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null
        ];

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $wasPublished = $post->status === 'published';
        $post->update($data);

        // Send notification if post is newly published and author is siswa
        if (!$wasPublished && $request->status === 'published' && $post->user->isSiswa()) {
            \App\Models\Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'title' => 'Artikel Disetujui',
                'message' => 'Artikel "' . $post->title . '" telah disetujui dan dipublikasikan!',
                'type' => 'success'
            ]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diverifikasi!');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            \Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus!');
    }

    public function approve(Post $post)
    {
        $post->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        // Create notification for the author if siswa
        if ($post->user->isSiswa()) {
            \App\Models\Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'title' => 'Artikel Disetujui',
                'message' => 'Artikel "' . $post->title . '" telah disetujui dan dipublikasikan!',
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with('success', 'Artikel berhasil disetujui dan dipublikasi!');
    }

    public function reject(Request $request, Post $post)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        if ($post->user->isSiswa()) {
            \App\Models\Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'title' => 'Artikel Ditolak',
                'message' => 'Artikel "' . $post->title . '" ditolak. Alasan: ' . $request->reason,
                'type' => 'error'
            ]);
        }
        
        $post->delete();
        return redirect()->route('admin.posts.pending')->with('success', 'Artikel berhasil ditolak!');
    }
}