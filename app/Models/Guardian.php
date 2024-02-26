<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'fath_name', 'fath_mobile', 'fath_prof',
        'fath_img','mother_name','mother_mobile','mother_prof',
        'mother_img','guard_name','guard_mobile','guard_prof',
        'guard_img','guard_email','guard_address','guard_rel',
        'guard_status'
    ];
}
