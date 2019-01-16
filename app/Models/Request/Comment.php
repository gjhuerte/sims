<?php

namespace App\Models\Request;

use App\Models\User\User;
use App\Models\Request\Request;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'requests_comments';
    protected $primaryKey = 'id';
    public $incrementing = true;
	public $timestamps = true;
	
    /**
     * Sets the following items as date
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
		'details', 'requests_id', 'comment_by'
	];

	/**
	 * Link to the request where this comment belongs to
	 *
	 * @return object
	 */
   	public function request()
	{
	    return $this->belongsTo(Request::class);
	}

	/**
	 * Link to the user where this comment belongs to
	 *
	 * @return object
	 */
	public function author()
	{
	    return $this->belongsTo(User::class, 'user_id','id');
	}

}
