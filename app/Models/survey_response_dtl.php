<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_response_dtl extends Model
{
    use HasFactory;


    protected $fillable = [
        'hdr_id',
        'survey_dtl_id',
        'question',
        'answer_type',
        'response',
        'response_detail'
    ];

    public function header()
    {
        return $this->belongsTo(survey_response_hdr::class);
    }

    public function details()
    {
        return $this->belongsTo(survey_template_dtl::class);
    }
}
