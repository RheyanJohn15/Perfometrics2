<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table= 'tbl_teacher';
    protected $fillable= [
      'teacher_username',
      'teacher_password',
      'teacher_first_name',
      'teacher_middle_name',
      'teacher_last_name',
      'teacher_suffix',
      'teacher_mail',
      'teacher_image',
      'teacher_image_type',
      'teacher_status',
    ];
}
