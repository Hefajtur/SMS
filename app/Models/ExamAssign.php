<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Section;
use App\Models\ExamType;
use App\Models\Subject;

class ExamAssign extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'marks_title' => 'array',
    // ];

    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function exam(){
        return $this->belongsTo(ExamType::class,'exam_type');
    }
   
    public function parents(){
        return $this->hasMany(ExamAssignData::class, 'assign_id');
    }
 
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
