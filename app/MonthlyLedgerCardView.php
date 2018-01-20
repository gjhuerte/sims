<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class MonthlyLedgerCardView extends Model
{
    protected $table = "monthlyledger_v";
    protected $dates = [
      'date'
    ];

  	protected $appends = [
  		'monthlybalancequantity', 'parsed_monthlybalancequantity', 'monthlyunitcost', 'parsed_monthlyunitcost', 'monthlytotalcost', 'parsed_monthlytotalcost',
      'reference_list', 
      'parsed_received_unitcost', 'parsed_received_total_cost', 'received_total_cost',
      'parsed_issued_unitcost', 'parsed_issued_total_cost', 'issued_total_cost'
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

    public function getParsedMonthlybalancequantityAttribute($value)
    {
      return number_format($this->monthlybalancequantity, 2); 
    }

    public function getMonthlyunitcostAttribute($value)
    {
      if($this->received_quantity > 0)
      {
        $total = $this->received_total_cost / $this->monthlybalancequantity;
      }
      else 
      {  
        $total = $this->received_unitcost;
      }

      return $total;

    }

    public function getParsedMonthlyunitcostAttribute($value)
    {
      return number_format($this->monthlyunitcost, 2);

    }

    public function getMonthlytotalcostAttribute($value)
    {  
      return $this->monthlybalancequantity * $this->monthlyunitcost;
    }

    public function getParsedMonthlytotalcostAttribute($value)
    {
      $total = $this->monthlytotalcost;
      return number_format($total, 2);
    }

    public function getReferenceListAttribute($value)
    {
      $date = Carbon\Carbon::parse($this->date);
      $ledgercard = LedgerCard::whereBetween('date', [ $date->startOfMonth()->format('Y-m-d') , $date->endOfMonth()->format('Y-m-d') ])->where('received_quantity', '>' , 0)->pluck('reference')->unique();
      return implode($ledgercard->toArray(), ", ");
    }

    public function getParsedReceivedUnitcostAttribute($value)
    {
      return number_format($this->received_unitcost, 2);
    }

    public function getParsedIssuedUnitcostAttribute($value)
    {
      return number_format($this->issued_unitcost, 2);
    }

    public function getParsedIssuedTotalCostAttribute($value)
    {
      $total = $this->issued_quantity * $this->issued_unitcost;
      return number_format($total, 2);
    }

    public function getIssuedTotalCostAttribute($value)
    {
      $total = $this->issued_quantity * $this->issued_unitcost;
      return $total;
    }

    public function getReceivedTotalCostAttribute($value)
    {
      $total = $this->received_quantity * $this->received_unitcost;
      return $total;
    }

    public function getParsedReceivedTotalCostAttribute($value)
    {
      $total = $this->received_quantity * $this->received_unitcost;
      return number_format($total, 2);
    }
}
