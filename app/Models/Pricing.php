<?php

namespace App\Models;

use App\Traits\PricingRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory, PricingRelations;


    protected $guarded = ['id', 'user_id'];


    public function therapyFee()
    {
        return $this->fee * 100 * $this->user->roster->durationHours();
    }

    public function therapyFeeUSD()
    {
        return $this->therapyFee() / 100;
    }

    public function therapistReceives()
    {
        return ($this->therapyFee() - $this->platformCommission()) / 100;
    }

    public function transferAmount()
    {
        return $this->therapyFee();
    }

    public function platformCommission()
    {
        return $this->therapyFee() * env('PLATFORM_COMMISSION') / 100;
    }

    public function platformCommissionUSD()
    {
        return $this->platformCommission() / 100;
    }

}
