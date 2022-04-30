<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    public $table = 'payment_transactions';
    protected $guarded = [];

    public function transaction(){
        return $this->belongsTo(LeasingApplication::class);
    }
}