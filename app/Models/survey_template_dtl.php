<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_template_dtl extends Model
{
    use HasFactory;

    protected $fillable = [
        'hdr_id',
        'sequence',
        'question',
        'answer_type'
    ];

    public function header()
    {
        return $this->belongsTo(survey_template_hdr::class);
    }
}
