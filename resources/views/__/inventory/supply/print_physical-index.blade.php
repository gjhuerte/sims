@extends('layouts.report')
@section('title',"Physical Inventory")
@section('content')
<div id="content" class="col-sm-12">
	<table class="table" width="100%" cellspacing="0"> 
	  <thead>
	  	
	  </thead>
	</table> 
	<table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0"> 
	  <thead>
	  	<tr><th colspan="12" style=" border-style:hidden;text-align: center;font-weight: bold;font-size: 20px;font-family: Arial, Helvetica, sans-serif;"> REPORT ON THE PHYSICAL INVENTORIES</th></tr>
		<tr><th colspan="12" style=" border-style:hidden;text-align: center;font-weight: 100px;font-size: 13px;font-family: Arial, Helvetica, sans-serif;">Inventory Supplies<br>
		As of {{$date->format('M')}} {{$date->year}}</th></tr>
		<tr><th colspan="12" style=" border-bottom: black;font-weight: normal;">
		Fund Cluster: __________________________<br>
		For Which: {{ ucwords(strtolower((App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : ''))}}, 
		{{ App\Office::findByCode(Auth::user()->office)->head_title }}, {{ App\Office::findByCode(Auth::user()->office)->name }}, is accountable, having assumed such accountability on {{$date->format('M')}} {{$date->year}}.</th></tr>
	    <tr>
			<th class="text-center" rowspan="2" >Article</th>
			<th class="text-center" rowspan="2" colspan="3">Description</th>
			<th class="text-center" rowspan="2" style="width: 75px;">Stock Number</th>
			<th class="text-center" rowspan="2" style="width: 75px;">Unit of Measurement</th>
			<th class="text-center" rowspan="2" style="width: 100px;">Unit Value</th>
			<th class="text-center" rowspan="1" >Balance Per Card</th>
			<th class="text-center" rowspan="1" >On Hand Per Count</th>
			<th class="text-center" rowspan="1" colspan="2">Shortage/Overage</th>
			<th class="text-center" rowspan="2" >Remarks</th>
	    </tr>
	    <tr>
			<th class="text-center" rowspan="1"  style="font-weight: normal;width: 100px;">(Quantity)</th>
			<th class="text-center" rowspan="1"  style="font-weight: normal;width: 100px;">(Quantity)</th>
			<th class="text-center" rowspan="1"  style="font-weight: normal;width: 75px;">(Quantity)</th>
			<th class="text-center" rowspan="1"  style="font-weight: normal;width: 75px;">(Value)</th>
	    </tr>
	  </thead>
	  <tbody>
	    @if(count($supplies) > 0)
	    @foreach($supplies as $supplies)
	    <tr>
			<td></td>
			<td colspan="3"><span style="font-family: Verdana;font-weight:normal; font-size: 12px;">{{ $supplies->details }}</span></td>
			<td>{{ $supplies->stocknumber }}</td>
			<td>{{ $supplies->unit_name }}</td>
			<td></td>
			<td align="right">{{ $supplies->stock_balance }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
	    </tr>
	    @endforeach
 
	    @else
	    <tr>
	      <td colspan=12 class="col-sm-12"><p class="text-center">  No record </p></td>
	    </tr>
	    @endif
	    <tr>
	      <td colspan=12 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
	    </tr>
        @for($ctr = 0 ; $ctr < $end; $ctr++)
        <tr>
          <td style="padding: 15px;"></td>
          <td colspan="4"></td>
          <td></td>
          <td class="text-center">  </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        @endfor
	  </tbody>
	  <tfoot>
      <tr>
        <th class="col-sm-1 text-center" colspan="3">  Prepared By: </th>
        <th class="col-sm-1 text-center" colspan="4">  Certified By: </th>
        <th class="col-sm-1 text-center" colspan="5">  Approved By: </th>
      </tr>
      <tr>
        <td class="text-center" colspan="3">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px;"> SALVADOR R. NATOC</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ Auth::user()->position }}, {{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center" colspan="4">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ strtoupper((App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]') }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->head_title }},{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center" colspan="5">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">DR. EMANUEL C. DE GUZMAN</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">President, P.U.P <span></td>
      </tr>
    </tfoot>
	</table>  
</div>

<div id="footer" class="col-sm-12">
  <table class="table table-bordered">
    
  </table>
</div>
@endsection
