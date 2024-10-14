<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'instruction', 'numberOfReview', 'dueDateTime', 'maxScore', 'type', 'courseCode'];

    // Define the relationship: An assessment belongs to one course
    public function course()
    {
        return $this->belongsTo(Course::class, 'courseCode', 'courseCode');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'score', 'assessmentID', 'sNumber', 'id', 'sNumber')->withPivot('score')->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(PeerReview::class, 'assessmentID', 'id');
    }

    public function groups() {
        return $this->belongsToMany(User::class, 'assessment_group', 'assessmentID', 'sNumber')->withPivot('groupID');
    }
}
