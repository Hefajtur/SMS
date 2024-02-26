<?php

namespace App\Models;

use App\Models\onlineExam\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegister extends Model
{
    use HasFactory;
    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function exam(){
        return $this->belongsTo(ExamType::class,'exam_type');
    }
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function students(){
        return $this->belongsTo(Student::class,'student_id');
    }
}
