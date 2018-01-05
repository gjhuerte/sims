@extends('layouts.report')
@section('title',"Stock Card Preview")
@section('content')
  @foreach($supplies as $supply)
  <div id="content" class="col-sm-12" style="{{ ($supplies->last() !== $supply) ? "page-break-after:always;" : "" }}">
    <table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
      <thead>
        @include('ledgercard.print_table_header')
      </thead>
      <tbody>
      @if(count($supply->ledgerview) > 0)
        @foreach($supply->ledgerview as $supplyledger)
        <tr>
          <td>{{ Carbon\Carbon::parse($supplyledger->date)->toFormattedDateString() }}</td>
          <td>{{ $supplyledger->reference }}</td>
          <td>{{ $supplyledger->receiptquantity }}</td>
          <td>{{ $supplyledger->receiptunitprice }}</td>
          <td>{{ $supplyledger->receiptunitprice * $supplyledger->receiptunitprice }}</td>
          <td>{{ $supplyledger->issuequantity }}</td>
          <td>{{ $supplyledger->issueunitprice }}</td>
          <td>{{ $supplyledger->issuequantity * $supplytransaction->issueunitprice }}</td>
          <td>{{ ($supplyledger->issueunitprice * $supplyledger->receiptunitprice) / 2 }}</td>
          <td>{{ $supplyledger->balancequantity * (($supplyledger->issueunitprice * $supplyledger->receiptunitprice) / 2)  }}</td>
          @if(!is_null($supply->first()->daystoconsume))
          <th>{{ $supplyledger->daystoconsume }}</th>
          @endif
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
@include('vendor.print_footer')
@endsection
