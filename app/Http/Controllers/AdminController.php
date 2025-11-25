<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        $recentPosts = Post::with(['category', 'user'])
            ->latest('created_at')
            ->limit(5)
            ->get();

        $stats = [
            'total_posts' => $totalPosts,
            'published_posts' => $publishedPosts,
            'total_categories' => $totalCategories,
            'total_users' => $totalUsers,
        ];

        return view('admin.dashboard', compact('stats', 'recentPosts'));
    }
}