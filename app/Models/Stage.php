<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
