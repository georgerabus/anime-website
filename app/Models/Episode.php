<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
