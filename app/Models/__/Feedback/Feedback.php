<?php
namespace App\Models\Feedback;

use Illuminate\Database\Eloquent\Model;

class ClientFeedback extends Model
{
	protected $table = 'feedbacks';
	protected $primaryKey = 'id';
	public $timestamps = true;
	
    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
	protected $fillable = [
		'user', 'type', 'comment'
	];	
}

