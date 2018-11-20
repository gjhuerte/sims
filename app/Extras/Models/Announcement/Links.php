<?php

namespace App\Extras\Models\Announcement;

use App\Models\User\User;

trait Links 
{

    /**
     * Link to the user whose owner of the announcement
     *
     * @return object
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Links to the user who interacts with the announcement
     *
     * @return object
     */
    public function users()
    {
    	return $this->belongsToMany(User::class, 'announcement_user', 'user_id', 'announcement_id')
    			->withPivot(['is_read'])
    			->withTimestamps();
    }
}