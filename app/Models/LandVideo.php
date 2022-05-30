<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandVideo extends Model
{
    use HasFactory;

    protected $fillable = ['land_id', 'platform', 'caption', 'link'];

    public function land(){
        return $this->belongsTo(Land::class);
    }
}
