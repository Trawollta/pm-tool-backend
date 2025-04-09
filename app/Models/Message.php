<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'content',
        'conversation_type',
        'conversation_id',
        'timestamp'
    ];

    // Beziehungen (optional)
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
