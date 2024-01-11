<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ([
        'user_id',
        'ticket_id',
        'comment'
    ]);
    public function InviteUser()
    {
        return $this->belongsTo(User_Invites::class, Tickets::class);
    }
}
