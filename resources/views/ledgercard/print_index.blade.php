@extends('layouts.report')
@section('title',"Stock Card $supply->stocknumber")
@section('content')
  <br />
  <br />
  <div id="content" class="col-sm-12">
    <table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
      <thead>
        @include('ledgercard.print_table_header')
      </thead>
      <tbody>
      @if(count($ledgercard) > 0)
        @foreach($ledgercard as $ledgercard)
          <tr>
            <td>{{ Carbon\Carbon::parse($ledgercard->date)->format('M Y') }}</td>
            <td></td>

            <td>{{ $ledgercard->receivedquantity }}</td>
            <td>{{ number_format($ledgercard->receivedunitprice, 2) }}</td>
            <td>{{ number_format($ledgercard->receivedquantity * $ledgercard->receivedunitprice, 2) }}</td>

            <td>{{ $ledgercard->issuedquantity }}</td>
            <td>{{ number_format($ledgercard->issuedunitprice, 2) }}</td>
            <td>{{ number_format($ledgercard->issuedquantity * $ledgercard->issuedunitprice, 2) }}</td>

            <td>{{ $ledgercard->receivedquantity - $ledgercard->issuedquantity }}</td>

            @if($ledgercard->receivedquantity != 0 && isset($ledgercard->receivedquantity))
            <td>{{ number_format($ledgercard->receivedunitprice, 2) }}</td>
            @else
            <td>{{ number_format($ledgercard->issuedunitprice, 2) }}</td>
            @endif

            @if($ledgercard->receivedquantity != 0 && isset($ledgercard->receivedquantity))
            <td>{{ number_format($ledgercard->receivedunitprice * ($ledgercard->receivedquantity - $ledgercard->issuedquantity), 2) }}</td>
            @else
            <td>{{ number_format( $ledgercard->issuedunitprice *  ($ledgercard->receivedquantity - $ledgercard->issuedquantity), 2) }}</td>
            @endif
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
@include('vendor.print_footer')
@endsection
