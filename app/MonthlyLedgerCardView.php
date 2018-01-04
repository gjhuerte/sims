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
      $received = MonthlyLedgerCardView::findByStockNumber($this->stocknumber)->where('date','<',$this->date)->sum('received_quantity');
      $issued = MonthlyLedgerCardView::findByStockNumber($this->stocknumber)->where('date','<',$this->date)->sum('issued_quantity');
      $prev = $received - $issued;
  		$received = MonthlyLedgerCardView::findByStockNumber($this->stocknumber)->where('date','=',$this->date)->sum('received_quantity');
  		$issued = MonthlyLedgerCardView::findByStockNumber($this->stocknumber)->where('date','=',$this->date)->sum('issued_quantity');
  		return $prev + ($received - $issued); 
    }
}
