<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_response_hdr extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'start_date',
        'end_date',
        'name',
        'email',
        'survey_hdr_id',
        'survey_code',
        'survey_description'
    ];

    public function header()
    {
        return $this->belongsTo(survey_template_hdr::class);
    }


    public function responses()
    {
        return $this->hasMany(survey_response_dtl::class, 'hdr_id', 'id');
    }
}
