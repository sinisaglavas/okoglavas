<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_lenses_exam extends Model
{
    use HasFactory;

    public function contact_lenses_client()
    {
        return $this->belongsTo('App\Models\Contact_lenses_client');
    }
}
