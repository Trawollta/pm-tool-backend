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
        'category_id',
        'board_id',
    ];

    protected $casts = [
        'assignees' => 'array',
        'labels'    => 'array',
        'due_date'  => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function subtasks()
{
    return $this->hasMany(Subtask::class);
}

public function assignees()
{
    return $this->belongsToMany(User::class, 'task_user'); // task_user = Pivot-Tabelle für viele-zu-viele
}
}
