<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use CrudTrait;
    // Welche Felder massenzuweisbar sind
    protected $fillable = [
        'name',
        'description',
        'creator',
        'members',
    ];

    protected $casts = [
        'members' => 'array',
    ];
}
