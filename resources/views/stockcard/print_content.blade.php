
<table class="table table-striped table-bordered" id="inventoryTable" width="100%" cellspacing="0"> 
  <thead>
    <tr>
      <th class="text-left" colspan="4">Item:
        <span style="font-weight:normal; 
        @if(strlen($supply->details) > 0)
          @if(strlen($supply->details) > 60) font-size: 10px; 
          @elseif(strlen($supply->details) > 40) font-size: 11px; 
          @elseif(strlen($supply->details) > 20) font-size: 12px; 
          @endif 
        @endif">{{ $supply->details }}
      </span> </th>
      <th class="text-left" colspan="3">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
    </tr> 
    <tr>
      <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
      <th class="text-left" colspan="3">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
    </tr>
    <tr>
      <th class="col-sm-1">Date</th>
      <th class="col-sm-1">Reference</th>
      <th class="col-sm-1">Receipt<br>Qty</th>
      <th class="col-sm-1">Issue<br>Qty</th>
      <th class="col-sm-1">Office</th>
      <th class="col-sm-1">Balance Qty</th>
      <th class="col-sm-1">Days To <br> Consume</th>
    </tr>
  </thead>
  <tbody>
    @if(count($supply->stockcards) > 0)
    @foreach($supply->stockcards as $stockcard)
    <tr>
      <td>{{ Carbon\Carbon::parse($stockcard->date)->toFormattedDateString() }}</td>
      <td>{{ $stockcard->reference }}</td>
      <td>{{ $stockcard->received_quantity }}</td>
      <td>{{ $stockcard->issued_quantity }}</td>
      <td>
      <span style="font-weight:normal; 
        @if(strlen($stockcard->organization) > 0)
          @if(strlen($stockcard->organization) > 60) font-size: 12px; 
          @elseif(strlen($stockcard->organization) > 40) font-size: 13px; 
          @elseif(strlen($stockcard->organization) > 20) font-size: 14px; 
          @endif 
        @endif">{{ $stockcard->organization }}
      </span> </td>
      <td>{{ $stockcard->balance_quantity }}</td>
      <td class="col-sm-1">{{ $stockcard->daystoconsume }}</td>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  No record </p></td>
    </tr>
    @endif
  </tbody>
</table>  
