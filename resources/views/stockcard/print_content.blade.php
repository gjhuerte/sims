
<table class="table table-striped table-bordered table-condensed" id="inventoryTable" width="100%" cellspacing="0" style="font-size: 12px"> 
  <thead>
    <tr>
      <th class="text-left" colspan="5" style="font-family:verdana;">Item:
        <span style="font-weight:normal; 
        @if(strlen($supply->details) > 0)
          @if(strlen($supply->details) > 80) font-size: 11px; 
          @elseif(strlen($supply->details) > 60) font-size: 12px; 
          @elseif(strlen($supply->details) > 20) font-size: 13px; 
          @endif 
        @endif">{{ $supply->details }}
      </span> </th>
      <th class="text-left" colspan="2" style="font-family:verdana;">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
    </tr> 
    <tr>
      <th class="text-left" colspan="5" style="font-family:verdana;">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
      <th class="text-left" colspan="2" style="font-family:verdana;">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
    </tr>
    <tr>
      <th width= 90px >Date</th>
      <th width= 90px >Reference</th>
      <th width= 50px style="text-align: center;" >Receipt<br>Qty</th>
      <th width= 40px style="text-align: center;" >Issue<br>Qty</th>
      <th width= 440px >Office</th>
      <th width= 75px style="text-align: center;" >Balance<br>Qty</th>
      <th width= 75px >Days To <br> Consume</th>
    </tr>
  </thead>
  <tbody style="font-size: 11px">
    @if(count($supply->stockcards) > 0)
    @foreach($supply->stockcards as $stockcard)
    <tr>
      <td >{{ Carbon\Carbon::parse($stockcard->date)->toFormattedDateString() }}</td>
      <td>{{ $stockcard->reference_information }}</td>
      <td style="text-align: right;">{{ $stockcard->received_quantity }}</td>
      <td style="text-align: right;">{{ $stockcard->issued_quantity }}</td>
      <td>
      <span style="font-weight:normal; 
        @if(strlen($stockcard->organization) > 0)
          @if(strlen($stockcard->organization) > 60) font-size: 12px; 
          @elseif(strlen($stockcard->organization) > 40) font-size: 12px; 
          @elseif(strlen($stockcard->organization) > 20) font-size: 12px; 
          @endif 
        @endif">{{ $stockcard->organization }}
      </span> </td>
      <td style="text-align: right;">{{ $stockcard->balance_quantity }}</td>
      <td class="col-sm-1">{{ $stockcard->daystoconsume == 'Not Applicable' ? 'N/A': $stockcard->daystoconsume}}</td>
    </tr>
    @endforeach

    @else
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
    </tr>
    @endif
  </tbody>
</table>
