<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestSignatory extends Model
{
    protected $table = 'requests_signatories';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
 	protected $dates = ['created_at','updated_at'];
    protected $fillable = ['requests_id','requestor_name','requestor_designation','approver_name','approver_designation'];

}
