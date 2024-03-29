<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description'
    ];
    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userInvite()
    {
        return $this->hasMany(UserInvite::class);
    }
    public function stage()
    {
        return $this->hasMany(Stage::class)->orderBy('sequence', 'asc');
    }
}
