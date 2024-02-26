<?php

namespace App\Models;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(Student::class, 'std_id');
    }

    // public function class()
    // {
    //     return $this->belongsTo(Classes::class, 'classes');
    // }

    // public function section()
    // {
    //     return $this->belongsTo(Section::class,'section');
    // }
}
