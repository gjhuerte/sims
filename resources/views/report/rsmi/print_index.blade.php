@extends('layouts.report')
@section('title',"Reports on Supplies and Materials Issued")
@section('content')
  <div id="content" class="col-sm-12">
    <h3 class="text-center text-muted">
      Reports on Supplies and Materials Issued
    </h3> 
            
    <table class="table table-bordered" id="rsmiTable" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="col-sm-5" style="white-space: nowrap;">RIS No.</th>
          <th class="col-sm-1" style="white-space: nowrap;">Responsibility Center Code</th>
          <th class="col-sm-2" style="white-space: nowrap;">Stock No.</th>
          <th class="col-sm-1" style="white-space: nowrap;">Item</th>
          <th class="col-sm-1" style="white-space: nowrap;">Unit</th>
          <th class="col-sm-1" style="white-space: nowrap;">Qty Issued</th>
          <th class="col-sm-1" style="white-space: nowrap;">Unit Cost</th>
          <th class="col-sm-3" style="white-space: nowrap;">Amount</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ris as $report)
        <tr>
          <td style="white-space: nowrap;">{{ $report->reference }}</td>
          <td>{{ $report->office }}</td>
          <td style="white-space: nowrap;">{{ $report->stocknumber }}</td>
          <td>{{ $report->details }}</td>
          <td>{{ $report->name }}</td>
          <td>{{ $report->issued_quantity }}</td>
          <td>{{ number_format($report->cost,2) }}</td>
          <td>{{ number_format($report->issued_quantity * $report->cost, 2) }}</td>
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
          <th class="col-md-1" style="white-space: nowrap;">Stock No.</th>
          <th class="col-md-1" style="white-space: nowrap;">Item Description</th>
          <th class="col-md-1" style="white-space: nowrap;">Qty</th>
          <th class="col-md-1" style="white-space: nowrap;">Unit Cost</th>
          <th class="col-md-1" style="white-space: nowrap;">Total Cost</th>
          <th class="col-md-1" style="white-space: nowrap;">UACS Object Code</th>
        </tr>
      </thead>
      <tbody>
        @foreach($recapitulation as $report)
        <tr>
          <td>{{ $report->stocknumber }}</td>
          <td>{{ $report->details }}</td>
          <td>{{ $report->issued_quantity }}</td>
          <td>{{ number_format($report->cost,2) }}</td>
          <td>{{ number_format($report->issued_quantity * $report->cost, 2) }}</td>
          <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
include('vendor.print_footer')
@endsection
