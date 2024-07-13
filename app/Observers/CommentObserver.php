<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentPublished;
use Illuminate\Support\Facades\Notification;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        Notification::send($comment->task->author, new CommentPublished($comment));
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        Notification::send($comment->task->author, new CommentPublished($comment));
    }
}
