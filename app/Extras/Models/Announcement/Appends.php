<?php

namespace App\Extras\Models\Announcement;

trait Appends 
{

    /**
     * Get the creator of the current announcement
     *
     * @return object
     */
    public function getCreatedByAttribute()
    {
        return $this->creator->firstname . " " . $this->creator->lastname;
    }
}