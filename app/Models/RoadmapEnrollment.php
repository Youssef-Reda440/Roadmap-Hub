<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapEnrollment extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'enrolled_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }
}