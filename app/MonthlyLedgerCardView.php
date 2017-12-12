<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyLedgerCardView extends Model
{
    protected $table = "monthlyledger_v";

  	protected $appends = [
  		'monthlybalancequantity'
  	];

    public function scopeFindByStockNumber($query,$value)
    {
      return $query->where('stocknumber','=',$value);
    }

    public function getMonthlybalancequantityAttribute($value)
    {
  		$received = LedgerCard::findByStockNumber($this->stocknumber)->sum('receivedquantity');
  		$issued = LedgerCard::findByStockNumber($this->stocknumber)->sum('issuedquantity');
  		return $received - $issued; 
    }
}
