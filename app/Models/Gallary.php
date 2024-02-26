<?php

namespace App\Models;
use App\Models\GallaryCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    use HasFactory;

    protected $fillable=['gallary_category_id','image','status'];

    public function gallaryCategory()
    {
        return $this->belongsTo(GallaryCategory::class, 'gallary_category_id');
    }
}
