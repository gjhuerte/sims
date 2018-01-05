@extends('layouts.report')
@section('title',"Ledger Card $supply->stocknumber")
@section('content')
  <br />
  <br />
  <div id="content" class="col-sm-12">
    <table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
      <thead>
        @include('ledgercard.print_table_header')
      </thead>
      <tbody>
      @if(count($ledgercards) > 0)
        @foreach($ledgercards as $ledgercard)
          <tr>
            <td>{{ Carbon\Carbon::parse($ledgercard->date)->format('M Y') }}</td>
            <td>{{ $ledgercard->reference }}</td>
            <td>{{ $ledgercard->received_quantity }}</td>
            <td>{{ number_format($ledgercard->received_unitcost, 2) }}</td>
            <td>{{ number_format($ledgercard->received_quantity * $ledgercard->received_unitcost, 2) }}</td>

            <td>{{ $ledgercard->issuedquantity }}</td>
            <td>{{ number_format($ledgercard->issued_unitcost, 2) }}</td>
            <td>{{ number_format($ledgercard->issued_quantity * $ledgercard->issued_unitcost, 2) }}</td>

            <td>{{ $ledgercard->received_quantity - $ledgercard->issued_quantity }}</td>

            @if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
            <td>{{ number_format($ledgercard->received_unitcost, 2) }}</td>
            @else
            <td>{{ number_format($ledgercard->issued_unitcost, 2) }}</td>
            @endif

            @if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
            <td>{{ number_format($ledgercard->received_unitcost * ($ledgercard->received_quantity - $ledgercard->issued_quantity), 2) }}</td>
            @else
            <td>{{ number_format( $ledgercard->issued_unitcost *  ($ledgercard->received_quantity - $ledgercard->issued_quantity), 2) }}</td>
            @endif
            <td>{{ $ledgercard->daystoconsume }}</td>
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
@include('layouts.print.stockcard-footer')
@endsection
