<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LedgerView extends Model
{
    protected $table = 'ledger_view';

	public $timestamps = false;

	public function scopeStockNumber($query,$value)
	{
		return $query->where('stocknumber','=',$value);
	}
}
