<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'board_id',
        'role',
        'status',
        'invited_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }
}
