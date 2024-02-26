<?php

namespace App\Models\manageStaff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;


    protected $fillable = [
        'role_id',
        'module_name',
        'permissions',
    ];

    public function staffrole() {
        return $this->belongsTo(StaffRole::class, 'role_id', 'id');
    }
}
