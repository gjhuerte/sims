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
            @include('ledgercard.print_table_header')
        </thead>
        <tbody>
        @if(count($ledgercards) > 0)
          @foreach($ledgercards as $ledgercard)
            <tr>
              <td>{{ Carbon\Carbon::parse($ledgercard->date)->format('M d Y') }}</td>
              <td>{{ $ledgercard->reference }}</td>
              <td class="text-right">{{ $ledgercard->received_quantity }}</td>
              <td class="text-right">{{ number_format($ledgercard->received_unitprice, 2) }}</td>
              <td class="text-right">{{ number_format($ledgercard->received_quantity * $ledgercard->received_unitprice, 2) }}</td>
              <td class="text-right">{{ $ledgercard->issued_quantity }}</td>
              <td class="text-right">{{ number_format($ledgercard->issued_unitprice, 2) }}</td>
              <td class="text-right">{{ number_format($ledgercard->issued_quantity * $ledgercard->issued_unitprice, 2) }}</td>
              <td class="text-right">{{ $ledgercard->balance_quantity }}</td>
              @if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
              <td class="text-right">{{ number_format($ledgercard->received_unitprice, 2) }}</td>
              @else
              <td class="text-right">{{ number_format($ledgercard->issued_unitprice, 2) }}</td>
              @endif
              @if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
              <td class="text-right">{{ number_format($ledgercard->received_unitprice *  $ledgercard->balance_quantity, 2) }}</td>
              @else
              <td class="text-right">{{ number_format( $ledgercard->issued_unitprice *  $ledgercard->balance_quantity, 2) }}</td>
              @endif
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