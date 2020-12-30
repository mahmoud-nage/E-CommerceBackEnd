<?php

namespace App\Http\Controllers\API;

use App\User;
use App\General\Ticket;
use App\General\TicketReply;
use Illuminate\Http\Request;
use App\General\BusinessSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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

    $records = Ticket::where('user_id', $request->user_id)->latest()->paginate($general_paginate_count);

    if ($records) {
      return response()->json(['status' => 200, 'data' => $records], 200);
    }
    return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
  }

  public function show(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'user_id' => 'required|exists:users,id',
      'ticket_id' => 'required|exists:tickets,id',
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
    }

    $record = Ticket::where('user_id', $request->user_id)->where('id', $request->ticket_id)->first();

    if ($record) {
      $data = [
        'data' => $record,
        'replies' => $record->ticketReply,
      ];
      return response()->json(['status' => 200, 'data' => $data], 200);
    }
    return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate(request(), [
      'subject' => 'required',
      'details' => 'required',
      'user_id' => 'required|exists:users,id',
    ]);
    $code = max(100000, (Ticket::latest()->first() != null ? Ticket::latest()->first()->code + 1 : 0));
    $user = User::find($request->user_id);
    $record = Ticket::create([
      'user_id' => $request->user_id,
      'details' => $request->details,
      'subject' => $request->subject,
      'code' => $code,
      'type' => $user->type,
    ]);

    if ($record) {
      return response()->json(['status' => 200, 'message' => __('messages.success_ticket')], 200);
    }

    return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
  }

  public function reply(Request $request)
  {
    $this->validate(request(), [
      'user_id' => 'required|exists:users,id',
      'ticket_id' => 'required|exists:tickets,id',
      'reply' => 'required',
    ]);

    $record = TicketReply::create([
      'user_id' => $request->user_id,
      'ticket_id' => $request->ticket_id,
      'reply' => $request->reply,
    ]);

    if ($record) {
      return response()->json(['status' => 200, 'message' => __('messages.success_reply')], 200);
    }

    return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
  }
}
