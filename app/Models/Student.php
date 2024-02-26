<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Guardian;
use App\Models\StudentCategory;
use App\Models\BloodGroup;
use App\Models\Religion;
use App\Models\Gender;
use App\Models\SchoolSession;
use App\Models\StudentDocument;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no', 'roll_no', 'first_name',
        'last_name','mobile','email','class_id',
        'section_id','shift_id','b_date','religion',
        'gender','category_id','blood','admission_date',
        'image','parent','student_id', 'doc_name', 'document','status','session_id'
    ];

   
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function category()
    {
        return $this->belongsTo(StudentCategory::class, 'category_id');
    }

    public function bloods()
    {
        return $this->belongsTo(BloodGroup::class, 'blood');
    }

    public function religions()
    {
        return $this->belongsTo(Religion::class, 'religion');
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender');
    }

    public function guardians()
    {
        return $this->belongsTo(Guardian::class, 'parent');
    }

    public function session()
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'std_id', 'id');
    }

}
