@extends('layouts.report')
@section('title',"Purchase Order $purchaseorder->number")
@section('content')
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
        <tr rowspan="2">
          <th class="text-center" colspan="8">
          @if( $purchaseorder->supplier->name == config('app.main_agency') )
          Agency Procurement Request
          @else
          Purchase Order
          @endif 
          </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="4">Code:  <span style="font-weight:normal">{{ $purchaseorder->number }}</span> </th>
            <th class="text-left" colspan="4">Fund Cluster:  
              <span style="font-weight:normal">
                {{ count($purchaseorder->fundclusters) > 0 ? implode( $purchaseorder->fundclusters()->pluck('code')->toArray(), ",") : "None" }}
              </span> 
            </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="4">Supplier:  <span style="font-weight:normal">{{ $purchaseorder->supplier->name }}</span> </th>
            <th class="text-left" colspan="4">Date:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($purchaseorder->date_received)->toFormattedDateString() }}</span> </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="4">Details:  <span style="font-weight:normal">{{ $purchaseorder->details }}</span> </th>
            <th class="text-left" colspan="4"></th>
        </tr>
        <tr>
          <th class="col-sm-1">ID</th>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Ordered Quantity</th>
          <th class="col-sm-1">Received Quantity</th>
          <th class="col-sm-1">Remaining Quantity</th>
          <th class="col-sm-1">Unit Cost</th>
          <th class="col-sm-1">Amount</th>
        </tr>
      </thead>
      <tbody>
      @if(count($purchaseorder->supplies) > 0)
        @foreach($purchaseorder->supplies as $supply)
        <tr>
          <td>{{ $supply->id }}</td>
          <td>{{ $supply->stocknumber }}</td>
          <td>{{ $supply->details }}</td>
          <td>{{ $supply->pivot->ordered_quantity }}</td>
          <td>{{ $supply->pivot->received_quantity }}</td>
          <td>{{ $supply->pivot->remaining_quantity }}</td>
          <td>{{ number_format($supply->pivot->unitcost, 2) }}</td>
          <td>{{ number_format($supply->pivot->received_quantity * $supply->pivot->unitcost, 2) }}</td>
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
@include('layouts.print.footer')
@endsection
