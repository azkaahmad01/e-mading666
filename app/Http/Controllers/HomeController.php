<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk posts dengan filter
        $query = Post::with(['category', 'user', 'tags'])
            ->where('status', 'published');

        // Debug: lihat parameter yang diterima
        \Log::info('Request parameters:', $request->all());

        // Filter by category
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            
            if ($category) {
                $query->where('category_id', $category->id);
                \Log::info('Filtering by category:', ['category_id' => $category->id, 'category_slug' => $category->slug]);
            }
        }

        // Filter by search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest('published_at')
            ->paginate(9)
            ->appends($request->query());

        // Query untuk categories dengan count
        $categories = Category::withCount(['posts' => function ($query) {
                $query->where('status', 'published');
            }])
            ->orderBy('name')
            ->get();

        // Debug: lihat hasil query
        \Log::info('Posts count:', ['count' => $posts->count()]);
        \Log::info('Categories:', $categories->pluck('name', 'slug')->toArray());

        return view('home', compact('posts', 'categories'));
    }
}