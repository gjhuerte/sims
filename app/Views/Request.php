<?php

namespace App\Views;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const NO_REMARKS = 'No Remarks';
    const PENDING_STATUS = 'Pending';
    const APPROVED_STATUS = 'Approved';
    const DISAPPROVED_STATUS = 'Disapproved';
    const RELEASED_STATUS = 'Released';
    const DATE_FORMAT = 'DATE_FORMAT(released_at,"%m/%d/%y")';

    protected $table = 'requests_v';

    /**
     * Returns the most requested stock
     *
     * @param Builder $query
     * @return object
     */
    public function scopeSelectMostRequestedStock($query)
    {
        
        return $query->select(
                'details', 'unit', 'stocknumber', 'name',
                DB::raw(`
                    SUM(quantity_requested) AS total_requested,
                    COUNT(quantity_requested) AS total_request,
                    AVG(quantity_requested) AS average_item_per_request,
                    MAX(quantity_requested) AS highest_quantity_requested
                `)
            )
            ->groupBy('stocknumber', 'details', 'unit', 'name')
            ->orderBy('total_requested','desc');
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
     * Filters the select with count and date released
     *
     * @return void
     */
    public function scopeCountWithDateReleased($query)
    {
        return $query->select(
            DB::raw(self::DATE_FORMAT . ' AS date_released, COUNT(id) AS count')
        );
    }

    /**
     * Grouped the request by date
     *
     * @param [type] $query
     * @return void
     */
    public function scopeGroupedByDate($query)
    {
        return $query->groupBy(DB::raw('DATE_FORMAT(released_at,"%m/%d/%y")'));
    }
}
