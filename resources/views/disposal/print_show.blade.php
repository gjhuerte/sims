@extends('layouts.report')
@section('title',"$disposal->code")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }

      .signature-helper {
        border: none;
        height: 1px;
        /* Set the hr color */
        color: #333; /* old IE */
        background-color: #333; /* Modern Browsers */
      }
  </style>
  <div id="main-title" class="col-sm-12">
    <h3 class="text-center" style="color: #21211f;"> WASTE MATERIALS REPORT </h3>
  </div>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Place Of Storage:  
                <span style="font-weight:normal">{{ App\Office::findByCode(Auth::user()->office)->name }}</span> 
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Date Disposed:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($disposal->created_at)->toFormattedDateString() }}</span> </th>
              <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ isset($disposal->status) ? $disposal->status : ucfirst(config('app.default_status')) }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Remarks:  <span style="font-weight:normal">{{ $disposal->remarks }}</span> </th>
          </tr>
          <tr>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Quantity</th>
          <th class="col-sm-1">Unit Cost</th>
          <th class="col-sm-1">Amount</th>
          <th class="col-sm-1">Comments</th>
        </tr>
      </thead>
      <tbody>
        @foreach($disposal->supplies as $supply)
        <tr>
          <td>{{ $supply->stocknumber }}</td>
          <td>{{ $supply->details }}</td>
          <td>{{ $supply->pivot->quantity }}</td>
          <td>{{ $supply->pivot->unitcost }}</td>
          <td>{{ number_format($supply->pivot->quantity * $supply->pivot->unitcost, 2) }}</td>
          <td>{{ $supply->pivot->comments }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th colspan="6" class="text-left" style="font-weight: normal;font-style: italic">Certified Correct</th>
        </tr>
        <tr>
          <th class="col-sm-1">   </th>
          <th class="col-sm-1 pull-left">  Approved By: </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px;"> <hr class="signature-helper" /> </span>
            <span id="office" class="text-center" style="font-size:10px;">Signature over Printed Name of Supply and/or Property Custodian</span>
          </td>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> <hr class="signature-helper" /> </span>
            <span id="office" class="text-center" style="font-size:10px;">Signature over Printed Name of Supply and/or Property Custodian</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="additionals" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th colspan="6">Certified of Inspection</th>
        </tr>
      </thead>
      <tbody>       
        <tr>
          <td>
            <span style="font-style: italic; text-align: left;">I hereby certify that the property enumerated above was disposed of as follows:</span>
            <br />
            <br />
            <br />
            <span class="text-justify" style="margin-top: 50px;">{{ isset($disposal->details) ? $disposal->details : "[ No details specified ]" }}</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="footer_additionals" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1">  Certified Correct: </th>
          <th class="col-sm-1">  Witness to Disposal: </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px;"> <hr class="signature-helper" /> </span>
            <span id="office" class="text-center" style="font-size:10px;">Signature over Printed Name of Inspection Officer</span>
          </td>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> <hr class="signature-helper" /> </span>
            <span id="office" class="text-center" style="font-size:10px;">Signature over Printed Name of Witness</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection