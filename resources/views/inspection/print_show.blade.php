@extends('layouts.report')
@section('title',"$inspection->code")
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
    <h4 class="text-center">Inspection No. {{ $inspection->code }} <small class="pull-right"></small></h4>
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          @php
            $division = 3;
          @endphp
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">P.O. Number :  <span style="font-weight:normal">{{ $inspection->purchaseorder_number }}</span> </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Received : <span style="font-weight:normal">{{ Carbon\Carbon::parse($inspection->date_delivered)->toFormattedDateString() }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Receipt Number: <span style="font-weight:normal">{{ $inspection->receipt_number }}</span>
              </th>
              <th class="text-left" colspan="{{ $division }}">
                 Supplier: <span style="font-weight:normal">{{ $inspection->supplier }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Submitted By:  <span style="font-weight:normal">{{ isset($inspection->received_by) ? App\User::find($inspection->received_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Submitted: <span style="font-weight:normal">{{ Carbon\Carbon::parse($inspection->created_at)->toFormattedDateString() }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Approved By:  <span style="font-weight:normal">{{ isset($inspection->verified_by) ? App\User::find($inspection->verified_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Approved: <span style="font-weight:normal">{{ isset($inspection->verified_on) ? Carbon\Carbon::parse($inspection->verified_on)->toFormattedDateString() : "" }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Finalized By:  <span style="font-weight:normal">{{ isset($inspection->finalized_by) ? App\User::find($inspection->finalized_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Finalized: <span style="font-weight:normal">{{ isset($inspection->finalized_on) ? Carbon\Carbon::parse($inspection->finalized_on)->toFormattedDateString() : "" }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">Remarks:  <span style="font-weight:normal">{{ isset($inspection->remarks->sortBy('created_at')->first()->description) ? $inspection->remarks->sortBy('created_at')->first()->description : "" }}</span> </th>
              <th class="text-left" colspan="{{ $division }}"> </th>
          </tr>
          <tr>
            <th>Stock Number</th>
            <th>Details</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Quantity Approved</th>
            <th>Final Quantity</th>
          </tr>
      </thead>
      <tbody>
        @foreach($inspection->supplies as $key=>$supply)
        <tr style="font-size: 12px;">
          <td>{{ $supply->stocknumber }}</td>
          <td>
            <span style="font-size:@if(strlen($supply->details) > 50) 7px @elseif(strlen($supply->details) > 40) 9px @elseif(strlen($supply->details) > 20) 10px @else 11px @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td>{{ $supply->unit_name }}</td>
          <td>{{ $supply->pivot->quantity_received }}</td>
          <td>{{ $supply->pivot->quantity_adjusted }}</td>
          <td>{{ $supply->pivot->quantity_final }}</td>
        </tr>
        <tr>
          <td style="padding: 15px;">*****</td>
          <td>*****</td>
          <td class="text-center"> ***Nothing Follows***  </td>
          <td>*****</td>
          <td>*****</td>
          <td>*****</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1"> Inspection Officer</th>
          <th class="col-sm-1"> Approved By</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td class="text-center text-muted" style="opacity: 0.5; padding-top: 4%;">Signature over Printed Name</td>
          <td class="text-center text-muted" style="opacity: 0.5; padding-top: 4%;">Signature over Printed Name</td>
        </tr>

        <tr>
          <td class="text-center text-muted" style="opacity: 0.5">Position</td>
          <td class="text-center text-muted" style="opacity: 0.5">Position</td>
        </tr>

        <tr>
          <td class="text-center text-muted" style="opacity: 0.5">Date</td>
          <td class="text-center text-muted" style="opacity: 0.5">Date</td>
        </tr>


      </tbody>
    </table>

  </div>
@endsection