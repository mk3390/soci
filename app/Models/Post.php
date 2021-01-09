<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $data = [];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validate($request)
    {
        $this->data = $request;
    }

    public function store()
    {
        $this->create($this->data);
    }
}
