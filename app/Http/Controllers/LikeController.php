<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle($postId)
    {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'User not authenticated'], 401);
        }

        $post = Post::findOrFail($postId);

        $existingLike = Like::where('post_id', $post->id)
                           ->where('user_id', $user->id)
                           ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id
            ]);
            $liked = true;
        }

        // Refresh the post to get updated likes count
        $post->refresh();
        $likesCount = $post->likes()->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount,
            'success' => true
        ]);
    }
}