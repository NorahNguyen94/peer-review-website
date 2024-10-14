<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['courseCode', 'courseName'];

    // Specify the primary key
    protected $primaryKey = 'courseCode';


    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    
    public function users() {
        return $this->belongsToMany(User::class, 'enrolled_courses', 'courseCode', 'sNumber', 'courseCode', 'sNumber');
    }

    public function assessments() {
        return $this->hasMany(Assessment::class, 'courseCode', 'courseCode');
    }
}
