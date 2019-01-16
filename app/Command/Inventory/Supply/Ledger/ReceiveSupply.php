<?php

namespace App\Command\Inventory\Supply\Ledger;

class ReceiveSupply
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
		$firstname = Auth::user()->firstname;
		$middlename =  Auth::user()->middlename;
		$lastname = Auth::user()->lastname;
		$fullname =  $firstname . " " . $middlename . " " . $lastname;
		$purchaseorder = null;
		$supplier = null;

		$supply = Supply::findByStockNumber($this->stocknumber);
		$this->supply_id = $supply->id;

		if(isset($this->organization))
		{
			$supplier = Supplier::firstOrCreate([ 'name' => $this->organization ]);
		}

		if(isset($this->reference) && $this->reference != null && strpos($this->reference,'justment') != true)
		{
			$purchaseorder = PurchaseOrder::firstOrCreate([
				'number' => $this->reference
			], [
				'date_received' => Carbon\Carbon::parse($this->date),
				'supplier_id' => isset($supplier->id) ? $supplier->id : null
			]);


			/**
			 * uncomment this part
			 * if the ledger card can increment the supply content
			 */
			$supply_info = $purchaseorder->supplies()->find($supply->id);

			if(count($supply_info) > 0)
			{

				// $supply_info->pivot->ordered_quantity = (isset($supply_info->pivot->ordered_quantity) ? $supply_info->pivot->ordered_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->received_quantity = (isset($supply_info->pivot->received_quantity) ? $supply_info->pivot->received_quantity : 0 ) + $this->received_quantity;

				$supply_info->pivot->unitcost = $this->received_unitcost;

				$supply_info->pivot->save();

			} else {

				// $purchaseorder->supplies()->attach([
				// 	$supply->id => [
				// 		'ordered_quantity' =>  $this->received_quantity,
				// 		'remaining_quantity' => $this->received_quantity,
				// 		'received_quantity' =>  $this->received_quantity,
				// 	]
				// ]);

			}

			if(isset($this->fundcluster) &&  count(explode(",",$this->fundcluster)) > 0)
			{
				$purchaseorder->fundclusters()->detach();
				foreach(explode(",",$this->fundcluster) as $fundcluster)
				{
					$fundcluster = FundCluster::firstOrCreate( [ 'code' => $fundcluster ] );
					$fundcluster->purchaseorders()->attach($purchaseorder->id);

				}
			}

		}

		unset($supply_info);

		if(isset($this->receipt) && $this->receipt != null)
		{

			$receipt = Receipt::firstOrCreate([
				'number' => $this->receipt
			],[
				'purchaseorder_id' => (count($purchaseorder) > 0 && isset($purchaseorder->id)) ? $purchaseorder->id : null,
				'date_delivered' => Carbon\Carbon::parse($this->date),
				'received_by' => $fullname,
				'supplier_id' => isset($supplier->id) ? $supplier->id : null 

			]);

			$receipt->invoice = isset($this->invoice) ? $this->invoice : null;

			$receipt->save();

			$supply_info = $receipt->supplies()->find($supply->id);

			if(isset($supply_info) && count($supply_info) > 0)
			{

				// $supply_info->pivot->received_quantity = (isset($supply_info->pivot->received_quantity) ? $supply_info->pivot->received_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->remaining_quantity = (isset($supply_info->pivot->remaining_quantity) ? $supply_info->pivot->remaining_quantity : 0 ) + $this->received_quantity;

				// $supply_info->pivot->unitcost = (isset($supply_info->pivot->unitcost) ? $supply_info->pivot->unitcost : 0 ) + $this->unitcost;

				$supply_info->pivot->unitcost = $this->received_unitcost;

				$supply_info->pivot->save();

			} else {

				// $supply_info->supplies()->attach([
				// 	$supply->id => [
				// 		'quantity' =>  $this->received_quantity,
				// 		'remaining_quantity' => $this->received_quantity,
				// 		'unitcost' => $this->received_unitcost
				// 	]
				// ]);

			}
		}


		$this->created_by = $fullname;
		$this->setBalance();
		$this->save();
    }
}