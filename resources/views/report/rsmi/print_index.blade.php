@extends('layouts.report')
@section('title',"Reports on Supplies and Materials Issued")
@section('content')
  <div id="content" class="col-sm-12">
    <br />
    <h3 class="text-center">
      Reports on Supplies and Materials Issued
    </h3>
            
    <table class="table table-bordered" id="rsmiTable" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="col-md-1">RIS No.</th>
          <th class="col-md-1">Responsibility Center Code</th>
          <th class="col-md-1">Stock No.</th>
          <th class="col-md-1">Item</th>
          <th class="col-md-1">Unit</th>
          <th class="col-md-1">Qty Issued</th>
          <th class="col-md-1">Unit Cost</th>
          <th class="col-md-1">Amount</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ris as $report)
        <tr>
          <td>{{ $report->reference }}</td>
          <td>{{ $report->office }}</td>
          <td>{{ $report->stocknumber }}</td>
          <td>{{ $report->details }}</td>
          <td>{{ $report->unit }}</td>
          <td>{{ $report->issued }}</td>
          <td>{{ number_format($report->cost,2) }}</td>
          <td>{{ number_format($report->issued * $report->cost, 2) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <table class="table table-bordered" id="rsmiTotalTable" cellspacing="0" width="100%">
      <thead>
          <tr rowspan="2">
              <th class="text-left text-center" colspan="8">Recapitulation</th>
          </tr>
        <tr>
          <th class="col-md-1">Stock No.</th>
          <th class="col-md-1">Qty</th>
          <th class="col-md-1">Item Description</th>
          <th class="col-md-1">Unit Cost</th>
          <th class="col-md-1">Total Cost</th>
          <th class="col-md-1">UACS Object Code</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recapitulation as $report)
        <tr>
          <td>{{ $report->stocknumber }}</td>
          <td>{{ $report->details }}</td>
          <td>{{ $report->issued }}</td>
          <td>{{ number_format($report->cost,2) }}</td>
          <td>{{ number_format($report->issued * $report->cost, 2) }}</td>
          <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1">  Prepared By: </th>
          {{-- <th class="col-sm-1">   </th>
          <th class="col-sm-1">   </th> --}}
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;">{{ Auth::user()->office }}</span>
          </td>
          {{-- <td></td>
          <td></td> --}}
        </tr>
      </tbody>
    </table>
  </div>
@endsection
