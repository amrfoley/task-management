<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreUpdateCommentRequest;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCommentRequest $request, Task $task)
    {
        Gate::authorize('create', Comment::class);

        (new CommentService())->publish($request, $task);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCommentRequest $request, Comment $comment)
    {
        if ($request->user()->cannot('update', $comment)) {
            abort(403);
        }

        (new CommentService())->update($request, $comment);

        return new TaskResource($comment->task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($request->user()->cannot('delete', $comment)) {
            abort(403);
        }

        $deleted = (new CommentService())->delete($comment);

        return response($deleted? 'Comment deleted!' : 'Failed to delete!');
    }
}
