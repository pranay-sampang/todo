<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    protected $fillable = [
        'title',
    ];

    public function todoTask()
    {
        return $this->hasMany(TodoTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
