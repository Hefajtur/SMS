<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignData extends Model
{
    use HasFactory;


    public function students()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
 
    public function masters()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    // public function students()
    // {
    //     return $this->belongsTo(Student::class);
    // }



    public function assign()
    {
        return $this->belongsTo(Assign::class, 'assign_id', 'id');
    }

    
}
