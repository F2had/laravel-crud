<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_template_hdr extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'title',
        'code',
        'description',
        'url',
        'isOpen'
    ];

    public function details()
    {
        return $this->hasMany(survey_template_dtl::class, 'hdr_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
