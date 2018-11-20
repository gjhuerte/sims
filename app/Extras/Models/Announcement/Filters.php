<?php

namespace App\Extras\Models\Announcement;

use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

trait Filters 
{
    
    /**
     * Filters the query by the user whose office 
     * is the the as the current users office
     *
     * @param Builder $query
     * @return object
     */
    public function scopeUserWhoseOfficeIsSameAsCurrentUser($query)
    {
        $userIds = User::officeOfCurrentAuthenticatedUser()->pluck('id')->toArray();
        return $query->orWhereIn('specified_users', $userIds);
    }

    /**
     * Filters the query by the user whose office 
     * is the the as the current users office
     *
     * @param Builder $query
     * @return object
     */
    public function scopeOrUserWhoseOfficeIsSameAsCurrentUser($query)
    {
        $userIds = User::officeOfCurrentAuthenticatedUser()->pluck('id')->toArray();
        return $query->orWhereIn('specified_users', $userIds);
    }

    /**
     * Filters the query where the access of the user is same as the 
     * current authenticated users access
     *
     * @param Builder $query
     * @return object
     */
    public function scopeUserWhoseAccessIsSameAsCurrentUser($query)
    {
        $userIds = User::accessOfCurrentAuthenticatedUser()->pluck('id')->toArray();
        return $query->where('specified_users', '=', $userIds);
    }

    /**
     * Filters the query where the access of the user is same as the 
     * current authenticated users access
     *
     * @param Builder $query
     * @return object
     */
    public function scopeOrUserWhoseAccessIsSameAsCurrentUser($query)
    {
        $userIds = User::accessOfCurrentAuthenticatedUser()->pluck('id')->toArray();
        return $query->orWhere('specified_users', '=', $userIds);
    }

    public function scopeOfficeOrSelf($query)
    {
        $query->where(function($query) {
            $query->userWhoseAccessIsSameAsCurrentUser()->userWhoseOfficeIsSameAsCurrentUser();
        });
    }

    /**
     * Filters the query where the access is for all the users
     *
     * @param Builder $query
     * @return object
     */
    public function scopeForAll($query)
    {
        return $query->where('access', '=', self::ALL);
    }

    /**
     * Filters the announcement where the user_id is the 
     * current users id
     *
     * @param Builder $query
     * @return object
     */
    public function scopeByOffice($query)
    {
        $users = User::officeOfCurrentAuthenticatedOffice()->pluck('id');
        return $query->orInUser($users);
    }

    /**
     * Filters the query where the announcement creator is the
     * same as the current authenticated user
     *
     * @param Builder $query
     * @param array|string $value
     * @return object
     */
    public function scopeInUser($query, $value)
    {
        if(is_array($value)) {
            return $query->whereIn('user_id', $value);
        }

        return $query->where('user_id', '=', $value);
    }

    /**
     * Filters the query where the announcement creator is the
     * same as the current authenticated user
     *
     * @param Builder $query
     * @param array|string $value
     * @return object
     */
    public function scopeOrInUser($query, $value)
    {
        if(is_array($value)) {
            return $query->orWhereIn('user_id', $value);
        }

        return $query->orWhere('user_id', '=', $value);
    }
    
    /**
     * Filters the query by the users access
     * level. Checks if the argument passed
     * is array and filters the result by the 
     * access given
     *
     * @param Builder $query
     * @param array|string $value
     * @return object
     */
    public function scopeFindByAccess($query, $value)
    {
        if(is_array($value)) {
            return $query->whereIn('access', $value);
        }

        return $query->whereAccess($value);
    }
}