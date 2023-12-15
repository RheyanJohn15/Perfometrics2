<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedEvaluation extends Model
{
    use HasFactory;

    protected $table= 'tbl_saved_evaluation';
    protected $fillable= [
      'evaluation_name',
      'evaluation_sem', 
      'evaluation_year',
      'saved_status',
    ];
}
