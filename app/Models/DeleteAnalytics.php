<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteAnalytics extends Model
{
    use HasFactory;
    protected $table= 'delete_tbl_data_analytics';
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
