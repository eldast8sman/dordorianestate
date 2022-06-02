<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['land_id', 'caption', 'filepath', 'compressed'];

    public function land(){
        return $this->belongsTo(Land::class);
    }
}
