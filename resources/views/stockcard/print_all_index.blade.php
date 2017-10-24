{{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  @page { }
  #header
	{
		position: fixed;
	}

  body{
    font-family: 'Times New Roman';
  }
  .page-break { page-break-after: always; }
</style>
    <div id="header" style="position:fixed;margin-bottom:90px;">
        <div class="col-sm-12" style="color: #800000;">
            <div class="clearfix"></div>
            <div>
                <img src="{{ asset('images/logo.png') }}" class="img img-responsive img-circle pull-left" style="height: 64px;width:auto;" />
            </div>
            <div style="margin-left: 5px;">
          		<div style="font-size:10pt;">Republic of the Philippines	</div>
          		<div style="font-size:12pt;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES </div>
          		<div style="font-size:10pt;">Sta. Mesa, Manila  </div>
            </div>
        </div>
        <div class="col-sm-12">
          <hr />
        </div>
    </div>
    @foreach($supplies as $supply)
    <div id="content" class=" {{ ($supplies->last() !== $supply) ? "page-break" : "" }} col-sm-12">
			<table class="table table-striped table-bordered" id="inventoryTable" style="margin-top: 90px;">
				<thead>
          <tr rowspan="3">
              <th class="text-left" colspan="4">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
              <th class="text-left" colspan="4">Fund Cluster:  <span style="font-weight:normal">
              @foreach($supply->purchaseorder as $supplypurchaseorder)
              {{ $supplypurchaseorder->fundcluster."," }}
              @endforeach
              </span> </th>
          </tr>
          <tr rowspan="3">
              <th class="text-left" colspan="4">Item:  <span style="font-weight:normal">{{ $supply->supplytype }}</span> </th>
              <th class="text-left" colspan="4">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
          </tr>
          <tr rowspan="3">
              <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
              <th class="text-left" colspan="4">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
          </tr>
					<tr>
						<th class="col-sm-1">Date</th>
						<th class="col-sm-1">Reference</th>
						<th class="col-sm-1">Receipt Qty</th>
						<th class="col-sm-1">Issue Qty</th>
						<th class="col-sm-1">Office</th>
						<th class="col-sm-1">Balance Qty</th>
						<th class="col-sm-2">Days To Consume</th>
					</tr>
				</thead>
        <tbody>
        @if(count($supply->supplytransaction) > 0)
          @foreach($supply->supplytransaction as $supplytransaction)
          <tr>
            <td>{{ Carbon\Carbon::parse($supplytransaction->date)->toFormattedDateString() }}</td>
            <td>{{ $supplytransaction->reference }}</td>
            <td>{{ $supplytransaction->receiptquantity }}</td>
            <td>{{ $supplytransaction->issuequantity }}</td>
            <td>{{ $supplytransaction->office }}</td>
            <td>{{ $supplytransaction->balancequantity }}</td>
            <td>{{ $supplytransaction->daystoconsume }}</td>
          </tr>
          @endforeach
        @else
        <tr>
          <td colspan=7><p class="text-center">  No record </p></td>
        </tr>
        @endif
        </tbody>
			</table>
    </div>
    @endforeach
    <div id="footer">
      <hr />
      <div class="signature">
        <p>
          <span style=""><strong>Prepared By:</strong>
          <br />
          <br />
          <br />
          <span id="name"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center center" style="font-size:10px;">{{ Auth::user()->office }}</span>
        </p>
      </div>
    </div>
  </div><!-- /.box -->
{{ HTML::script(asset('js/jquery.min.js')) }}
<script>
</script>
