<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_lenses_client extends Model
{
    use HasFactory;

    public function contact_lenses_exams() // metoda vraca sve preglede za kont.sociva klijenta
    {
        return $this->hasMany('App\Models\Contact_lenses_exam', 'contact_lenses_client_id');
    }
}
