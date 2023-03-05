<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtors_contact_lenses extends Model
{
    use HasFactory;

    public function paymentContactLenses()
    {
        return $this->hasMany(PaymentContactLense::class,'debtors_contact_lenses_id');

    }
}
