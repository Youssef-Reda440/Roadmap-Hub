<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedRoadmap extends Model
{
    protected $fillable = [
        'user_id',
        'roadmap_id',
        'saved_at',
    ];

    public $timestamps = false;
    
    protected function casts(): array
    {
        return [
            'saved_at' => 'datetime',
            '',
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
