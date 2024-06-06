<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Feedback extends Model
{
    // use HasFactory;

    protected $fillable = [
        'book_id',
        'comment',
        'rating',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admincar()
    {
        return $this->belongsTo(Admincar::class, 'admincars_id', 'id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    public function ratebooking()
    {
        return $this->hasOne(Booking::class, 'book_id', 'id');
    }
    public function feedback()
    {
        return $this->belongsTo(Booking::class, 'book_id', 'id');
    }
    public function selfBook()
    {
        return $this->belongsTo(Selfdrive::class, 'book_id', 'id');
    }
}
