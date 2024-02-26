<?php

namespace App\Models\religion;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    protected $table = 'religions';
    protected $primaryKey = 'id';


    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ($value == 1) ? 'Active' : 'Inactive',
        );
    }

    
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value)
        );
    }
}
