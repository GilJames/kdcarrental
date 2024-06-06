<?php

namespace App\Models;

use App\Models\User;
use App\Models\Car;
use App\Models\Drivers;
use App\Models\Admincar;
use App\Models\Remarks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'name',
        'carname',
        'carprice',
        'carmodel',
        'carseats',
        'expiration_time',

        'admincars_id',
        'pickupdate',
        'pickuptime',
        'dropoffdate',
        'dropofftime',
        'destination',
        'status',
        'daytrip',
        'reject_reason',
        'cancelled_reason',
        'total_payment',
        'lastrate',
    ];



    public function admincar()
    {
        return $this->belongsTo(Admincar::class, 'admincars_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function driver()
    // {
    //     return $this->belongsTo(Drivers::class, 'drivers_id', 'id');
    // }

    // public function feedback()
    // {
    //     return $this->belongsTo(Feedback::class, 'admincars_id', 'id');
    // }

    public function myrate()
    {
        return $this->belongsTo(Feedback::class, 'book_id', 'id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'book_id', 'id');
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'booking_id', 'id');
    }




    //     public function admincar()
    // {
    //     return $this->belongsTo(AdminCar::class, 'admincars_id');
    // }

    // public function driver()
    // {
    //     return $this->belongsTo(Driver::class, 'drivers_id');
    // }
}
