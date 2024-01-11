<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = ([
        'stage_id',
        'name',
        'description',
        'Assignee',
        'created_by'
    ]);
    public function Comments()
    {
        return $this->hasMany(Comments::class, 'tickets_id');
    }
    public function InviteUser()
    {
        return $this->belongsTo(User_Invites::class);
    }
    public function Stages()
    {
        return $this->belongsTo(Stages::class);
    }
}
