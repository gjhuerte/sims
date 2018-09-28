@extends('layouts.report')
@section('title',"Ledger Card $supply->stocknumber")
@section('content')
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
            <td>{{ $ledgercard->reference_list }}</td>
            <td align="right">{{ $ledgercard->received_quantity }}</td>
            <td align="right">{{ $ledgercard->parsed_received_unitcost }}</td>
            <td align="right">{{ $ledgercard->parsed_received_total_cost }}</td>

            <td align="right">{{ $ledgercard->issued_quantity }}</td>
            <td align="right">{{ $ledgercard->parsed_issued_unitcost }}</td>
            <td align="right">{{ $ledgercard->parsed_issued_total_cost }}</td>

            <td align="right">{{ $ledgercard->parsed_monthlybalancequantity }}</td>

            <td align="right">{{ $ledgercard->parsed_monthlyunitcost }}</td>

            <td align="right">{{ $ledgercard->parsed_monthlytotalcost }}</td>
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
@include('layouts.print.ledgercard-footer')
@endsection
 