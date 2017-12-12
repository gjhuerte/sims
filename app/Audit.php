<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Audit extends Model
{
    protected $table = 'audits';
    protected $id = 'id';
    public $timestamps = true;

    protected $fillable = [
        'table_affected',
        'column',
        'action',
        'user',
        'initial',
        'details'
    ];

    public function createRecord()
    {

    	//...

    	$user = Auth::user()->firstname . " " . Auth::user()->middlename . " " . Auth::user()->lastname; 

    	//...

    	$audit = new Audit;
    	$audit->table_affected = $this->table_affected;
    	$audit->column = $this->column;
    	$audit->action = $this->action;
    	$audit->user = $user;
    	$audit->initial = $this->initial;
    	$audit->details = $this->details;
    	$audit->save();
    }

}
