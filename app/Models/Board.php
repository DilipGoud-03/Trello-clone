<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $fillable = ([
        'name',
        'description',
        'created_by'
    ]);
    function User()
    {
        return $this->belongsTo(User::class);
    }
    function User_Invites()
    {
        return $this->hasMany(User_Invites::class, 'board_id');
    }
    function Stages()
    {
        return $this->hasMany(Stages::class, 'board_id');
    }
}
