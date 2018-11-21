<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    protected $table = "ris_list";

    /**
     * Sets the following items as date
     *
     * @var array
     */
    protected $date = [
        'created_at', 'approved_at', 'released_at'
    ];

}
