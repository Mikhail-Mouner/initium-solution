<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Room extends Model
{
    use HasFactory;
    protected $fillable = ['booking_id', 'room_id'];
    protected $table = 'booking_rooms';
    public $timestamps = false;
}
