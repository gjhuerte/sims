@extends('layouts.report')
@section('title',"Supplies Masterlist")
@section('content')
  <style>
      th{
        text-align: center;
        font-size:14px;
      }
      tbody{
        text-align: left;
        font-size:14px;
      }

      #content{
        font-family: "Verdana";
        font-size:13px;
      }

      @media print {
          tr.page-break  { display: block; page-break-after: always; }
      }   

  </style>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0">
        <thead>
          <th class="col-sm-1">Stock No.</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Unit</th>
          <th class="col-sm-1">Quantity</th>
        </thead>
        <tbody>
        @foreach($supplies as $supply)
        <tr>
          <td>{{ $supply->stocknumber }}</td>
          <td>
            <span style="font-size:
            @if(strlen($supply->details) > 80) 9px 
              @elseif(strlen($supply->details) > 60) 11px 
              @else 12px 
            @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td>{{ $supply->unit->name }}</td>
          <td align="right">{{ $supply->stock_balance }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
@include('layouts.print.stockcard-footer')
@endsection
