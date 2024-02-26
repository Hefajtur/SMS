<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\library\MemberCategory;
use App\Models\User;
use App\Models\Gender;

class Member extends Model
{
    use HasFactory;


    public function memberCategory() {
        return $this->belongsTo(MemberCategory::class, 'member_category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function memberGender() {
        return $this->belongsTo(Gender::class, 'gender');
    }
}
