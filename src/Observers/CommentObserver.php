<?php

namespace Despawn\Observers;

use Despawn\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        //
    }

    public function updated(Comment $comment)
    {
        //
    }

    public function deleted(Comment $comment)
    {
        //
    }

    public function restored(Comment $comment)
    {
        //
    }

    public function forceDeleted(Comment $comment)
    {
        //
    }
}
