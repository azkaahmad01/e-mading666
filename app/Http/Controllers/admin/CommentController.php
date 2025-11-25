<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['post', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Comment approved successfully.');
    }

    public function reject(Comment $comment)
    {
        $comment->update(['status' => 'rejected']);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Comment rejected successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}