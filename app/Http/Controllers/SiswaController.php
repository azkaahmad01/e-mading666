<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $myPosts = Post::where('user_id', auth()->id())->latest()->take(5)->get();
        $totalMyPosts = Post::where('user_id', auth()->id())->count();
        $categories = Category::all();
        $notifications = auth()->user()->unreadNotifications()->with('post')->latest()->take(5)->get();
        
        return view('siswa.dashboard', compact('myPosts', 'totalMyPosts', 'categories', 'notifications'));
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())->with('category')->latest()->paginate(10);
        return view('siswa.posts.index', compact('posts'));
    }

    public function createPost()
    {
        $categories = Category::all();
        return view('siswa.posts.create', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt ?: Str::limit($request->content, 150),
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 'draft',
            'published_at' => null
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post = Post::create($data);



        return redirect()->route('siswa.posts')->with('success', 'Artikel berhasil dibuat!');
    }

    public function editPost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        
        $categories = Category::all();
        return view('siswa.posts.edit', compact('post', 'categories'));
    }

    public function updatePost(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt ?: Str::limit($request->content, 150),
            'category_id' => $request->category_id,
        ];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('siswa.posts')->with('success', 'Artikel berhasil diupdate!');
    }

    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }
}