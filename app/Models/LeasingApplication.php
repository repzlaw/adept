<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeasingApplication extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // relationship
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function supplier(){
        return $this->hasOne(Supplier::class);
    }
    public function transaction(){
        return $this->hasMany(PaymentTransaction::class);
    }
    public function payment_plan(){
        return $this->hasOne(PaymentPlan::class);
    }

}
