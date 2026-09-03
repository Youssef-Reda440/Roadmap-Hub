<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class);
    }
}
