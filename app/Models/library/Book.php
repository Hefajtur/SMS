<?php

namespace App\Models\library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\library\BookCategory;

class Book extends Model
{
    use HasFactory;

    public function BookCategory()
    {
        return $this->belongsTo(BookCategory::class);
    }
}
