<?php

namespace App;

use App\Models\Office\Office;
use App\Models\Request\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable, Auditable, UserResolver
{
	use AuthenticableTrait;
	use \OwenIt\Auditing\Auditable;
	use Notifiable;
	
	protected $table  = 'users';
	protected $primaryKey = 'id';
	public $timestamps = true;

	/**
	 * Hides the following attributes when querying the model
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token'
	];

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'lastname', 'firstname', 'middlename', 'username', 'password', 'email', 'status', 'access' , ' position', 'prefix', 'suffix'
	];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
	protected $appends = [
		'accessName', 'full_name'
	];


	/**
	 * Different access level of the user
	 * in the system
	 *
	 * @var array
	 */
	public static $access_list = [
		"Administrator", "PSMO", "Accounting", "Offices", "Chief", "Director", "PSMO-Releasing", "PSMO-Accepting", "PSMO-Disposal"
	];

	/**
	 * Returns the full name attribute of the current 
	 * instantiated user. The fullname is the first and
	 * the last name of the user
	 *
	 * @return void
	 */
	public function getFullNameAttribute()
	{
		return $this->firstname . " " . $this->lastname;
	}

	/**
	 * Returns the equivalent name for the access of the
	 * current user
	 *
	 * @param int $value
	 * @return void
	 */
	public function getAccessNameAttribute(int $value)
	{
		return isset(self::$access_list[ $this->access ]) ? self::$access_list[ $this->access ] : 'Not Applicable';
	}
	
	/**
	 * Overrides the method to ignore the remember token.
	 *
	 * @param  $key
	 * @param  $value
	 * @return 
	 */
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if ( ! $isRememberTokenAttribute) {
			parent::setAttribute($key, $value);
		}
	}

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
	 * Fetch the office information where the user
	 * belongs to
	 *
	 * @return object
	 */
	public function office_information()
	{
		return $this->belongsTo(Office::class, 'office' ,'code');
	}

	/**
	 * Fetch the comments for the quest
	 *
	 * @return object
	 */
	public function request_comments()
    {
        return $this->hasMany(Comment::class);
    }

	/**
	 * Filters by the username of the office
	 *
	 * @param Builder $query
	 * @param string $username
	 * @return object
	 */
    public function scopeUsername($query, $username)
    {
    	$query->whereUsername($username);
	}
	
	/**
	 * Filters the query by office of the current authenticated
	 * user
	 *
	 * @param Builder $query
	 * @return object
	 */
	public function scopeOfficeOfCurrentAuthenticatedUser($query)
	{
		$query = Auth::user()->office;
		return $query->whereOffice($office);
	}

	/**
	 * Filters the query by access code of current authenticated user
	 *
	 * @param Builder $query
	 * @return object
	 */
	public function scopeAccessOfCurrentAuthenticatedUser($query)
	{
		$query = Auth::user()->office;
		return $query->whereOffice($office);
	}
}
