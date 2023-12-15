<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table= 'tbl_section';
    protected $fillable= [
        'section',
        'strand_id',
        'year_level'
    ];
}
