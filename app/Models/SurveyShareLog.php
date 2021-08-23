<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyShareLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'sent_at',
        'sent_to'
    ];

}
