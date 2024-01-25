<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
  //
  public function createUser(Request $request)
  { {
      try {
        $data = $request->all();
        $user = User::create($data);

        $friendList = $this->createFriendList($user);

        $user->update(['listFriend' => $friendList]);
        $this->listFriend = $friendList;
        $user->save();

        return response()->json(['message' => "dang ky thanh cong", 'user' => $user], 200);
      } catch (\Exception $e) {
        return response()->json(['message' => "dang ky that bai"], 400);
      }
    }
  }
  protected function createFriendList($user)
  {
    $friendList = [];
    $otherUsers = User::where('idUser', '<>', $user->idUser)->get();

    $otherUsers = $otherUsers->toArray();

    foreach ($otherUsers as $friend) {
      try {
        $roomChat = RoomChat::create([
          'idUser' => $user->idUser,
          'idFriend' => $friend["idUser"],
        ]);
        // print_r($roomChat);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
      // dd($roomChat);

      $friendList[] = $roomChat->id;
    }

    return $friendList;
  }

  protected function updateFriendListFromRoomChats()
  {

    $users = User::all()->toArray();

    foreach ($users as $user) {
      $friendList = [];
      $roomChats = RoomChat::where('idUser', $user['idUser'])
        ->orWhere('idFriend', $user['idUser'])
        ->get()->toArray();


      foreach ($roomChats as $roomChat) {
        $friendId = $roomChat['id'];
        $friendList[] = $friendId;
      }
      $userUpdate = User::find($user['id']);
      $userUpdate->update(['listFriend' => $friendList]);
      $userUpdate->save();
    }

    return true;
  }
  protected function updateFriendList($idUser)
  {

    $user = User::where('idUser', $idUser)->first();

    try {
      $friendList = [];
      $roomChats = RoomChat::where('idUser', $user -> idUser)
        ->orWhere('idFriend', $user -> idUser)
        ->get()->toArray();


      foreach ($roomChats as $roomChat) {
        $friendId = $roomChat['id'];
        $friendList[] = $friendId;
      }
      // $userUpdate = User::find($user['id']);
      $user->update(['listFriend' => $friendList]);
      $user->save();


      return response()->json(['message' => "cap nhap thanh cong", 'user' => $user], 200);
    } catch (\Exception $e) {
      return response()->json(['message' => "cap nhap that bai"], 400);
    }
  }

  public function getChatRooms(Request $request)
  { {
      try {
        $data = $request->all();
        $listFriend = [];

        foreach ($data['listFriend'] as $item) {
          $friend = RoomChat::find($item);

          
          if ($friend) {
            $friendId = $friend->idFriend;
            $friendName = $friendId;

            // Check if idFriend is equal to idUser
            if ($friend->idFriend === $data['idUser']) {
                $friendId = $friend-> idUser;
                $user = User::where('idUser',$friendId) -> first();
                $friendName = $user -> UserName;
                // $userId = $friend -> idFriend;
            }else{
              // $userId = $friend -> idUser;
              $friendId = $friend -> idFriend;
              $friendName = $friend->user->UserName;
            }


            $listFriend[] = [
                'id' => $friend->id,
                'friend_name' => $friendName,
                'idFriend' => $friendId,
                // 'idUser' => $userId
            ];
        }
        }

        return response()->json(['message' => "danh sach ban be", 'listFriend' => $listFriend], 200);
      } catch (\Exception $e) {
        return response()->json(['message' => "danh sach khong co", 'listFriend' => $listFriend], 400);
      }
    }

  }
}
