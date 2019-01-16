<?php

namespace App\Extras\Models\Announcement;

trait Access 
{

    /**
     * Fetch all the list of available access
     *
     * @return object
     */
    public function getAllAvailableAccess()
    {
        return [
            self::ADMINISTRATOR,
            self::ASSETS_MANAGEMENT,
            self::ACCOUNTING,
            self::OFFICES,
            self::ALL
        ];
    }

    /**
     * Checks if the access is in the available access list
     * if its in the available access list, returns true
     * else returns false
     *
     * @return boolean
     */
    public function inAvailableAccess()
    {
        foreach($this->getAllAvailableAccess() as $access) {
            if($arg === $access) {
                return true;
            }
        }

        return false;
    }
}