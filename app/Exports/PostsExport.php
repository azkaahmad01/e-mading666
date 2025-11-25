<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class PostsExport
{
    protected $type;
    protected $month;
    protected $category;

    public function __construct($type = 'all', $month = null, $category = null)
    {
        $this->type = $type;
        $this->month = $month;
        $this->category = $category;
    }

    public function export()
    {
        $query = Post::with(['user', 'category'])->published();
        
        if ($this->type === 'monthly' && $this->month) {
            $date = Carbon::createFromFormat('Y-m', $this->month);
            $query->whereYear('published_at', $date->year)
                  ->whereMonth('published_at', $date->month);
        }
        
        if ($this->type === 'category' && $this->category) {
            $query->where('category_id', $this->category);
        }
        
        $posts = $query->orderBy('published_at', 'desc')->get();
        
        $filename = 'laporan_artikel_' . ($this->type === 'monthly' ? $this->month : ($this->type === 'category' ? 'kategori' : 'semua')) . '_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add BOM for UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($output, ['No', 'Judul', 'Penulis', 'Kategori', 'Tanggal Tayang', 'Views', 'Komentar', 'Status']);
        
        foreach ($posts as $index => $post) {
            fputcsv($output, [
                $index + 1,
                $post->title,
                $post->user->name,
                $post->category->name,
                $post->published_at->format('d/m/Y H:i'),
                $post->view_count,
                $post->comments->count(),
                'Tayang'
            ]);
        }
        
        fclose($output);
    }
}