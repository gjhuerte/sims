<?php
namespace App;

use App\Models\Inventory\Supply\Supply;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;

class Ledger extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'ledgercards';
	protected $primaryKey = 'id';
	public $timestamps = true;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'user_id', 'date', 'stocknumber', 'reference', 'receipt_quantity', 'receipt_unitcost', 'issue_quantity', 'issue_unitcost', 'daystoconsume',
	];

    /**
     * The following are fields included in
     * auditing
     *
     * @var array
     */
	protected $auditInclude = [
		'date', 'stocknumber', 'reference', 'receipt_quantity', 'receipt_unitcost', 'issue_quantity', 'issue_unitcost', 'daystoconsume',
	];

	/**
	 * {@inheritdoc}
	 *
	 * @return
	 */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

	// public function setDaystoconsumeAttribute($value)
	// {
	// 	$daystoconsume = isset($this->attributes['daystoconsume']) ? $this->attributes['daystoconsume'] : null;

	// 	if($daystoconsume == '' || $daystoconsume == null):

	// 		if(isset($this->attributes['received_quantity']) && $this->attributes['received_quantity'] > 0):
	// 			$daystoconsume = 'Not Applicable';
	// 		else:
	// 			$daystoconsume = 90;
	// 		endif;

	// 	endif;

	// 	$this->attributes['daystoconsume'] = $daystoconsume;
	// }

	/**
	 * [setBalance description]
	 * update the current records balance
	 */
	// public function setBalanceFrom()
	// {
		
	// 	$ledger = Ledger::stockNumber($this->stocknumber)->orderBy('id', 'desc')->first();

	// 	$ledgerRemainingBalance = isset($ledger->balance_quantity) ? $ledger->balance_quantity : 0;
	// 	$issued = isset($this->issued_quantity) ? $this->issued_quantity  : 0 ;
	// 	$received = isset($this->received_quantity) ? $this->received_quantity : 0;

	// 	$this->balance_quantity = 0;
	// 	$this->balance_quantity = $balance + ($received - $issued);
	// }

	/**
	 * Filter the record by the reference
	 *
	 * @param Builder $query
	 * @param string $reference
	 * @return object
	 */
	public function scopeReference($query, $reference)
	{
		return $query->where('reference' ,'=', $reference);
	}

	/**
	 * Filter the record by the stock number
	 *
	 * @param Builder $query
	 * @param string $reference
	 * @return object
	 */
	public function scopeStockNumber($query, $stocknumber)
	{
		return $query->whereHas('supply', function($query) use($stocknumber) {
			$query->where('stocknumber', '=', $stocknumber);
		});
	}

	/**
	 * Link to the supply class
	 *
	 * @return object
	 */
	public function supply()
	{
		return $this->belongsTo(Supply::class, 'supply_id', 'id');
	}

	// public function scopeFindBySupplyId($query,$stocknumber)
	// {
	// 	return $query->where('supply_id','=',$stocknumber);
	// }

	// public function scopeFilterByMonth($query,$month)
	// {
	// 	$month = Carbon\Carbon::parse($month);
	// 	return $query->whereBetween('date',[
	// 			$month->startOfMonth()->toDateString(),
	// 			$month->endOfMonth()->toDateString()
	// 		]);
	// }

	/**
	 * Filters the record where the issued quantity
	 * is greater than zero
	 *
	 * @param Builder $query
	 * @return void
	 */
	public function scopeIssuedIsGreaterThanZero($query)
	{
		return $query->where('issued_quantity', '>', 0);
	}
	
}
