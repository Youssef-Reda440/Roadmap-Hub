<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'roadmap_id',
    'title',
    'url',
    'type',
    'description',
])]
class Resource extends Model
{
    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
