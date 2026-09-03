<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedRoadmap extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }
}
