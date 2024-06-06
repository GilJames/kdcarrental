<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use App\Models\Feedback;
use App\Models\Remarks;



class User extends Authenticatable implements BannableContract, MustVerifyEmail
{
    use HasFactory, Notifiable,Bannable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'name',
        'middlename',
        'surname',
        'photo',
        'email',
        'number',
        'middlename',
        'surname',
        'address',
        'password',
        'banned_at',

    ];

    public function CarDetail(){
        return $this->hasMany(CarDetail::class);
    }

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


    public function comment()
    {
        return $this->hasMany(Feedback::class);
    }
    public function rating()
    {
        return $this->hasMany(Feedback::class);
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class);
    }


    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function selfdrive()
    {
        return $this->hasMany(Selfdrive::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}



