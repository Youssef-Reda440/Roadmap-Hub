<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function completions()
    {
        return $this->hasMany(TopicCompletion::class);
    }
}
