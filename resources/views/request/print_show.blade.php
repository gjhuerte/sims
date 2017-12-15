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
              <th class="text-left" colspan="3">Request Slip:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
              <th class="text-left" colspan="3">Requestor:  <span style="font-weight:normal">{{ isset($request->officeInfo->name) ? $request->officeInfo->name : $request->office }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Date Requested:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($request->created_at)->toFormattedDateString() }}</span> </th>
              <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ isset($request->status) ? $request->status : 'Undecided' }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Remarks:  <span style="font-weight:normal">{{ $request->remarks }}</span> </th>
          </tr>
          <tr>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Quantity Requested</th>
          <th class="col-sm-1">Quantity Issued</th>
          <th class="col-sm-1">Comments</th>
        </tr>
      </thead>
      <tbody>
        @foreach($supplyrequests as $supplyrequest)
        <tr>
          <td>{{ $supplyrequest->stocknumber }}</td>
          <td>{{ $supplyrequest->supply->details }}</td>
          <td>{{ $supplyrequest->quantity_requested }}</td>
          <td>{{ $supplyrequest->quantity_issued }}</td>
          <td>{{ $supplyrequest->comments }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="footer" class="col-sm-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-sm-1">  Requested By: </th>
          <th class="col-sm-1">  Approved By: </th>
          <th class="col-sm-1">  Issued By: </th>
          <th class="col-sm-1">  Received By: </th>
          {{-- <th class="col-sm-1">   </th>
          <th class="col-sm-1">   </th> --}}
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ isset($request->requestorInfo->firstname) ? $request->requestorInfo->firstname : "" }} {{ isset($request->requestorInfo->lastname) ? $request->requestorInfo->lastname : "" }}</span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;">{{ isset($request->requestorInfo->officeInfo->name) ? $request->requestorInfo->officeInfo->name : "" }}</span>
          </td>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ isset($approvedby->head) ? $approvedby->head : "" }}</span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;">{{ isset($approvedby->name) ? $approvedby->name : "" }}</span>
          </td>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"></span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <br />
            <br />
            <span id="name" style="margin-top: 30px; font-size: 15px;"> </span>
            <br />
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          {{-- <td></td>
          <td></td> --}}
        </tr>
      </tbody>
    </table>
  </div>
@endsection