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
	      <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
	    </tr>
	    @endif
	  </tbody>
	</table>  

    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
    </tr>
</div>
@include('layouts.print.stockcard-footer')
@endsection
