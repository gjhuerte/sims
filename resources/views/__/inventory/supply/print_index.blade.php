@extends('layouts.report')
@section('title',"Supplies Masterlist")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }

      #content{
        font-family: "Verdana";
        font-size: 12px;
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
        </thead>
        <tbody>
        @foreach($supplies as $supply)
        @if($supply->details <> 'N/A')
        <tr height="5">
          <td align="left">{{ $supply->stocknumber }}</td>
          <td align="left"> 
            <span style="font-size:
            @if(strlen($supply->details) > 130) 10px 
              @elseif(strlen($supply->details) > 90) 11px 
              @else 12px 
            @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td>{{ $supply->unit->name }}</td>
        </tr>
        @endif
        @endforeach
        <tr>
          <td colspan=3 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
        </tr>
        </tbody>
    </table>
  </div>
@endsection
