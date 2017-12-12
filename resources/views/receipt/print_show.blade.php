@extends('layouts.report')
@section('title',"$receipt->number")
@section('content')
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
        <tr rowspan="2">
            <th class="text-left" colspan="3">Receipt:  <span style="font-weight:normal">{{ $receipt->number }}</span> </th>
            <th class="text-left" colspan="3">Supplier:  <span style="font-weight:normal">{{ $receipt->supplier_name }}</span> </th>
        </tr>
        <tr rowspan="2">
            <th class="text-left" colspan="3">Invoice:  <span style="font-weight:normal">{{ $receipt->invoice }}</span> </th>
            <th class="text-left" colspan="3">Date Delivered:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($receipt->date_delivered)->toFormattedDateString() }}</span> </th>
        </tr>
        <tr>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Unit</th>
        <th class="col-sm-1">Delivered Quantity</th>
        <th class="col-sm-1">Remaining Quantity</th>
        <th class="col-sm-1">Unit Cost</th>
        <th class="col-sm-1">Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach($receiptsupplies as $receiptsupply)
      <tr>
        <td>{{ $receiptsupply->stocknumber }}</td>
        <td>{{ $receiptsupply->supply->unit }}</td>
        <td>{{ $receiptsupply->quantity }}</td>
        <td>{{ $receiptsupply->remaining_quantity }}</td>
        <td>{{ $receiptsupply->cost }}</td>
        <td>{{ $receiptsupply->quantity * ( isset($receiptsupply->cost) && $receiptsupply->cost != "" && $receiptsupply->cost != null ) ? $receiptsupply->cost : 0 }}</td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
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