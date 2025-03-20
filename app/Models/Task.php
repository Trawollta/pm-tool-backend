<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use CrudTrait;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'assignees',
        'labels',
        'progress',
        'creator',
        'status',
    ];

    protected $casts = [
        'assignees' => 'array',
        'labels'    => 'array',
        'due_date'  => 'date',
    ];
}
