<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    protected $table = 'requests_signatories';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The dates attribute for the table
     * The following array will set the items
     * inside as date
     *
     * @var array
     */
 	protected $dates = [
         'created_at', 'updated_at'
    ];
    
    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    protected $fillable = [
        'requests_id', 'requestor_name', 'requestor_designation', 'approver_name', 'approver_designation'
    ];

}
