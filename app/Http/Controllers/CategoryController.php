<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category, Request $request)
    {
        $query = Post::where('category_id', $category->id)
            ->where('status', 'published')
            ->with(['user', 'tags', 'category']);

        // Filter by search
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest('published_at')->paginate(12);
            
        return view('categories.show', compact('category', 'posts'));
    }
}