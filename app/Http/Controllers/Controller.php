<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PDF;
use Carbon;

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

	public function printPreview( $view , $data=[] , $filename="Preview.php" )
	{
		$pdf = PDF::loadView($view,$data);
		// dd($filename);
		// return $pdf->download($filename);
		// $pdf = App::make('dompdf.wrapper');
		// $pdf->loadHTML('<h1>Test</h1>');
	    $header = view('layouts.header-report');
	    return $pdf->setOption('header-html',$header)
	        ->setOption('header-spacing',5)
	        ->setOption('footer-center', 'Page [page]')
    		->stream( $filename , array('Attachment'=>0) );

	}

}
