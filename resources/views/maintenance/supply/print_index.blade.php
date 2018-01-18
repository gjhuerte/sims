@extends('layouts.report')
@section('title',"Supplies Masterlist")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }

      #content{
        font-family: "Times New Roman";
      }

      @media print {
          tr.page-break  { display: block; page-break-after: always; }
      }   

  </style>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
        <thead>
          <th class="col-sm-1">Stock No.</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Unit</th>
          <th class="col-sm-1">Reorder Point</th>
        </thead>
        <tbody>
        @foreach($supplies as $supply)
        <tr>
          <td>{{ $supply->stocknumber }}</td>
          <td>
            <span style="font-size:@if(strlen($supply->details) > 50) 7px @elseif(strlen($supply->details) > 40) 9px @elseif(strlen($supply->details) > 20) 10px @else 11px @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td>{{ $supply->unit->name }}</td>
          <td>{{ $supply->reorderpoint }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
@include('layouts.print.stockcard-footer')
@endsection