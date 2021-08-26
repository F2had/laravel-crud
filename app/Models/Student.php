<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Student extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'email',
        'age',
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
