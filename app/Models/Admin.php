<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table= 'tbl_admin';
    protected $fillable = [
      'admin_username',
      'admin_password',
      'admin_type',
      'admin_first_name',
      'admin_last_name',
      'admin_middle_name',
      'admin_suffix', 
      'admin_type',
      'admin_image',
      'admin_image_type',
      'admin_sem',
      'admin_evaluation_status',
      'admin_evaluation_schedule',
      'admin_sy',
      'student_weight',
      'coordinator_weight',
      'backup'
    ];
}
