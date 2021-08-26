<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class survey_template_dtl extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

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

    public function responses()
    {
        return $this->hasMany(survey_response_dtl::class, 'survey_dtl_id', 'id');
    }
   
}
