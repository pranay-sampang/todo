<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
