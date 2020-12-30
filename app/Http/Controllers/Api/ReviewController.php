<?php

namespace App\Http\Controllers\API;

use App\Product;
use App\General\Review;
use App\Company\Company;
use App\General\CommentLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'rate' => 'required|min:1|max:5',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $review = auth()->user()->reviews()->create([
            'company_id' => $request->company_id,
            'rate' => $request->rate,
            'comment' => $request->comment
        ]);
        if ($review) {
            $count = Review::where('company_id', $request->company_id)->count() ? Review::where('company_id', $request->company_id)->count() : 1;
            $review->company->update([
                'total_rating' => Review::where('company_id', $request->company_id)->sum('rate') / $count
            ]);
            $review->company->increment('rate_user_count');
            return response()->json(['status' => 200, 'message' => __('messages.review_success')], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
        }
    }

    public function commentLike(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
            'review_id' => 'required|exists:reviews,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $review = Review::find($request->review_id)->increment('likes_count');
        if ($review) {
            $comment = CommentLike::create([
                'user_id' => auth()->user()->id,
                'review_id' => $request->review_id,
            ]);
            return response()->json(['status' => 200, 'message' => __('messages.like_success')], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
        }
    }

    public function commentDislike(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
            'review_id' => 'required|exists:reviews,id',
            'reson' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $review = Review::find($request->review_id)->increment('dislikens_count');
        if ($review) {
            $comment = CommentLike::create([
                'user_id' => auth()->user()->id,
                'review_id' => $request->review_id,
                'type' => 1,
                'reson' => $request->reson
            ]);
            return response()->json(['status' => 200, 'message' => __('messages.dislike_success')], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
        }
    }
}
