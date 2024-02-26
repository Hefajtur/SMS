<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Guardian;

class DisableStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'section_id',
        'student_id',

    ];


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function guardians()
    {
        return $this->belongsTo(Guardian::class, 'parent');
    }


}
