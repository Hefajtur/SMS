<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Session;

class Setting extends Model
{
    use HasFactory;

    public function session() {
        return $this->belongsTo(Session::class, '');
    }

    protected $fillable = [
        'general_setting',
        'storage_setting',
        'recaptcha_setting',
        'email_setting',
    ];

    // protected function generalSetting(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }
}
