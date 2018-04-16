<?php

namespace App;

use Auth;
use Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;

class Request extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable; 

    protected $auditInclude = [ 
      'local' , 
      'requestor_id' , 
      'office_id' ,
      'issued_by' , 
      'remarks'  , 
      'purpose'  , 
      'status' 
    ]; 
  
  /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    protected $table = 'requests';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    public $expire_before = 3;
    protected $fillable = [ 
      'local' , 
      'requestor_id' , 
      'office_id' ,
      'issued_by' , 
      'remarks'  , 
      'purpose'  , 
      'status' 
    ];

    public static $status_list = [
      0 => 'pending',
      1 => 'approved',
      2 => 'disapproved',
      3 => 'resubmission',
      4 => 'cancelled',
      5 => 'released'
    ];

    public function updateRules(){
      return [
        'Stock Number' => 'required|exists:supplies,stocknumber',
        'Quantity' => 'required|integer|min:1',
        'Purpose' => 'required',
      ];
    }

    public function approveRules(){
      return [
        'Stock Number' => 'required|exists:supplies,stocknumber',
        'Quantity' => 'required|integer|min:0',
      ];
    }
    
    public static $issueRules = array(
      'Stock Number' => 'required|exists:supplies,stocknumber',
      'Quantity' => 'required|integer|min:1',
      'Purpose' => 'required',
    );

    public static $releaseRules = array(
      'Remarks' => 'required',
    );

    public static $cancelRules = array(
      'Details' => 'required',
    );

    public function commentsRules(){
      return [
        'Details' => 'required|max:100'
      ];
    }
    
    public $appends = [
      'code', 'date_requested', 'remaining_days', 'expire_on'
    ];

    public function getExpireOnAttribute()
    {
      if( $this->approved_at == null ) return 'No Approval';

      return Carbon\Carbon::parse($this->approved_at)->toFormattedDateString();
    }

    public function getRemainingDaysAttribute()
    {
      if($this->approved_at == null)  return 'No Approval';
      if($this->approved_at != null && $this->released_at != null)  return 'Released';
      if(ucfirst($this->status) == 'Cancelled')  return 'Cancelled';
      if(ucfirst($this->status) == 'Disapproved')  return 'Disapproved';
      
      $approved_date = Carbon\Carbon::parse($this->approved_at);
      $date = Carbon\Carbon::now();
      
      return $approved_date->diffInDays($date);

    }

    public function getRemarksAttribute($value)
    {

      if($value == null) return 'No Remarks'; 

      return $value;
    }

    public function getStatusAttribute($value)
    {
      if($value == null) return 'Pending';

      return ucfirst($value);
    }

    public function scopeFilterByStatus($query, $value)
    {
        is_array($value) ? $query->whereIn('status', $value) : $query->where('status', '=', $value);
    }

    public function scopePending($query)
    {
      return $query->whereNull('status')->orWhere('status', '=', 'Pending');
    }

    public function scopefilterByOfficeId($query, $value)
    {
      $query->where('office_id', '=', $value);
    }

    public function scopefilterByOfficeCode($query, $value)
    {
      $query->whereHas('office', function($query) use ($value){
        $query->where('code', '=', $value);
      });
    }

    public function getCodeAttribute($value)
    {
      $date = Carbon\Carbon::parse($this->created_at);
      if(isset($this->local))
        $requestcode = $this->local;
      else{
      if (strlen($this->id) == 1) 
        $requestcode =  '00'.$this->id;
      elseif (strlen($this->id) == 2) 
        $requestcode =  '0'.$this->id;
      elseif (strlen($this->id) == 3) 
        $requestcode =  $this->id;
      else
        $requestcode =  $this->id;
      }
      if(isset($this->local))
      return $requestcode;
      else
      return $date->format('y') . '-' .  $date->format('m') . '-' .  $requestcode;

    }

    public function getDateRequestedAttribute($value)
    {
      return Carbon\Carbon::parse($this->created_at)->format("F d Y h:m A");
    }

  	public function supplies()
  	{
  		return $this->belongsToMany('App\Supply','requests_supplies', 'request_id', 'supply_id')
            ->withPivot('quantity_requested', 'quantity_issued', 'quantity_released', 'comments')
            ->withTimestamps();
  	}

    public function requestor()
    {
      return $this->belongsTo('App\User','requestor_id','id');
    }

    public function office()
    {
      return $this->belongsTo('App\Office','office_id','id');
    }

    public function scopeMe($query)
    {
      return $query->where('requestor_id','=',Auth::user()->id);
    }

    public function scopeFindByOffice($query,$value)
    {
      return $query->whereHas('office',function($query) use ($value){
        $query->where('code', '=', $value);
      });
    }

    public function comments()
    {
      return $this->hasMany('App\RequestComments');
    }
     
}