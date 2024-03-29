<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;
    protected $table = 'RoomChats';
    public function user()
    {
        return $this->belongsTo(User::class, 'idFriend', 'idUser');
    }
    protected $fillable = [
        'idUser',
        'idFriend',
    ];
}
