<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionVisit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'land_id', 'inspection_date', 'inspection_time'];

}
