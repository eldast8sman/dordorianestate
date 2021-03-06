<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Land extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['slug', 'state', 'lga', 'area', 'description', 'facilities', 'size', 'available_plots', 'price', 'filepath'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['state', 'lga', 'area'])
            ->saveSlugsTo('slug');
    }

    public function inspectionVisits(){
        return $this->hasMany(InspectionVisit::class);
    }

    public function landVideos(){
        return $this->hasMany(LandVideo::class);
    }

    public function landPhotos(){
        return $this->hasMany(LandPhoto::class);
    }

    public function installments(){
        return $this->hasMany(LandInstallment::class);
    }
}
