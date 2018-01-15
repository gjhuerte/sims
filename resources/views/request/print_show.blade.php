@extends('layouts.report')
@section('title',"$request->code")
@section('content')
  <style>
      th , tbody{
        text-align: center;
      }
  </style>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="3"></th>
              <th class="text-left" colspan="3">Fund Cluster:  <span style="font-weight:normal"></span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Division:  <span style="font-weight:normal"><u>{{ isset($request->office->name) ? $request->office->name : $request->office }}</span> </u></th>
              <th class="text-left" colspan="3">Responsibility Center Code:  <span style="font-weight:normal"></span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Office: </th>
              <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Remarks:  <span style="font-weight:normal">{{ $request->remarks }}</span> </th>
          </tr>
          <tr>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Quantity Requested</th>
          <th class="col-sm-1">Quantity Issued</th>
          <th class="col-sm-1">Quantity Released</th>
          <th class="col-sm-1">Comments</th>
        </tr>
      </thead>
      <tbody>
        @foreach($request->supplies as $supply)
        <tr>
          <td>{{ $supply->stocknumber }}</td>
          <td>{{ $supply->details }}</td>
          <td>{{ $supply->pivot->quantity_requested }}</td>
          <td>{{ $supply->pivot->quantity_issued }}</td>
          <td>{{ $supply->pivot->quantity_released }}</td>
          <td>{{ $supply->pivot->comments }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="content" class="col-sm-12">
    <table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Purpose:_______________________________________________________________________________________________
                                            <br>_______________________________________________________________________________________________________</th>
          </tr>
      </thead>
    </table>
  </div>
  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1">   </th>
          <th class="col-sm-1">  Requested By: </th>
          <th class="col-sm-1">  Approved By: </th>
          <th class="col-sm-1">  Issued By: </th>
          <th class="col-sm-1">  Received By: </th>
          {{-- <th class="col-sm-1">   </th>
          <th class="col-sm-1">   </th> --}}
        </tr>
      </thead>
      <tbody>
          <td class="text-center">
            Signature:
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
        <tr>
          <td class="text-center">
            Printed Name:
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ (count($request->requestor) > 0) ? $request->requestor->firstname . " " . $request->requestor->lastname : "" }}</span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ isset($approvedby->head) ? $approvedby->head : "" }}</span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"></span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;"> </span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          {{-- <td></td>
          <td></td> --}}
          </tr>
          <tr>
          <td class="text-center">
            Designation:
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">{{user->position}},{{ isset($request->office) ? $request->office->code : "" }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">,{{ isset($approvedby->name) ? $approvedby->code : "" }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection