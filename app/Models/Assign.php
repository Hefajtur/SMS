<?php

namespace App\Models;

use App\Models\StudentCategory;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Group;
use App\Models\Master;
use App\Models\Student;
use App\Models\Type;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function category()
    {
        return $this->belongsTo(StudentCategory::class, 'category_id');
    }

    public function guardians()
    {
        return $this->belongsTo(Guardian::class, 'parent');
    }


    public function assigndata(){
        return $this->hasMany('App\Models\AssignData', 'assign_id');
    }


    // public function masters()
    // {
    //     return $this->hasMany(Master::class);
    // }
}