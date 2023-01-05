<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    use HasFactory;

    protected $table = 'bond';
    protected $guarded = ['id'];


    public function getPeriodAttribute()
    {

        if($this->attributes['interest_accrual_period'] ==360)
            return  12 / $this->attributes['coupon_payment_frequency'] * 30;
        if($this->attributes['interest_accrual_period'] ==364 )
            return  364 / $this->attributes['coupon_payment_frequency'];
        if($this->attributes['interest_accrual_period'] ==365 )
            return  12 / $this->attributes['coupon_payment_frequency'];
    }

    public function getPercentAttribute(){
        return
            $this->attributes['nominal_price'] / 100 *
            $this->attributes['coupon_rate']  / $this->attributes['interest_accrual_period'];
    }
}
