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
              <th class="text-left" colspan="16">Fund Cluster:  <span style="font-weight:normal"></span> </th>
          </tr>
          <tr rowspan="2">

              <th class="text-left" colspan="6">Division:  
                @if($request->office->head_office == null)
                <span style="font-weight:normal">N/A</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office->headoffice) ? $request->office->headoffice->name : $request->office->name }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="10">Responsibility Center Code:  <span style="font-weight:normal">{{ isset($request->office->code) ? $request->office->code : $request->office }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Office: 
                @if($request->office->head_office == null)
                <span style="font-weight:normal">{{ isset($request->office->name) ? $request->office->name : $request->office }}</span> 
                @else
                <span style="font-weight:normal">{{ isset($request->office) ? $request->office->name : $request->office }}</span> 
                @endif
              </th>
              <th class="text-left" colspan="10">RIS No.:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
          </tr>
          <tr>
              <th class="text-center" colspan="8"> <i> Requisition </i> </th>
              <th width="120px" class="text-center" colspan="4"> <i> Stock Available? </i> </th>
              <th class="text-center" colspan="4"> <i> Issue </i> </th>
          </tr>
          <tr>
            <th colspan="2"  width="75px">Stock No.</th>
            <th colspan="2"  class="col">Unit</th>
            <th colspan="2" >Details</th>
            <th colspan="2" >Quantity</th>
            <th colspan="2"  width="55px">Yes</th>
            <th colspan="2"  width="55px">No</th>
            <th colspan="2" >Quantity </th>
            <th colspan="2" >Remarks</th>
          </tr>
      </thead>
      <tbody>
        @foreach($request->supplies as $key=>$supply)
        <div class="page-break"></div>
        <tr style="font-size: 12px;" class="{{ ((($key+1) % 18) == 0) ? "page-break;" : "" }}">
          <td colspan="2">{{ $supply->stocknumber }}</td>
          <td colspan="2"><span style="font-size: 11px; font-family:'verdana' ">{{ $supply->unit->abbreviation }}</span></td>
          <td colspan="2" class="text-left">
            <span style="font-family:'verdana'; font-size:
            @if(strlen($supply->details) > 50) 9px 
              @elseif(strlen($supply->details) > 40) 11px 
              @elseif(strlen($supply->details) > 20) 12px 
            @else 11px @endif">
              {{ $supply->details }}
            </span>
          </td>
          <td colspan="2" class="text-center">{{ $supply->pivot->quantity_requested }}</td>
          @if($supply->pivot->quantity_issued > 0 && ($request->status == 'approved' || $request->status == 'Approved' || ucfirst($request->status) == 'Released'))
          <td colspan="2" class="text-center"> ✔ </td>
          <td colspan="2" class="text-center">  </td>
          @elseif($supply->pivot->quantity_issued <= 0 && ($request->status == 'approved' || $request->status == 'Approved' || ucfirst($request->status) == 'Released'))
          <td colspan="2" class="text-center">  </td>
          <td colspan="2" class="text-center"> ✔ </td>
          @else
          <td colspan="2" class="text-center"></td>
          <td colspan="2" class="text-center">  </td>
          @endif
          <td colspan="2">{{ $supply->pivot->quantity_issued }}</td>
          <td colspan="2">{{ $supply->pivot->comments }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="2">***</td>
          <td colspan="2">***</td>
          <td colspan="2" class="text-center"> *** Nothing Follows ***  </td>
          <td colspan="2">***</td>
          <td colspan="2">***</td>
          <td colspan="2">***</td>
          <td colspan="2">***</td>
          <td colspan="2">***</td>
        </tr>
      </tbody>
      <!-- Purpose -->
      <tfoot>
        <tr>
              <td class="text-left" colspan="16"><span style="font-size: 15px; "><b>Purpose:</b></span></td>
          </tr>
        <tr>
          <td  colspan="16">
            <p class="text-left" word-wrap="break-word;">{{ $request->purpose }}<p>
            <hr color=#00000 />
          </td>
        </tr>
        <!-- Signatories Header-->
        <tr>
          <th colspan="4" width="105px">   </td>
          <th colspan="1" width=225px>  Requested By: </td>
          <th colspan="1" width=225px>  Approved By: </td>
          <th colspan="5" class="col-xs-2">  Issued By: </td>
          <th colspan="5" class="col-xs-2">  Received By: </td>
        </tr>
        <!-- Signatories Signature-->
        <tr>
          <td colspan="4" class="text-left">Signature:</td>
          <td colspan="1" class="text-center">          </td>
          <td colspan="1" class="text-center">          </td>
          <td colspan="5" class="text-center">          </td>
          <td colspan="5" class="text-center">          </td>
        </tr>
        <!-- Signatories Name-->
        <tr>
          <td colspan="4" class="text-left">  Printed Name:</td>
          <td colspan="1" class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px; " word-wrap="break-word;"> {{ isset($signatory->id) ? $signatory->requestor_name : isset($office->name) ? $office->head != "None" ?$office->head : "" : "" }}</span>
            <br />
          </td>
          <td colspan="1" class="text-center">
            <span id="name" style="margin-top: 30px; font-size: 15px;">{{isset($signatory->id) ? $signatory->approver_name : isset($sector->name) ? $sector->head : $request->office->head }}</span>
            <br />  
          </td>
          <td colspan="5" class="text-center">  </td>
          <td colspan="5" class="text-center">  </td>
        </tr>
        <!-- Signatories Designation-->
        <tr>
          <td colspan="4" class="text-left">Designation:</td>
          <td colspan="1" class="text-center">
            <span id="office" class="text-center" style="font-size:10px;" word-wrap="break-word;"> 
              {{  isset($signatory->id) ? $signatory->requestor_designation: isset($office->name) ? $office->head_title != "None" ? $office->head_title : "" : "" }}</span>
          </td>
          <td colspan="1" class="text-center">
            <span id="office" class="text-center" style="font-size:10px;">
              {{ isset($signatory->id) ? $signatory->approver_designation : isset($sector->head) ? $sector->head_title : $request->office->head_title }}</span>
          </td>
          <td colspan="5" class="text-center">          </td>
          <td colspan="5" class="text-center">          </td>
        </tr>
        <!-- Signatories Date-->
        <tr>
          <td colspan="4" class="text-left">Date:</td>
          <td colspan="1" class="text-center"> </td>
          <td colspan="1" class="text-center"> </td>
          <td colspan="5" class="text-center"> </td>
          <td colspan="5" class="text-center"> </td>
        </tr>
          <td colspan="16" style="border: none; font-size: 14px;"> <b>
            *This request is valid for 3 working days (5 days for Branches and Campuses) upon approval after which, if items are not picked up, the request is automatically <span class="text-danger"> cancelled</span>.
            @if(isset($sector->code) == 'OVPBSC')
             <br>*Request will expire on <span class="text-danger">{{ $request->created_at->addWeekdays(5)}} </span>
            @else
             <br>*Request will expire on <span class="text-danger">{{ $request->created_at->addWeekdays(3)}} </span>
            @endif
          <br>*Supplies and Materials will be released <span class="text-danger">only </span> to authorized personnel of the requesting office.  
          <br>*Please pay attention to the <span class="text-danger">UNIT</span> of the item. The unit of measurement to be followed is in the unit column above  </b>
        </td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection