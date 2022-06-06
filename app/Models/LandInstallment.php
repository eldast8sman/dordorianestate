<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandInstallment extends Model
{
    use HasFactory;

    protected $fillable = ['land_id', 'duration_type', 'duration', 'percentage'];

    public function land(){
        return $this->belongsTo(Land::class);
    }
}
