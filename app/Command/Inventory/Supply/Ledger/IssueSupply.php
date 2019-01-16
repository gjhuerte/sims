<?php

namespace App\Command\Inventory\Supply\Ledger;

class IssueSupply
{

    /**
     * Constructor class
     */
    public function __construct()
    {

    }

    /**
     * Handles the command
     *
     * @return void
     */
    public function hande()
    {
		$fullname =  Auth::user()->full_name;
		$issued = $this->issued_quantity;

		$supply = Supply::findByStockNumber($this->stocknumber);
		$this->supply_id = $supply->id;

		$supplies = $supply->receipts->each(function($item, $key) use($supply) {
			if($item->pivot->remaining_quantity <= 0) $supply->receipts->forget($key);
		});

		if(count($supplies) > 0)
		{

			/**
			 *	loops through each record
			 *	reduce the issued for each record
			 *	
			 */
			$supplies->each(function($item, $value) use ($supply) 
			{

				/**
				 * if the supply has issued quantity
				 * perform the functions below
				 */
				if($this->issued_quantity > 0)
				{

					/**
					 * if the remaining quantity of an item is greater than the issued quantity
					 * reduce the remaining quantity and set the issued balance to zero(0)
					 */
					if($item->pivot->remaining_quantity >= $this->issued_quantity)
					{
						$item->pivot->remaining_quantity = $item->pivot->remaining_quantity - $this->issued_quantity;
						$this->issued_quantity = 0;
					}

					/**
					 * if the remaining quantity is less than the issued quantity
					 * set the remaining quantity as zero(0)
					 * set the issued balance to zero(0)
					 */
					else
					{
						$this->issued_quantity = $this->issued_quantity - $item->pivot->remaining_quantity;
						$item->pivot->remaining_quantity = 0;
					}

					$item->pivot->save();
				}
			});
		}


		/**
		 * [$this->issued_quantity description]
		 * reassign the backup to issued quantity column
		 * @var [type]
		 */
		$this->issued_quantity = $issued;
		$this->setBalance();
		$this->save();
    }
}