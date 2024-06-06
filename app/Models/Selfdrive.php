<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;
use App\Models\Drivers;
use App\Models\Admincar;
use App\Models\Remarks;

class Selfdrive extends Model
{
    use HasFactory;

    protected $fillable = [
        'carname',
        'carprice',
        'carmodel',
        'carseats',
        'pickupdate',
        'pickuptime',
        'dropoffdate',
        'dropofftime',
        'destination',
        'license',
        'daytrip',
        'status',
        'cancelled_reason',
        'total_payment',
        'lastrate',
        'expiration_time',

    ];

    public function admincar()
    {
        return $this->belongsTo(Admincar::class, 'admincars_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'book_id', 'id');
    }
    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'booking_id', 'id');
    }


}
