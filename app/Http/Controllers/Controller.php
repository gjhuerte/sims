<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PDF;
use Carbon;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public	function sanitizeString($var)
	{
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $var;
	}

	public function convertDateToCarbon($date)
	{
		if($date == 'undefined' || $date == "" || $date == null || !isset($date) || $date == 'null' ) return Carbon\Carbon::now();

		return Carbon\Carbon::parse($date);
	}

	public function printPreview( $view , $data=[] , $filename="Preview.php" ,$orientation)
	{
		$pdf = PDF::loadView($view,$data);
		
	    $header = view('layouts.header-report');
	    $footer = view('layouts.footer-numbering');
	    return $pdf
	        ->setOption('footer-center', 'Page [page] / [toPage]')
	        ->setOption('header-spacing', 5)
	        ->setOption('header-html',$header)
	        ->setOption('margin-top', '35mm')
	        ->setOption('margin-bottom', '15mm')
	        ->setOption('footer-spacing', 4)
	        ->setOption('footer-font-size','7')
            ->setOption('orientation',$orientation)
	        // ->setOption('footer-html', $footer)
    		->stream( $filename , array('Attachment'=>0) );

	}

}
