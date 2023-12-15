<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    use HasFactory;
    protected $table= 'tbl_evaluation_result';
    protected $fillable= [
       'evaluator_id',
       'evaluator_type',
       'teacher_id',
       'question_id',
       'evaluation_score',
       'evaluation_remarks',
    ];
}
