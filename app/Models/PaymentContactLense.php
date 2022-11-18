<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentContactLense extends Model
{
    use HasFactory;

    public function clientContactLense()
    {
        return $this->belongsTo(Contact_lenses_client::class);//this je samo placanje
    }
}
