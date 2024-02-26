<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Role;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'module_name',
        'permissions',
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
