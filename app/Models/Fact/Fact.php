<?php

namespace App\Models\Fact;

use App\Models\User\User;
use App\Models\Fact\Solution;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    protected $table = 'facts';
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
        'title', 'description', 'upvote', 'reads', 'importance', 'user_id', 
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
     * Get the creator of the current fact
     *
     * @return object
     */
    public function getCreatedByAttribute()
    {
        return $this->creator->firstname . " " . $this->creator->lastname;
    }

    /**
     * Links to the creator of the current fact
     *
     * @return object
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Links to the available solutions for the fact
     *
     * @return object
     */
    public function solutions()
    {
        return $this->hasMany(Solution::class, 'fact_id', 'id');
    }
}
