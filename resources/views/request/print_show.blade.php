@extends('layouts.report')
@section('title',"$request->code")
@section('content')
  <style>
      th , tbody{
        text-align: center;
        font-size: 12px;
      }

      #content{
        font-family: "Arial";
        font-size: 12px;
      }

      @media print {
          .page-break  { display: block; page-break-after:always; }
      }   

  </style>
  <div id="content" class="col-sm-12">
    <h4 class="text-center">REQUISITION AND ISSUE SLIP  <small class="pull-right">Appendix 63</small></h4>
    <table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0">
      <thead>
          <tr rowspan="2">
              <th class="text-left" colspan="8">Fund Cluster:  <span style="font-weight:normal"></span> </th>
          </tr>
          <tr rowspan="2">

              <th class="text-left" colspan="3">Division:  
                @if($request->office->head_office == null)
                <span style="font-weight:normal">N/A</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office->headoffice) ? $request->office->headoffice->name : $request->office->name }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="5">Responsibility Center Code:  <span style="font-weight:normal">{{ isset($request->office->code) ? $request->office->code : $request->office }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Office: 
                @if($request->office->head_office == null)
                <span style="font-weight:normal">{{ isset($request->office->name) ? $request->office->name : $request->office }}</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office) ? $request->office->name : $request->office }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="5">RIS No.:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
          </tr>
          <tr>
              <th class="text-center" colspan="4"> <i> Requisition </i> </th>
              <th width="100px" class="text-center" colspan="2"> <i> Stock Available? </i> </th>
              <th class="text-center" colspan="2"> <i> Issue </i> </th>
          </tr>
          <tr>
            <th width="65px">Stock No.</th>
            <th class="col">Unit</th>
            <th>Details</th>
            <th>Quantity</th>
            <th width="55px">Yes</th>
            <th width="55px">No</th>
            <th>Quantity </th>
            <th>Remarks</th>
          </tr>
      </thead>
      <tbody>
        @foreach($request->supplies as $key=>$supply)
        <div class="page-break"></div>
        <tr style="font-size: 12px;" class="{{ ((($key+1) % 18) == 0) ? "page-break;" : "" }}">
          <td>{{ $supply->stocknumber }}</td>
          <td><span style="font-size: 11px; font-family:'verdana' ">{{ $supply->unit->abbreviation }}</span></td>
          <td class="text-left">
            <span style="font-family:'verdana'; font-size:
            @if(strlen($supply->details) > 50) 9px 
              @elseif(strlen($supply->details) > 40) 11px 
              @elseif(strlen($supply->details) > 20) 12px 
            @else 11px @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td class="text-center">{{ $supply->pivot->quantity_requested }}</td>
          @if($supply->pivot->quantity_issued > 0 && ($request->status == 'approved' || $request->status == 'Approved'))
          <td class="text-center"> ✔ </td>
          <td class="text-center">  </td>
          @elseif($supply->pivot->quantity_issued <= 0 && ($request->status == 'approved' || $request->status == 'Approved'))
          <td class="text-center">  </td>
          <td class="text-center"> ✔ </td>
          @else
          <td class="text-center"></td>
          <td class="text-center">  </td>
          @endif
          <td>{{ $supply->pivot->quantity_issued }}</td>
          <td>{{ $supply->pivot->comments }}</td>
        </tr>
        @endforeach
        <tr>
          <td>***</td>
          <td>***</td>
          <td class="text-center"> *** Nothing Follows ***  </td>
          <td>***</td>
          <td>***</td>
          <td>***</td>
          <td>***</td>
          <td>***</td>
        </tr>
        @for($ctr = 0 ; $ctr < $end; $ctr++)
        <tr>
          <td style="padding: 15px;"></td>
          <td></td>
          <td></td>
          <td class="text-center">  </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        @endfor
        <!-- Purpose -->
        <tr>
              <td class="text-left" colspan="8"><span style="font-size: 15px; "><b>Purpose:</b></span></td>
          </tr>
        <tr>
          <td  colspan="8">
            <p class="text-left" word-wrap="break-word;">{{ $request->purpose }}<p>
            <hr class="col-sm-12" color="black" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="footer" class="col-sm-12">
    <table class="table table-bordered table-condensed" style="table-layout:fixed;">
      <tbody>
        
        <!-- Signatories Header -->
        <tr>
          <td width="90px">   </td>
          <td class="col-sm-1">  Requested By: </td>
          <td class="col-sm-1">  Approved By: </td>
          <td class="col-xs-2">  Issued By: </td>
          <td class="col-xs-2">  Received By: </td>
        </tr>
        <tr>
          <td class="text-left">
            Signature:
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
          <td class="text-center">
          </td>
        </tr>

        <tr>
          <td class="text-left">
            Printed Name:
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px; " word-wrap="break-word;"> {{ isset($signatory->id) ? $signatory->requestor_name : isset($office->name) ? $office->head != "None" ?$office->head : "" : "" }}</span>
            <br />
          </td>
          <td class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;">{{isset($signatory->id) ? $signatory->approver_name : isset($sector->name) ? $sector->head : $request->office->head }}</span>
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
        </tr>

        <tr>
          <td class="text-left">
            Designation:
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;" word-wrap="break-word;"> 
              {{  isset($signatory->id) ? $signatory->requestor_designation: isset($office->name) ? $office->head_title != "None" ? $office->head_title : "" : "" }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">
              {{ isset($signatory->id) ? $signatory->approver_designation : isset($sector->head) ? $sector->head_title : $request->office->head_title }}</span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
          <td class="text-center">
            <span id="office" class="text-center" style="font-size:10px;"></span>
          </td>
        </tr>

        <tr>
          <td class="text-left">
            Date:
          </td>
          <td class="text-center"> </td>
          <td class="text-center"> </td>
          <td class="text-center"> </td>
          <td class="text-center"> </td>
        </tr>


      </tbody>
    </table>

    <div class="col-sm-12" style="font-size: 12px;">
      <ul class="list-unstyled">
        <li>
          <p class="text-justified">This request is valid for 3 working days upon approval after which, if items are not picked up, the request is automatically <span class="text-danger"> cancelled</span>.</p> 
        </li>
        <li>
          <p class="text-justified">
            Supplies and Materials will be released <span class="text-danger">only </span> to authorized personnel of the requesting office.  
          </p>
        </li>
      </ul>
    </div>

  </div>
@endsection