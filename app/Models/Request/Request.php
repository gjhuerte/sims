<?php

namespace App\Models\Request;

use Carbon\Carbon;
use App\Models\User\User;
use App\Models\Request\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Supply\Supply;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;

class Request extends Model implements Auditable, UserResolver
{
    use \OwenIt\Auditing\Auditable;

    const NO_REMARKS = 'No Remarks';
    const PENDING_STATUS = 'Pending';
    const APPROVED_STATUS = 'Approved';
    const DISAPPROVED_STATUS = 'Disapproved';
    const RELEASED_STATUS = 'Released';

    protected $table = 'requests';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    public $expire_before = 3;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    protected $fillable = [ 
        'local', 'requestor_id', 'office_id', 'issued_by', 'remarks', 'purpose', 'status' 
    ];

    /**
     * List of all the status of the request
     *
     * @var array
     */
    public static $status_list = [
        0 => 'pending',
        1 => 'approved',
        2 => 'disapproved',
        3 => 'resubmission',
        4 => 'cancelled',
        5 => 'released'
    ]; 

    /**
     * The following are fields included in
     * auditing
     *
     * @var array
     */
    protected $auditInclude = [ 
        'local' , 'requestor_id', 'office_id', 'issued_by', 'remarks', 'purpose', 'status' 
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
    
    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    public $appends = [
        'code', 'date_requested', 'remaining_days', 'expire_on'
    ];

    /**
     * Checks the nearest expiration date for the request
     *
     * @return object
     */
    public function getExpireOnAttribute()
    {
        if (isset($this->approved_at)) {
            return Carbon::parse($this->approved_at)->toFormattedDateString();
        }

        return 'No Approval';
    }

    /**
     * Get the remaining days before the request will expire
     *
     * @return object
     */
    public function getRemainingDaysAttribute()
    {
        $approvedAtDate = Carbon::parse($this->approved_at);
        $currentDate = Carbon::now();

        // if the approval is not yet set
        // returns no approval status
        if($this->approved_at == null)  {
          return 'No Approval';
        }

        // if the approval and released at is set
        // return released
        if(isset($this->approved_at, $this->released_at)) {
          return 'Released';
        }

        // if the status is cancelled, return the 
        // cancelled status
        if(ucfirst($this->status) == 'Cancelled')  {
          return 'Cancelled';
        }

        // if the status is disapproved, returns the 
        // disapproved status
        if(ucfirst($this->status) == 'Disapproved') {
          return 'Disapproved';
        }
        
        return $approvedAtDate->diffInDays($currentDate);

    }

    /**
     * Generates code for the request
     *
     * @return string
     */
    public function getCodeAttribute()
    {

      if(isset($this->local)) {
          return $this->local;
      }

      $requestCount = $this->id;
      switch(strlen($requestCount)) {

          // if the request id is a one digit
          // appends triple zero to the request 
          // code
          case 1:
              $zeroCount = '000';
              break;

          // if the request id is a one digit
          // appends double zero to the request 
          // code
          case 2:
              $zeroCount = '00';
              break;

          // if the request id is a one digit
          // appends single zero to the request 
          // code
          case 3:
              $zeroCount = '0';
              break;
          
          // if the request id is a one digit 
          // returns the code
          default:
              $zeroCount = '';
              break;
      }

      $createdDate = Carbon::parse($this->created_at);
      return $createdDate->format('y') . ' ' . $createdDate->format('m') . ' ' . $zeroCount . $requestCount;
    }

    /**
     * Checks the status for remarks if its already set
     * if its not set, returns no remarks
     *
     * @param  $value
     * @return string
     */
    public function getRemarksAttribute($value)
    {
      return isset($value) ? $value : self::NO_REMARKS;
    }

    /**
     * Returns the status for the this request
     *
     * @param  $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return isset($value) ? ucfirst($value) : self::PENDING_STATUS;
    }

    /**
     * Filters the request by status
     *
     * @param Builder $query
     * @param string|array $value
     * @return object
     */
    public function scopeStatus($query, $value)
    {
        if(is_array($value)) {
            return $query->whereIn('status', $value);
        }

        return $query->where('status', '=', $value);
    }

    /**
     * Filters the request by status
     *
     * @param Builder $query
     * @param string|array $value
     * @return object
     */
    public function scopeOrStatus($query, $value)
    {
        if(is_array($value)) {
            return $query->orWhereIn('status', $value);
        }

        return $query->orWhere('status', '=', $value);
    }

    /**
     * Filters the query where the status is pending
     *
     * @param Builder $query
     * @return object
     */
    public function scopePending($query)
    {
        return $query->whereNull('status')->orStatus(self::PENDING_STATUS);
    }

    /**
     * Filters the query where the status is 
     * approved
     *
     * @param Builder $query
     * @return object
     */
    public function scopeApproved($query)
    {
        return $query->status(self::APPROVED_STATUS);
    }

    /**
     * Filters the query where the status is 
     * released
     *
     * @param Builder $query
     * @return object
     */
    public function scopeReleased($query)
    {
        return $query->status(self::RELEASED_STATUS);
    }

    /**
     * Filters the query where the requestor is the current authenticated user
     *
     * @param Builder $query
     * @return object
     */
    public function scopeRequestorAsCurrentAuthenticatedUser($query)
    {
        return $query->where('requestor_id', '=', Auth::user()->id);
    }

    /**
     * Returns the count of the selected model
     *
     * @return void
     */
    public function scopeSelectCount()
    {
        return $query->select(DB::raw('count(id) AS count'));
    }

    /**
     * Filters the query by office code
     *
     * @param Builder $query
     * @param string $code
     * @return object
     */
    public function scopeByOfficeCode($query, string $code)
    {
        return $query->whereHas('office', function($query) use ($code) {
            $query->whereCode($code);
        });
    }

    /**
     * Get the date when the request was created
     *
     * @return string
     */
    public function getDateRequestedAttribute()
    {
        return Carbon\Carbon::parse($this->created_at)->format("F d Y h:m A");
    }

    /**
     * Links to the supplies of the request
     *
     * @return void
     */
  	public function supplies()
  	{
        return $this->belongsToMany(
            Supply::class,'requests_supplies', 'request_id', 'supply_id'
        )
        ->withPivot('quantity_requested', 'quantity_issued', 'quantity_released', 'comments')
        ->withTimestamps();
  	}

    /**
     * Link to the requestor model
     *
     * @return object
     */
    public function requestor()
    {
        return $this->belongsTo(User::class, 'requestor_id', 'id');
    }

    /**
     * Link to the office model
     *
     * @return object
     */
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    /**
     * Link to the comment model
     *
     * @return object
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
     
}