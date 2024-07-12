<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TodoTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'task',
        'status',
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
