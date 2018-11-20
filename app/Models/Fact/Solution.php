<?php

namespace App\Models\Fact;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $table = 'solutions';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    public $fillable = [
        'title', 'description', 'user_id', 'fact_id'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
        'created_by'
    ];

    /**
     * Get the creator of the current solution
     *
     * @return object
     */
    public function getCreatedByAttribute()
    {
        return $this->creator->firstname . " " . $this->creator->lastname;
    }

    /**
     * Links to the creator of the current solution
     *
     * @return object
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
