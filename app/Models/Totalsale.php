<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totalsale extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'month',
        'booked_id',
        'total',
    ];
}
