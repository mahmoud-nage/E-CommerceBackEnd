<?php

namespace App\Http\Controllers\API;

use App\General\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WhishlistController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $records = Wishlist::where('user_id',auth()->user()->id)->with('company')->latest()->get();
        if($records){
            return response()->json(['status' => 200, 'data' => $records], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $data = Wishlist::create([
            'user_id' => auth()->user()->id,
            'company_id' => $request->company_id,
        ]);

        return response()->json(['status' => 200, 'message' => __('messages.success_wishlist')], 200);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:wishlists,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $wish = Wishlist::find($request->id);
        if($wish){
            $delete = $wish->delete();
            if($delete){
                return response()->json(['status' => 200, 'message' => __('messages.wishlist_deleted')], 200);
            }
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }
}
