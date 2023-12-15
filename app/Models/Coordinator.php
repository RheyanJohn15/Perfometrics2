<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;
    protected $table= 'tbl_coordinator';
    protected $fillable=[
        'coordinator_username',
        'coordinator_password',
        'coordinator_first_name',
        'coordinator_middle_name',
        'coordinator_last_name',
        'coordinator_suffix',
        'coordinator_position',
        'coordinator_mail',
        'coordinator_image',
        'coordinator_image_type',
        'coordinator_status',
    ];
}
