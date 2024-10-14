<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sNumber',
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrolled_courses', 'sNumber', 'courseCode', 'sNumber', 'courseCode');
    }

    public function peer_reviews_by_reviewer()
    {
        return $this->hasMany(PeerReview::class, 'reviewerID', 'sNumber');
    }

    public function peer_reviews_by_reviewee()
    {
        return $this->hasMany(PeerReview::class, 'revieweeID', 'sNumber');
    }

    public function assessments()
    {
        return $this->belongsToMany(Assessment::class, 'score', 'sNumber', 'assessmentID', 'sNumber', 'id')->withPivot('score')->withTimestamps();
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class, 'sNumber', 'sNumber');
    }

    public function inGroup() {
        return $this->belongsToMany(Assessment::class, 'assessment_group', 'sNumber', 'assessmentID')->withPivot('groupID');
    }
    
}
