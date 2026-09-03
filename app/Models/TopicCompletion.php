<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicCompletion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
