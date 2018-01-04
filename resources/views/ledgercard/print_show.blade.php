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
        @if(count($ledgercard) > 0)
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
          @else
          <tr>
            <td colspan=12 class="col-sm-12"><p class="text-center">  No record </p></td>
          </tr>
          @endif
        </tbody>
    </table>
  </div>
@include('vendor.print_footer')
@endsection