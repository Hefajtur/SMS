<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Role;
use App\Models\Department;
use App\Models\Designation;
use App\Models\manageStaff\StaffRole;

class Userstaff extends Model
{
    use HasFactory;

    protected $table = 'userstaffs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'staffID',
        'role_id',
        'designation_id',
        'department_id',
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'email',
        'gender',
        'dob',
        'join_date',
        'phone',
        'emergency_contact',
        'marital_status',
        'status',
        'image',
        'current_add',
        'permanent_add',
        'status',
        'basic_salary',
        'doc_name',
        'doc_img',
    ];

    public function roles() {
        return $this->belongsTo(StaffRole::class, 'role_id');
    }

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designations() {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    // protected function status(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => ($value == 1) ? 'Active' : 'Inactive',
    //     );
    // }
}
