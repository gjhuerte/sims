{{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                  <th class="text-left" colspan="3">Request ID:  <span style="font-weight:normal">{{ $request->id }}</span> </th>
                  <th class="text-left" colspan="3">Requestor:  <span style="font-weight:normal">{{ $request->requestor }}</span> </th>
              </tr>
              <tr rowspan="2">
                  <th class="text-left" colspan="3">Remarks:  <span style="font-weight:normal">{{ $request->remarks }}</span> </th>
                  <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ $request->status }}</span> </th>
              </tr>
              <tr rowspan="2">
                  <th class="text-left" colspan="3">Date Requested:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($request->created_at)->toFormattedDateString() }}</span> </th>
                  <th class="text-left" colspan="3"> <span style="font-weight:normal"></span> </th>
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
              <td>{{ $supplyrequest->supply->supplytype }}</td>
              <td>{{ $supplyrequest->quantity_requested }}</td>
              <td>{{ $supplyrequest->quantity_issued }}</td>
              <td>{{ $supplyrequest->comments }}</td>
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
            <span style=""><strong>Requested By:</strong>
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
