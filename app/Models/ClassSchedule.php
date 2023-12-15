<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $table= 'tbl_class_schedules';
    protected $fillable=[
     'sched_day',
     'sched_time',
     'sched_room',
     'sched_teacher',
     'sched_subject',
     'sched_class_name'
    ];
}
