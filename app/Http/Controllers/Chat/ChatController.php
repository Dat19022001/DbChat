<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
  //
  public function sentChat(Request $request)
  {
    try {
      $data = $request->all();

      $chat = Chat::create($data);

      return response()->json(['message' => 'Thêm chat thành công', 'chat' => $chat], 200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Thêm chat thất bại'], 400);
    }
  }

  public function getChat($id)
  {
    Log::info(date("Y-m-d H:i:s"));
    $messages = Chat::where("idChat", $id)->orderBy("date_sent", "asc")->get();
    Log::info(date("Y-m-d H:i:s"));
    return response()->json(['messages' => $messages], 200);
  }
}
