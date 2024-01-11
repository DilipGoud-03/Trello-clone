<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stages extends Model
{
    use HasFactory;

    protected $fillable = ([
        'name',
        'sequence',
        'created_by'
    ]);

    public function Tickets()
    {
        return $this->hasMany(Tickets::class, 'stage_id');
    }

    public function Invited_User()
    {
        return $this->belongsTo(User_Invites::class);
    }
}
