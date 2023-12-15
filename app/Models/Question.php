<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table= 'tbl_question';
    protected $fillable= [
     'question_content',
     'question_criteria',
    ];
}
