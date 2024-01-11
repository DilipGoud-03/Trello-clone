<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Invites extends Model
{
    use HasFactory;
    protected $fillable = ([
        'user_id',
        'board_id',
        'role',
        'status',
        'invited_by'
    ]);
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
