<?php

namespace App\Models\manageStaff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;

    public function rolepermission() {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }
}
