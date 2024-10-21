<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    public $timestamps = false;
    public $fillable = ['title', 'description', 'photo', ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
