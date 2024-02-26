<?php

namespace App\Models\onlineExam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExamStdList extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
