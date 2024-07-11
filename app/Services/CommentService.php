<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentService
{
    public function getById(string $id)
    {
        return Comment::findOrFail($id);
    }

    public function publish(Request $request, Task $task)
    {
        $comment = $request->toArray();
        $comment['user_id'] = auth('sanctum')->user()->id;

        $task->comments()->create($comment);

        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->toArray());

        return $comment;
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}