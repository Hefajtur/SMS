<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Section;
use App\Models\TimeSchedule;
use App\Models\Subject;
use App\Models\ExamType;

class ExamRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'section_id',
        'type',
        'date',
        'subject_id',
        'time_schedule_id',
        'class_room_id',

    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function examtypes()
    {
        return $this->belongsTo(ExamType::class, 'type');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function timeschedule()
    {
        return $this->belongsTo(TimeSchedule::class, 'time_schedule_id');
    }

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }
}
