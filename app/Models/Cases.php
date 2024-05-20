<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student_Profilings;


class Cases extends Model
{
    use HasFactory;

    protected $primaryKey = 'cases_id';

    protected $fillable = [
        'case_title',
        'case_description',
        'case_sanction',
        'case_status',
        'case_date',
    ];


    public function student(){
        return  $this->hasOne(Student_Profilings::class, 'student_id');
    }
}