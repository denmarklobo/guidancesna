<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasesLog extends Model
{
    protected $fillable = ['student_id', 'cases_id'];

    // Define the relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function cases()
    {
        return $this->belongsTo(Cases::class);
    }
}
