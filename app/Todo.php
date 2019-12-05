<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'due_date', 'order',

        'user_id', 'parent_todo_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function childrenTodo()
    {
        return $this->hasMany(Todo::class, 'parent_todo_id');
    }
}
