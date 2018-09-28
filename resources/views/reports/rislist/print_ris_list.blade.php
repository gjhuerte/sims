@extends('layouts.report')
@section('content')
    <table class="table table-bordered table-condensed" id="risTable" cellspacing="0"  style="table-layout: fixed; font-size: 12px">
      <thead>
        <tr><th colspan="11"  style="color: #800000;">
              <span style="font-size:13pt;">Republic of the Philippines  </span><br>
              <span style="font-size:12pt;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES </span><br>
              <span style="font-size:10pt;">Sta. Mesa, Manila   </span><span class="pull-right"> {{ Carbon\Carbon::now()->toDayDateTimeString() }} </span>
        </th></tr>
          <tr><th class="text-left text-center" colspan="11">RIS List of {{ $month }}</th></tr>
        <tr>
          <th width="70px">RIS No.</th>
          <th width="100px">Office</th>
          <th width="10px">Purpose</th>
          <th width="10px">Status</th>
          <th width="10px">Remarks</th>
          <th width="10px">Created by</th>
          <th width="10px">Date Created</th>
          <th width="10px">Processed by</th>
          <th width="10px">Date Processed</th>
          <th width="10px">Released by</th>
          <th width="10px">Date Release</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ris as $request)
        <tr>
          <td >{{ $request->request_number }}</td>
          <td >{{ $request->office }}</td>
          <td >{{ $request->purpose }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->remarks }}</td>
          <td >{{ $request->requested_by }}</td>
          <td >{{ Carbon\Carbon::parse($request->created_at)->format('M d H:i') }}</td>
          <td >{{ $request->issued_by }}</td>
          <td >{{ Carbon\Carbon::parse($request->approved_at)->format('M d H:i') }}</td>
          <td >{{ $request->released_by }}</td>
          <td >{{ Carbon\Carbon::parse($request->released_at)->format('M d H:i') }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan='11' class=""><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
        </tr>
      </tbody>
      <tfoot>
      <tr>
        <th class="text-center" colspan="5">  Prepared By: </th>
        <th class="text-center" colspan="6">  Approved By: </th>
      </tr>
      <tr>
        <td class="text-center" colspan="5">
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
@endsection