<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id',
        'name',
        'description',
        'assignee'
    ];

    // Relationships
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comment()
    {
        return $this->hasMany(TicketComment::class);
    }
    public function attechment()
    {
        return $this->hasMany(TicketAttachment::class);
    }
}
