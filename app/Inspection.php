<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'inspections';
    protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = [ 
		'date',
		'stocknumber',
		'reference',
		'receipt', 
		'received',
		'issued',
		'organization',
		'daystoconsume'
	]; 

	public static $inspectionRules = array(
		'Date' => 'required',
		'Stock Number' => 'required',
		'Purchase Order' => 'nullable',
		'Delivery Receipt' => 'nullable',
		'Office' => '',
		'Receipt Quantity' => 'required|integer',
		'Days To Consume' => 'max:100'
	);
}
