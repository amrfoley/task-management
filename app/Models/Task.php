<?php

namespace App\Models;
 
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['auther_id', 'title', 'description', 'status', 'due_date'];

    public function author()
    {
        return $this->belongs_to(User::class, 'author_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
        ];
    }
}