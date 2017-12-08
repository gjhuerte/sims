@extends('layouts.report')
@section('title',"$supply->stocknumber")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }
  </style>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
        <thead>
            <tr rowspan="2">
                <th class="text-left" colspan="7">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
                <th class="text-left" colspan="7">Fund Cluster: <span style="font-weight:normal"></span> </th>
            </tr>
            <tr rowspan="2">
                <th class="text-left" colspan="7">Item:  <span style="font-weight:normal">{{ $supply->details }}</span> </th>
                <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
            </tr>
            <tr rowspan="2">
                <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
                <th class="text-left" colspan="7">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
            </tr>
            <tr rowspan="2">
                <th class="text-center" colspan="2"></th>
                <th class="text-center" colspan="3">Receipt</th>
                <th class="text-center" colspan="3">Issue</th>
                <th class="text-center" colspan="3">Balance</th>
                <th class="text-center" colspan="2"></th>
            </tr>
          <tr>
            <th>Date</th>
            <th>Reference</th>
            <th>Qty</th>
            <th>Unit Cost</th>
            <th>Total Cost</th>
            <th>Qty</th>
            <th>Unit Cost</th>
            <th>Total Cost</th>
            <th>Qty</th>
            <th>Unit Cost</th>
            <th>Total Cost</th>
            <th>Days To Consume</th>
            <th class="no-sort"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($ledgercard as $ledgercard)
          <tr>
            <td>{{ Carbon\Carbon::parse($ledgercard->date)->format('M d Y') }}</td>
            <td>{{ $ledgercard->reference }}</td>
            <td>{{ $ledgercard->receivedquantity }}</td>
            <td>{{ number_format($ledgercard->receivedunitprice, 2) }}</td>
            <td>{{ number_format($ledgercard->receivedquantity * $ledgercard->receivedunitprice, 2) }}</td>
            <td>{{ $ledgercard->issuedquantity }}</td>
            <td>{{ number_format($ledgercard->issuedunitprice, 2) }}</td>
            <td>{{ number_format($ledgercard->issuedquantity * $ledgercard->issuedunitprice, 2) }}</td>
            <td>{{ $ledgercard->balancequantity }}</td>
            @if($ledgercard->receivedquantity != 0 && isset($ledgercard->receivedquantity))
            <td>{{ number_format($ledgercard->receivedunitprice, 2) }}</td>
            @else
            <td>{{ number_format($ledgercard->issuedunitprice, 2) }}</td>
            @endif
            @if($ledgercard->receivedquantity != 0 && isset($ledgercard->receivedquantity))
            <td>{{ number_format($ledgercard->receivedunitprice *  $ledgercard->balancequantity, 2) }}</td>
            @else
            <td>{{ number_format( $ledgercard->issuedunitprice *  $ledgercard->balancequantity, 2) }}</td>
            @endif
            <td>{{ $ledgercard->daystoconsume }}</td>
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