<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteStudent extends Model
{
    use HasFactory;
    protected $table = 'delete_tbl_student'; 
    protected $fillable = [
      'student_id',
      'student_password',
      'student_first_name',
      'student_middle_name',
      'student_last_name',
      'student_suffix',
      'student_year_level',
      'student_strand',
      'student_section',
      'student_mail',
      'student_image',
      'student_image_type',
      'student_status',
    ];
}
