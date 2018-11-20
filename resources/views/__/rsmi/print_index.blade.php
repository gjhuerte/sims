@extends('layouts.report')
@section('title',"Reports on Supplies and Materials Issued")
@section('content')
  <div id="content" class="col-sm-12">
    <h3 class="text-center text-muted">
      Reports on Supplies and Materials Issued <small class="pull-right">Appendix 64</small>
    </h3> 
            
    <table class="table table-bordered table-condensed" id="rsmiTable" cellspacing="0" width="100%" style="font-size: 12px">
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
          <td>{{ isset($report->sector_office) ? $report->sector_office : 'n/a' }} - {{ $report->organization }}</td>
          <td style="white-space: nowrap;">{{ $report->supply->stocknumber }}</td>
          <td>{{ $report->supply->details }}</td>
          <td>{{ $report->supply->unit_name }}</td>
          <td align="right">{{ $report->issued_quantity }}</td>
          <td align="right">{{ number_format($report->pivot->unitcost,2) }}</td>
          <td align="right">{{ number_format($report->issued_quantity * $report->pivot->unitcost, 2) }}</td>
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
    <tfoot>
      <tr>
        <th class="text-center" colspan="3">  Prepared By: </th>
        <th class="text-center" colspan="5">  Approved By: </th>
      </tr>
      <tr>
        <td class="text-center" colspan="3">
          <br />
          <br />
          <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center" colspan="5">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ (App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]' }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
      </tr>
    </tfoot>
    </table>
    <p style="page-break-after: always;">&nbsp;</p>
    <table class="table table-bordered" id="rsmiTotalTable" cellspacing="0" width="100%" style="font-size: 12px">
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
          <td align="right">{{ $report->issued_quantity }}</td>
          <td align="right">{{ number_format($report->unitcost,2) }}</td>
          <td align="right">{{ number_format($report->amount, 2) }}</td>
          <td>{{ $report->uacs_code }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3">Total Quantity Released: <span class="pull-right"> {{ $recapitulation->sum('issued_quantity') }} </span></td>
          <td colspan="1">N/A</td>
          <td colspan="1">N/A</td>
          <td colspan="1"></td>
        </tr>
        <tr>
          <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows *******************  </p></td>
        </tr>
      </tbody>
          <tfoot>
      <tr>
        <th class="text-center" colspan="2">  Prepared By: </th>
        <th class="text-center" colspan="6">  Approved By: </th>
      </tr>
      <tr>
        <td class="text-center" colspan="2">
          <br />
          <br />
          <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center" colspan="6">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ (App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]' }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
      </tr>
    </tfoot>
    </table>
    <p style="page-break-after: always;">&nbsp;</p>
    <table class="table table-bordered table-condensed" id="risTable" cellspacing="0" width="100%" style=" font-size: 12px">
      <thead>
          <tr><th class="text-left text-center" colspan="4">RIS</th></tr>
        <tr>
          <th width=50px >RIS No.</th>
          <th width=100px >Office</th>
          <th width=50px >Status</th>
          <th width=100px >Remarks</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ris as $request)
        <tr>
          <td >{{ $request->code }}</td>
          <td >{{ App\Office::find($request->office_id)->name }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->remarks }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan='4' class=""><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
        </tr>
      </tbody>
      <tfoot>
      <tr>
        <th class="text-center" colspan="2">  Prepared By: </th>
        <th class="text-center" colspan="2">  Approved By: </th>
      </tr>
      <tr>
        <td class="text-center" colspan="2">
          <br />
          <br />
          <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center" colspan="2">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ (App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]' }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
      </tr>
    </tfoot>
    </table>
  </div>
@endsection
@section('after_scripts')
<script>
  $(document).ready(function() {
    $('#rsmitable').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
@endsection