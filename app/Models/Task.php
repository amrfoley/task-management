<?php

namespace App\Models;
 
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['author_id', 'title', 'description', 'status', 'due_date', 'assigned_to'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    protected function casts(): array
    {
        return [
            'status'    => TaskStatus::class,
            'due_date'  => 'date'
        ];
    }
}