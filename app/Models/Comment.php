<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'user_id', 'parent_id'];

    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    
    public function getTotalRepliesCount()
    {
        return $this->replies->reduce(function ($count, $reply) {
            return $count + 1 + $reply->getTotalRepliesCount();
        }, 0);
    }
}
