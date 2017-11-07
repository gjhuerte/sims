<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Audit extends Model
{
    protected $table = 'audits';
    protected $id = 'id';
    public $timestamps = true;

    public $table_affected;
    public $column = null;
    public $action;
    public $initial = null;
    public $succeeding = null;
    public $details;

    function audit()
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
