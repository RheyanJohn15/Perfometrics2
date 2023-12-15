<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTeacher extends Model
{
    use HasFactory;
    protected $table='tbl_assigned_teacher';
    protected $fillable=[
       'teacher_id',
       'subject_id',
       'grade_level',
       'section',
       'sem',
       'strand',
    ];
}
