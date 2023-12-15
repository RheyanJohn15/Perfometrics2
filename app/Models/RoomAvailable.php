<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAvailable extends Model
{
    use HasFactory;
    protected $table= "tbl_room_available";
    protected $fillable=[
        'room_id',
        'room_day',
        '7:30AM - 8:30AM',
        '8:30AM - 9:30AM',
        '9:45AM - 10:45AM',
        '10:45AM - 11:45AM',
        '1:00PM - 2:00PM',
        '2:00PM - 3:00PM',
        '3:00PM - 4:00PM',
        '4:00PM - 5:00PM'
    ];
}
