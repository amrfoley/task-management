<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'task_id', 'content'];

    public function user()
    {
        return $this->belongs_to(User::class, 'user_id', 'id');
    }

    public function task()
    {
        return $this->belongs_to(Task::class, 'task_id', 'id');
    }
}