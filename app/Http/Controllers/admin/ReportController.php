<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PostsExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $draftPosts = Post::where('status', 'draft')->count();
        $totalUsers = User::count();
        $totalCategories = Category::count();

        $postsByCategory = Category::withCount('posts')->get();
        $postsByUser = User::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $recentPosts = Post::with(['user', 'category'])->latest()->take(10)->get();
        
        // Monthly data for chart
        $monthlyPosts = Post::monthlyStats(12)->get();

        return view('admin.reports.index', compact(
            'totalPosts', 'publishedPosts', 'draftPosts', 'totalUsers', 'totalCategories',
            'postsByCategory', 'postsByUser', 'recentPosts', 'monthlyPosts'
        ));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'all');
        $month = $request->get('month');
        $category = $request->get('category');
        
        $query = Post::with(['user', 'category'])->published();
        
        if ($type === 'monthly' && $month) {
            $date = Carbon::createFromFormat('Y-m', $month);
            $query->whereYear('published_at', $date->year)
                  ->whereMonth('published_at', $date->month);
        }
        
        if ($type === 'category' && $category) {
            $query->where('category_id', $category);
        }
        
        $posts = $query->orderBy('published_at', 'desc')->get();
        $categoryName = $category ? Category::find($category)->name : 'Semua Kategori';
        $monthName = $month ? Carbon::createFromFormat('Y-m', $month)->format('F Y') : '';
        
        $pdf = Pdf::loadView('admin.reports.pdf', compact('posts', 'type', 'categoryName', 'monthName'));
        
        $filename = 'laporan_artikel_' . ($type === 'monthly' ? $month : ($type === 'category' ? strtolower($categoryName) : 'semua')) . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
    
    public function exportExcel(Request $request)
    {
        $type = $request->get('type', 'all');
        $month = $request->get('month');
        $category = $request->get('category');
        
        $export = new PostsExport($type, $month, $category);
        $export->export();
    }
}