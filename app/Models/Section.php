<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Student;
class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'class_id'
    ];

    // protected $with = [
    //     'class',
    // ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
