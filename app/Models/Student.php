<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'department',
        'phone',
        'address',
        'state',
        'country',
        'nationality'
    ];

    public function courses()
    {

        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id')->withPivot('year');
    }
}
