<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\Type;
class Master extends Model
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
    public function groups(){

      return $this->belongsTo(Group::class,'group_id');
      
    }

    public function types(){

        return $this->belongsTo(Type::class,'type_id');
      }

      public function assigns()
    {
        return $this->belongsTo(Assign::class, 'group_id', 'id');
    }

}
