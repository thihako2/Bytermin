<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'image',
        'author_id',
        'next_link',
        'previous_link'
    ];
}
