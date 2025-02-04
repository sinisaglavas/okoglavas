<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function dailyTurnovers()
    {
        return $this->hasMany(Daily_turnover::class);
    }
}




