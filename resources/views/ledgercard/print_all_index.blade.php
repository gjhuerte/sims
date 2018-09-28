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
        @foreach($supply->ledgerview as $ledgercard)
        <tr>
          <td>{{ Carbon\Carbon::parse($ledgercard->date)->toFormattedDateString() }}</td>
          <td>{{ $ledgercard->reference }}</td>
          <td align="right">{{ $ledgercard->receipt_quantity }}</td>
          <td align="right">{{ $ledgercard->receipt_unitprice }}</td>
          <td align="right">{{ $ledgercard->receipt_unitprice * $ledgercard->receipt_unitprice }}</td>
          <td align="right">{{ $ledgercard->issuequantity }}</td>
          <td align="right">{{ $ledgercard->issue_unitprice }}</td>
          <td align="right">{{ $ledgercard->issue_quantity * $supplytransaction->issue_unitprice }}</td>
          <td align="right">{{ ($ledgercard->issue_unitprice * $ledgercard->receipt_unitprice) / 2 }}</td>
          <td align="right">{{ $ledgercard->balance_quantity * (($ledgercard->issue_unitprice * $ledgercard->receipt_unitprice) / 2)  }}</td>
        </tr>
        @endforeach
      @else
      <tr>
        <td colspan=12 class="col-sm-12"><p class="text-center">  No record </p></td>
      </tr>
      @endif
      <tr>
        <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
      </tr>
      </tbody>
    </table>
  </div>
  @endforeach
@include('layouts.print.ledgercard-footer')
@endsection
 