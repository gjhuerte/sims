@extends('layouts.report')
@section('title',"$receipt->number")
@section('content')
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0" style="font-size: 12px">
      <thead>
        <tr rowspan="2">
            <th class="text-left" colspan="2">Receipt:  <span style="font-weight:normal">{{ $receipt->number }}</span> </th>
            <th class="text-left" colspan="5">Supplier:  <span align="right">{{ isset($receipt->supplier) ? $receipt->supplier->name : 'None' }}</span> </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="2">Invoice:  <span style="font-weight:normal">{{ $receipt->invoice }}</span> </th>
            <th class="text-left" colspan="5">Date Delivered:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($receipt->date_delivered)->toFormattedDateString() }}</span> </th>
        </tr>
        <tr>
        <th class="text-center" width= 50px>Stock No.</th>
        <th class="text-center">Details</th>
        <th class="text-center" width= 50px>Unit</th>
        <th class="text-center" width= 60px >Delivered Quantity</th>
        <th class="text-center" width= 60px >Remaining Quantity</th>
        <th class="text-center" >Unit Cost</th>
        <th class="text-center" >Amount</th>
      </tr>
    </thead>
    <tbody>
    @if(count($receipt->supplies) > 0)
      @foreach($receipt->supplies as $supply)
      <tr>
        <td>{{ $supply->stocknumber }}</td>
        <td>{{ $supply->details }}</td>
        <td>{{ $supply->unit->abbreviation }}</td>
        <td align="right">{{ $supply->pivot->quantity }}</td>
        <td align="right">{{ $supply->pivot->remaining_quantity }}</td>
        <td align="right">{{ $supply->pivot->unitcost }}</td>
        <td align="right">{{ $supply->pivot->quantity * ( isset($supply->pivot->unitcost) && $supply->pivot->unitcost != "" && $supply->pivot->unitcost != null ) ? $supply->pivot->unitcost : 0 }}</td>
      </tr>
      @endforeach
    @else
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
    </tr>
    @endif
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
    </tr>
    </tbody>
  </table>
</div>
@include('layouts.print.footer')
@endsection