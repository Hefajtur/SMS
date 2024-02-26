<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Designation extends Model
{
    use HasFactory;

    protected function Status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ($value == 1) ? 'active' : 'inactive',
            // set: fn (string $value) => ($value == 'active') ? 1 : 0,
        );
    }
}
