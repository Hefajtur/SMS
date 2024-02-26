<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class IssueBook extends Model
{
    use HasFactory;
    

    public function users()
    {
        return $this->belongsTo(User::class, 'issue_book_member');
    }

    public function members()
    {
        return $this->belongsTo(User::class, 'issue_book_member');
    }

    public function books()
    {
        return $this->belongsTo(Book::class, 'issue_book');
    }


}
