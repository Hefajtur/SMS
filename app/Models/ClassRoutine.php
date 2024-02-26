<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\Day;
use App\Models\TimeSchedule;
use App\Models\ClassRoom;

class ClassRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'section_id',
        'shift_id',
        'day',
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

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function days()
    {
        return $this->belongsTo(Day::class, 'day');
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
