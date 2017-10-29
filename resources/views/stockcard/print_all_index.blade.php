@extends('layouts.report')
@section('title',"Stock Card Preview")
@section('content')
  @foreach($supplies as $supply)
  <br />
  <br />
  <div id="content" class="col-sm-12" style="{{ ($supplies->last() !== $supply) ? "page-break-after:always;" : "" }}">
  	<table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
  		<thead>
        <tr>
            <th class="text-left" colspan="4">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
            <th class="text-left" colspan="3">Fund Cluster:
              <span style="font-weight:normal"> @foreach($supply->purchaseorder as $supplypurchaseorder) {{ $supplypurchaseorder->fundcluster }}@if($supply->purchaseorder->first() != $supplypurchaseorder && $supply->purchaseorder->last() != $supplypurchaseorder),  @endif
            @endforeach
              </span>
            </th>
        </tr>
        <tr>
            <th class="text-left" colspan="4">Item:
              <span style="font-weight:normal; @if(strlen($supply->supplytype) > 0)@if(strlen($supply->supplytype) > 60) font-size: 10px; @elseif(strlen($supply->supplytype) > 40) font-size: 11px; @elseif(strlen($supply->supplytype) > 20) font-size: 12px; @endif @endif">{{ $supply->supplytype }}</span> </th>
            <th class="text-left" colspan="3">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
        </tr>
        <tr>
            <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
            <th class="text-left" colspan="3">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
        </tr>
  			<tr>
  				<th class="col-sm-1">Date</th>
  				<th class="col-sm-1">Reference</th>
  				<th class="col-sm-1">Receipt Qty</th>
  				<th class="col-sm-1">Issue Qty</th>
  				<th class="col-sm-1">Office</th>
  				<th class="col-sm-1">Balance Qty</th>
  				<th class="col-sm-1">Days To Consume</th>
  			</tr>
  		</thead>
      <tbody>
      @if(count($supply->supplytransaction) > 0)
        @foreach($supply->supplytransaction as $supplytransaction)
        <tr>
          <td>{{ Carbon\Carbon::parse($supplytransaction->date)->toFormattedDateString() }}</td>
          <td>{{ $supplytransaction->reference }}</td>
          <td>{{ $supplytransaction->receiptquantity }}</td>
          <td>{{ $supplytransaction->issuequantity }}</td>
          <td>{{ $supplytransaction->office }}</td>
          <td>{{ $supplytransaction->balancequantity }}</td>
          <td class="col-sm-1">{{ $supplytransaction->daystoconsume }}</td>
        </tr>
        @endforeach
      @else
      <tr>
        <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
      </tr>
      @endif
      </tbody>
  	</table>
  </div>
  @endforeach
  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1">  Prepared By: </th>
          {{-- <th class="col-sm-1">   </th>
          <th class="col-sm-1">   </th> --}}
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;">{{ Auth::user()->office }}</span>
          </td>
          {{-- <td></td>
          <td></td> --}}
        </tr>
      </tbody>
    </table>
  </div>
@endsection
