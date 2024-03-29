<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'Users';
    protected $fillable = [
        'UserName',
        'idUser',
        'listFriend',
    ];

    protected $casts = [
        'listFriend' => 'json',
    ];
}

