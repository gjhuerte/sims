{{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .pagebreak { page-break-before: always; }
</style>
<div class="container">
<!-- Default box -->
  <div class="box">
    <div class="box-body" id="printArea">
      <div id="header">
          <div style="color: #800000;" class="center-block">
              <div class="col-lg-4">
                  <img class="pull-right" src="{{ asset('images/logo.png') }}" style="height: 64px;width:auto;" />
              </div>
              <div class="col-lg-8" style="white-space:nowrap;margin:0px;padding:0px;">
                      <p style="margin:0;padding:0;"><strong>Polytechnic University Of the Philippines</strong></p>
                      <p style="margin:0;padding:0;">Sta. Mesa, Manila</p>
                      {{ config('app.name', 'Supplies Inventory Management System') }}
              </div>
          </div>
      </div>
      <div style="margin-top:10px;">
  			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
  				<thead>
  		            <tr rowspan="2">
  		                <th class="text-left" colspan="4">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
  		                <th class="text-left" colspan="4">Fund Cluster:  <span style="font-weight:normal">
  		                @foreach($supply->purchaseorder as $supplypurchaseorder)
  		                {{ $supplypurchaseorder->fundcluster."," }}
  		                @endforeach
  		                </span> </th>
  		            </tr>
  		            <tr rowspan="2">
  		                <th class="text-left" colspan="4">Item:  <span style="font-weight:normal">{{ $supply->supplytype }}</span> </th>
  		                <th class="text-left" colspan="4">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
  		            </tr>
  		            <tr rowspan="2">
  		                <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
  		                <th class="text-left" colspan="4">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
  		            </tr>
  					<tr>
  						<th>Date</th>
  						<th>Reference</th>
  						<th>Receipt Qty</th>
  						<th>Issue Qty</th>
  						<th>Office</th>
  						<th>Balance Qty</th>
  						<th>Days To Consume</th>
  					</tr>
  				</thead>
          <tbody>
            @foreach($supplytransaction as $supplytransaction)
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
            <tr>
              <td colspan=7><p class="text-center">  ** Nothing Follows ** </p></td>
            </tr>
          </tbody>
  			</table>
      </div>
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
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>
{{ HTML::script(asset('js/jquery.min.js')) }}
<script>
</script>
