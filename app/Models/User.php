<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use OwenIt\Auditing\Contracts\Auditable;


class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, \OwenIt\Auditing\Auditable;
 


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password, ['rounds' => 12]);
    }

    public function surveys()
    {
        return $this->hasMany(survey_template_hdr::class);
    }
}
