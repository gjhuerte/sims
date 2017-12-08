@extends('layouts.report')
@section('title',"Stock Card Preview")
@section('content')
  @foreach($supplies as $supply)
  <div id="content" class="col-sm-12" style="{{ ($supplies->last() !== $supply) ? "page-break-after:always;" : "" }}">
    <table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
      <thead>
        <tr>
            <th class="text-left" colspan="7">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
            <th class="text-left" colspan="7">Fund Cluster:
              <span style="font-weight:normal"> @foreach($supply->purchaseorder as $supplypurchaseorder) {{ $supplypurchaseorder->fundcluster }}@if($supply->purchaseorder->first() != $supplypurchaseorder && $supply->purchaseorder->last() != $supplypurchaseorder),  @endif
            @endforeach
              </span>
            </th>
        </tr>
        <tr>
            <th class="text-left" colspan="7">Item:
              <span style="font-weight:normal; @if(strlen($supply->details) > 0)@if(strlen($supply->details) > 60) font-size: 10px; @elseif(strlen($supply->details) > 40) font-size: 11px; @elseif(strlen($supply->details) > 20) font-size: 12px; @endif @endif">{{ $supply->details }}</span> </th>
            <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
        </tr>
        <tr>
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
        </tr>
      </thead>
      <tbody>
      @if(count($supply->ledgerview) > 0)
        @foreach($supply->ledgerview as $supplyledger)
        <tr>
          <td>{{ Carbon\Carbon::parse($supplyledger->date)->toFormattedDateString() }}</td>
          <td></td>
          <td>{{ $supplyledger->receiptquantity }}</td>
          <td>{{ $supplyledger->receiptunitprice }}</td>
          <td>{{ $supplyledger->receiptunitprice * $supplyledger->receiptunitprice }}</td>
          <td>{{ $supplyledger->issuequantity }}</td>
          <td>{{ $supplyledger->issueunitprice }}</td>
          <td>{{ $supplyledger->issuequantity * $supplytransaction->issueunitprice }}</td>
          <td>{{ ($supplyledger->issueunitprice * $supplyledger->receiptunitprice) / 2 }}</td>
          <td>{{ $supplyledger->balancequantity * (($supplyledger->issueunitprice * $supplyledger->receiptunitprice) / 2)  }}</td>
          <td></td>
        </tr>
        @endforeach
      @else
      <tr>
        <td colspan=12 class="col-sm-12"><p class="text-center">  No record </p></td>
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
