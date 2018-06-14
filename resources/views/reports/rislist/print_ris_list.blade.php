@extends('layouts.report')
@section('content')
    <table class="table table-bordered table-condensed" id="risTable" cellspacing="0" width="100%" style=" font-size: 12px">
      <thead>
          <tr><th class="text-left text-center" colspan="4">RIS</th></tr>
        <tr>
          <th>RIS No.</th>
          <th>Office</th>
          <th>Purpose</th>
          <th>Status</th>
          <th>Remarks</th>
          <th>Date Created</th>
          <th>Created by</th>
          <th>Date Processed</th>
          <th>Processed by</th>
          <th>Date Release</th>
          <th>Released by</th>
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
          <td >{{ $request->created_at }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->status }}</td>
          <td >{{ $request->status }}</td>
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
@endsection