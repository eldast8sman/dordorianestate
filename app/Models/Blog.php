<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['heading', 'subheading', 'blog_date', 'body', 'filepath', 'compressed', 'author'];
}
