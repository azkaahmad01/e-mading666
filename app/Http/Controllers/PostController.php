<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function index(Request $request)
{
    $query = Post::with(['category', 'user', 'tags', 'likes'])
        ->where('status', 'published');

    // Filter by category
    if ($request->has('category') && $request->category) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    // Filter by search
    if ($request->has('search') && $request->search) {
        $query->search($request->search);
    }

    $posts = $query->latest('published_at')
        ->paginate(9);

    $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published')
                  ->where('published_at', '<=', now());
        }])
        ->orderBy('name')
        ->get();

    return view('home', compact('posts', 'categories'));
}

    public function show(Post $post)
    {
        // Increment view count
        $post->incrementViewCount();

        // Load relasi
        $post->load(['category', 'user', 'tags', 'comments.user', 'likes']);
        
        // Check if current user liked this post
        $isLiked = auth()->check() ? $post->isLikedBy(auth()->user()) : false;

        // Related posts
        $relatedPosts = Post::with(['category', 'user'])
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts', 'isLiked'));
    }



    public function modal($postId)
    {
        $post = Post::with(['category', 'user'])->findOrFail($postId);
        
        // Check if user can view this post (published or pembina can view pending)
        if ($post->status !== 'published' && !auth()->user()->isPembina()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $statusBadge = $post->status === 'published' 
            ? '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Dipublikasi</span>'
            : '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menunggu Konfirmasi</span>';
        
        return response()->json([
            'title' => $post->title,
            'content' => '<div class="mb-4">' .
                        ($post->featured_image ? '<img src="' . asset('storage/' . $post->featured_image) . '" class="w-full h-64 object-cover rounded-lg mb-4" alt="' . $post->title . '">' : '') .
                        '<div class="flex items-center justify-between mb-4">' .
                        '<div class="flex items-center space-x-2">' .
                        '<span class="px-3 py-1 text-sm font-semibold text-white rounded-full" style="background: ' . $post->category->color . '">' . $post->category->name . '</span>' .
                        $statusBadge .
                        '</div>' .
                        '<span class="text-gray-500 text-sm">' . $post->created_at->format('d M Y') . '</span>' .
                        '</div>' .
                        '<div class="flex items-center mb-4">' .
                        '<svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' .
                        '<span class="text-gray-600">' . $post->user->name . '</span>' .
                        '</div>' .
                        '</div>' .
                        '<div class="prose max-w-none">' . nl2br(e($post->content)) . '</div>'
        ]);
    }


}