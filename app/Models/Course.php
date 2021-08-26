<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'credit',
        'department',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses')->withPivot('year');
    }
}
