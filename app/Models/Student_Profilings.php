<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Profilings extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id'; // Set the primary key
    protected $table= 'student_profilings';

    public $incrementing = false; // Ensure Laravel doesn't assume ID is auto-incrementing

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate custom primary key
            $year = date('Y');
            $randomDigits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT); // Random 4 digits
            $studentID = $year . $randomDigits;

            $model->student_id = $studentID;
        });
    }

    protected $fillable = [
        'student_id',
        'student_lrn',
        'first_name',
        'last_name',
        'middle_name',
        'extension',
        'email',
        'birth_date',
        'birth_place',
        'civil_status',
        'sex_at_birth',
        'citizenship',
        'religion',
        'region',
        'province',
        'city',
        'barangay',
        'street',
        'zip_code',
    ];

}