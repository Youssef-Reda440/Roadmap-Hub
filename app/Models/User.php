<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function creatorProfile()
    {
        return $this->hasOne(CreatorProfile::class);
    }

    public function creatorApplications()
    {
        return $this->hasMany(CreatorApplication::class);
    }

    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class, 'creator_id');
    }

    public function roadmapEnrollments()
    {
        return $this->hasMany(RoadmapEnrollment::class);
    }

    public function topicCompletions()
    {
        return $this->hasMany(TopicCompletion::class);
    }

    public function savedRoadmaps()
    {
        return $this->hasMany(SavedRoadmap::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function submittedReports()
    {
        return $this->hasMany(Report::class);
    }

    public function receivedReports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
