<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use CrudTrait;
    protected $fillable = ['name', 'creator'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
