<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedSubject extends Model
{
    use HasFactory;
    protected $table='tbl_assigned_subject';
    protected $fillable=[
        'assigned_year_level',
        'assigned_strand',
        'assigned_subject',
        'assigned_sem',
    ];
}
