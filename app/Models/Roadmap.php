<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'creator_id',
    'category_id',
    'title',
    'description',
    'level',
    'status',
])]
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

    public function resources()
    {
        return $this->hasMany(Resource::class);
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
