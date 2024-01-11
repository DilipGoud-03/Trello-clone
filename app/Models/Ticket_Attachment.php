<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_Attachment extends Model
{
    use HasFactory;

    protected $fillable = ([
        'ticket_id',
        'comment_id',
        'name',
        'path',
        'type'
    ]);

    public function TickComm()
    {
        return $this->belongsTo(Tickets::class, Comments::class);
    }
}
