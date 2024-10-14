<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['sNumber', 'rating', 'feedback'];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'sNumber', 'sNumber');
    }

}
