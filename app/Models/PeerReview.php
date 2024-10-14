<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    use HasFactory;

    protected $fillable = ['reviewText', 'revieweeID', 'reviewerID', 'assessmentID'];

    // A peer review belong to a specific assessment
    public function assessment() {
        return $this->belongsTo(Assessment::class, 'id', 'assessmentID');
    }

    // Relationship to the Reviewer
    public function reviewer() {
        return $this->belongsTo(User::class, 'reviewerID', 'sNumber');
    }

    // Relationship to the Reviewee
    public function reviewee() {
        return $this->belongsTo(User::class, 'revieweeID', 'sNumber');
    }

    // A peer review has many feedback 
    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }
}
