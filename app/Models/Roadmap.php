<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function enrollments()
    {
        return $this->hasMany(RoadmapEnrollment::class);
    }

    public function savedByUsers()
    {
        return $this->hasMany(SavedRoadmap::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
