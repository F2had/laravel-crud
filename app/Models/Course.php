<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'credit',
        'department',
    ];

    public function students()
    {
        $this->belongsToMany(Student::class)->using(StudentCourse::class);
    }
}
