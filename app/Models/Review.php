<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['rating', 'comment'])]
class Review extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
