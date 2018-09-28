<tr>
  <th class="text-left" colspan="7">Entity Name:  <span style="font-weight:normal">{{ $supply->entity_name }}</span> </th>
  <th class="text-left" colspan="7">Fund Cluster:
    <span style="font-weight:normal"> 
    @if(isset($supply->purchaseorder))
      @foreach($supply->purchaseorder as $supplypurchaseorder) {{ $supplypurchaseorder->fundcluster }}
        @if($supply->purchaseorder->first() != $supplypurchaseorder && $supply->purchaseorder->last() != $supplypurchaseorder),  
        @endif
      @endforeach
    @endif
    </span> 
  </th>
</tr>
<tr>
    <th class="text-left" colspan="7">Item:
      <span style="font-weight:normal; 
      @if(strlen($supply->details) > 0)
        @if(strlen($supply->details) > 60) font-size: 10px; 
        @elseif(strlen($supply->details) > 40) font-size: 11px; 
        @elseif(strlen($supply->details) > 20) font-size: 12px; 
        @endif 
      @endif">{{ $supply->details }}
      </span> </th>
    <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
</tr>
<tr>
    <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
    <th class="text-left" colspan="7">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
</tr>
<tr rowspan="2">
    <th class="text-center" colspan="2"></th>
    <th class="text-center" colspan="3">Receipt</th>
    <th class="text-center" colspan="3">Issue</th>
    <th class="text-center" colspan="3">Balance</th>
</tr> 
<tr>
  <th class="text-center">Date</th>
  <th class="text-center">Reference</th>
  <th class="text-center">Qty</th>
  <th class="text-center">Unit Cost</th>
  <th class="text-center">Total Cost</th>
  <th class="text-center">Qty</th>
  <th class="text-center">Unit Cost</th>
  <th class="text-center">Total Cost</th>
  <th class="text-center">Qty</th>
  <th class="text-center">Unit Cost</th>
  <th class="text-center">Total Cost</th>
</tr> 