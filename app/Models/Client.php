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


    public function dailyTurnovers()
    {
        return $this->hasMany(Daily_turnover::class);
    }

    public function glasses()
    {
        return $this->hasManyThrough(
            Stock::class,        // Модел наочара - Крајња табела (Stock)
            Daily_turnover::class, // Прелазна табела (Daily_turnover)
            'client_id',         // Страни кључ у Daily_turnover који повезује са Client
            'id',                // Примарни кључ у Stock табели
            'id',                // Примарни кључ у Client табели
            'stock_id'           // Страни кључ у Daily_turnover који повезује са Stock
            //Сада Laravel зна дa: Client је повезан са Daily_turnover преко client_id
                                    // Daily_turnover је повезан са Stock преко stock_id
        );
    }




}
