<?php

namespace App\Http\Controllers\Inventory\Supply\Stock\Adjustment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Supply\Adjustment;

class ReportController extends Controller
{

    public function print($id)
    {
        $adjustment = Adjustment::findOrFail($id);
        $orientation = 'Portrait';
        $data = [ 'adjustment' => $adjustment ];
        $filename = "AdjustmentReport-" . Carbon::now()->format('mdYHm') . "-$adjustment->code".".pdf";
        $view = "adjustment.print_show";

        return $this->printPreview($view,$data,$filename,$orientation);
    }
}
