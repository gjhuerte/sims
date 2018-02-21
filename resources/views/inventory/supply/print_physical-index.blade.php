@extends('layouts.report')
@section('title',"Physical Inventory")
@section('content')
<div id="content" class="col-sm-12">
	<table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0"> 
	  <thead>
	    <tr>
			<th>Stock Number</th>
			<th>Description</th>
			<th>Unit</th>
			<th>Quantity</th>
			<th>Remarks</th>
	    </tr>
	  </thead>
	  <tbody>
	    @if(count($stockcards) > 0)
	    @foreach($stockcards as $stockcard)
	    <tr>
			<td>{{ $stockcard->supply->stocknumber }}</td>
			<td>
				<span style="font-weight:normal; @if(strlen($stockcard->supply->details) > 0)
					@if(strlen($stockcard->supply->details) > 80) font-size: 11px; 
					@elseif(strlen($stockcard->supply->details) > 60) font-size: 12px; 
					@elseif(strlen($stockcard->supply->details) > 20) font-size: 13px; 
					@endif 
					@endif">{{ $stockcard->supply->details }}
				</span>
			</td>
			<td>{{ $stockcard->supply->unit_name }}</td>
			<td>{{ $stockcard->received_quantity }}</td>
			<td class="col-sm-1"></td>
	    </tr>
	    @endforeach

	    @else
	    <tr>
	      <td colspan=5 class="col-sm-12"><p class="text-center">  No record </p></td>
	    </tr>
	    @endif
	    <tr>
	      <td colspan=5 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
	    </tr>
        @for($ctr = 0 ; $ctr < $end; $ctr++)
        <tr>
          <td style="padding: 15px;"></td>
          <td></td>
          <td></td>
          <td class="text-center">  </td>
          <td></td>
        </tr>
        @endfor
	  </tbody>
	</table>  
</div>

<div id="footer" class="col-sm-12">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="col-sm-1">  Prepared By: </th>
        <th class="col-sm-1">  Approved By: </th>
        <th class="col-sm-1">  Certified By: </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">
          <br />
          <br />
          <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ Auth::user()->position }}, {{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ (App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]' }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
