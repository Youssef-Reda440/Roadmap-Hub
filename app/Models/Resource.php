<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public function topic()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
