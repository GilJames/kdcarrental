<?php

namespace App\Models;
use App\Models\Booking;
use App\Models\Remarks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admincar extends Model
{
    use HasFactory;

    // protected $table = 'admincars';

    protected $fillable = [
        'carname',
        'carprice',
        'carmodel',
        'carseats',
        'carhistory',
        'fueltype',
        'cartype',
        'image',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class , 'admincars_id' , 'id');
    }


    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'admincars_id', 'id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'admincars_id', 'id');
    }
    public function selfbookings()
    {
        return $this->hasMany(Selfdrive::class, 'admincars_id', 'id');
    }
    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'cars_id', 'id');
    }
}
