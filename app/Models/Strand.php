<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    use HasFactory;

    protected $table= 'tbl_strand';
    protected $fillable=[
          'strand_name',
          'strand_shortcut',
    ];
}
