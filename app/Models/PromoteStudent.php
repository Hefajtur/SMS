<?php

namespace App\Models;
use App\Models\Classes;
use App\Models\Section;
use App\Models\UserSession;
use App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoteStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'previous_class',
        'previous_section',
        'session',
        'promote_class',
        'promote_section',
        'student_id',

    ];


    public function class()
    {
        return $this->belongsTo(Classes::class, 'previous_class');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'previous_section');
    }

    public function session()
    {
        return $this->belongsTo(UserSession::class, 'session');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

//php artisan migrate:refresh --path=/database/migrations/2023_07_27_131521_create_promote_students_table.php



