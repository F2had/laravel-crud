<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class survey_template_hdr extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;



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

    public function responses()
    {
        return $this->hasMany(survey_response_hdr::class, 'survey_hdr_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
