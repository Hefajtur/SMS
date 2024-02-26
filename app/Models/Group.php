<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
class Group extends Model
{
    use HasFactory;

    // public function getStatusAttribute($value)
    // {
    //     if ($value == 0) {
    //         return "Inactive";
    //     } else {
    //         return "Active";
    //     }
    // }
}
