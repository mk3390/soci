<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function follower()
    {
        return $this->belongsTo(User::class, 'followed_by', 'id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_to', 'id');
    }
}
