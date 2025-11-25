<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:1000'
        ]);

        // List of bad words
        $badWords = ['kasar', 'jelek', 'bodoh', 'goblok', 'anjing', 'babi', 'setan', 'bangsat', 'tolol', 'idiot', 'brengsek', 'sialan', 'kampret', 'memek', 'kontol', 'ngentot', 'fuck', 'shit', 'damn', 'bitch', 'asshole'];

        $content = strtolower($request->content);
        foreach ($badWords as $badWord) {
            if (str_contains($content, $badWord)) {
                return redirect()->back()->withErrors(['content' => 'Komentar mengandung kata kasar. Dilarang menggunakan kata kasar dalam komentar.'])->withInput();
            }
        }

        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}