<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getBm(Request $request)
    {
        $userId = $request->user_id;

        $user = User::find($userId);

        return $user->bookmarks()->with(['user', 'images', 'videos'])->get();
    }
    public function storeBm(Request $request)
    {
        $userId = $request->user_id;
        $postId = $request->post_id;

        $user = User::find($userId);
        $post = Post::find($postId);

        if(!$user || !$post)
        {
            response()->json(['error' => 'invalid'], 401);
        }

        if(Bookmark::where('user_id', $userId)->where('post_id', $postId)->first() != null) {
            return response()->json(['error' => 'already exist'], 404);
        }

        $item = Bookmark::create(['user_id' => $userId, 'post_id' => $postId]);
        return response()->json(['status' => 'success'], 200);
    }

    public function deleteBm(Request $request)
    {
        $userId = $request->user_id;
        $postId = $request->post_id;

        $item = Bookmark::where('user_id', $userId)->where('post_id', $postId)->first();

        if($item)
        {
            $item->delete();
            return response()->json(['status' => 'success'], 200);
        }
        else
            return response()->json(['error' => 'invalid'], 401);
    }
}
