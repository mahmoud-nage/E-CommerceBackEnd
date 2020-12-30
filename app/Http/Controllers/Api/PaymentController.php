<?php 

namespace App\Http\Controllers\API;

use App\General\Payment;
use Illuminate\Http\Request;
use App\General\BusinessSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller 
{

  private $setting;

  public function __construct()
  {
      $this->setting = BusinessSettings::all();
  }
  
  public function index(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'user_id' => 'required|exists:users,id',
  ]);

  if ($validator->fails()) {
      return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
  }
  
  $general_paginate_count = $this->setting->where('type', 'general_paginate_count')->first();
  
  $general_paginate_count = $general_paginate_count ? $general_paginate_count->value : 9;

      $records = Payment::with('paymentMethod')->where('user_id', $request->user_id)->latest()->paginate($general_paginate_count);

      if($records){
        return response()->json(['status' => 200, 'data' => $records], 200);
    }
    return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
  }
}

?>