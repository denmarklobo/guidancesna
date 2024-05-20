<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $primaryKey = 'exam_id';

    protected $fillable = [
        'exam_title',
        'exam_score',
        'exam_remarks',
        'exam_date',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];
}