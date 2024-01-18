<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;
    protected $table = 'Chat';
    public $timestamps = false;

    protected $fillable = [
        'idChat',
        'idSent',
        'idReceived',
        'content',
        'date_sent',
        'date_received',
        'date_read',
    ];
}
