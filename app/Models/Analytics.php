<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;
    protected $table= 'tbl_data_analytics';
    protected $fillable= [
        'evaluator_id',
        'evaluator_type',
        'teacher_id',
        'question_id',
        'evaluation_score',
        'evaluation_remarks',
        'evaluation_id',
    ];
}
