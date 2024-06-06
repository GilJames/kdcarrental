<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admincar;
use App\Models\Booking;
use App\Models\Selfdrive;

class Remarks extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'users_id', 'cars_id', 'comment', 'rate', 'booking_model'];




    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Admincar::class, 'cars_id', 'id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id', 'id');
    }
    public function selfBook()
    {
        return $this->hasMany(Selfdrive::class, 'booking_id', 'id');

    }
}
