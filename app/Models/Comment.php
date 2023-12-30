<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\CommentNotification;


class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function sendNotificationToPostOwner()
    {
        $postOwner = $this->post->user;

        // Notify the post owner only if they are different users
        if ($postOwner->id !== $this->user_id) {
            $postOwner->notify(new CommentNotification($this));
        }
       
    }
}
