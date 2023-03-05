<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function distances() // metoda vraca sve preglede za daljinu klijenta
    {
        return $this->hasMany(Distance::class,'client_id');
    }


    public function proximities() // metoda vraca sve preglede za blizinu klijenta
    {
        return $this->hasMany(Proximity::class,'client_id');
    }




}
