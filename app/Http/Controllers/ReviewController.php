<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReviewController extends Controller
{
    public function index($userId, $postId) {

        $reviews = Review::where('post_id', $postId)
            ->with('user')
            ->get();

        foreach ($reviews as $review) {
            $review['posted_time'] = Carbon::create($review->created_at)->diffForHumans();
            $review['like_number'] = $review->likedUsers()->count();
            $review['liked_by_current_user'] = in_array(
                $userId,
                $review->likedUsers()->pluck('users.id')->toArray()
            );
        }

        return $reviews;
    }

    public function store(Request $request) {
        
        $userId = $request->user_id;
        $postId = $request->post_id;
        $content = $request->content;

        $newReview = Review::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'content' => $content,
        ]);

        return $newReview;
    }

    public function like(Request $request) {

        $userId = $request->user_id;
        $reviewId = $request->review_id;

        $user = User::find($userId);
        $user->likedReviews()->toggle($reviewId);

        return response('ok');
    }
}
