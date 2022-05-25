<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Land extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['slug', 'state', 'lga', 'area', 'description', 'facilities', 'size', 'available_plots', 'price'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['state', 'lga', 'area'])
            ->saveSlugsTo('slug');
    }
}
