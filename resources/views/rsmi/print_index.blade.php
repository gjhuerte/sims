@extends('layouts.report')
@section('title',"Reports on Supplies and Materials Issued")
@section('content')
  <div id="content" class="col-sm-12">
    <h3 class="text-center text-muted">
      Reports on Supplies and Materials Issued <small class="pull-right">Appendix 64</small>
    </h3> 
            
    <table class="table table-bordered" id="rsmiTable" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="text-right" colspan="8" style="white-space: nowrap;font-weight: normal;">R.I.S. {{ isset($start) ? $start : 'N/A' }} to {{ isset($end) ? $end : 'N/A' }}</th>
        </tr>
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

        @foreach($rsmi->stockcards as $report)
        <tr>
          <td style="white-space: nowrap;">{{ $report->reference }}</td>
          <td>{{ $report->organization }}</td>
          <td style="white-space: nowrap;">{{ $report->supply->stocknumber }}</td>
          <td>{{ $report->supply->details }}</td>
          <td>{{ $report->supply->unit_name }}</td>
          <td>{{ $report->issued_quantity }}</td>
          <td>{{ number_format($report->pivot->unitcost,2) }}</td>
          <td>{{ number_format($report->issued_quantity * $report->pivot->unitcost, 2) }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="6">Total Quantity Released: <span class="pull-right"> {{ $rsmi->stockcards->sum('issued_quantity') }} </span></td>
          <td colspan="1">N/A</td>
          <td colspan="1">N/A</td>
        </tr>

        <tr>
          <td colspan=8 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
        </tr>
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
          <td>{{ number_format($report->unitcost,2) }}</td>
          <td>{{ number_format($report->amount, 2) }}</td>
          <td>{{ $report->uacs_code }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
        </tr>
      </tbody>
    </table>
  </div>
@include('layouts.print.footer')
@endsection
