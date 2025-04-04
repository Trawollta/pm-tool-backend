<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use CrudTrait, HasFactory;

    protected $table = 'subtasks';

    protected $fillable = [
        'title',
        'done',
        'task_id',
    ];

    protected $casts = [
        'done' => 'boolean',
    ];

    /**
     * Beziehung zur übergeordneten Task.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
