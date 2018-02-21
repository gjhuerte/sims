@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Inspection No. {{ $inspection->code }}</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inspection') }}">Inspection No. {{ $inspection->code }}</a></li>
			<li class="active"> {{ $inspection->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">

    @include('errors.alert')
		<div class="panel panel-body table-responsive">

      <legend>
        <h3> Inspection No. {{ $inspection->code }} <small> {{ $inspection->status }} </small> </h3>
      </legend>

			<table class="table table-hover table-striped table-bordered table-condensed" id="inspectionTable" cellspacing="0" width="100%"	>
				<thead>
          @php
            $division = 2;
          @endphp
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">P.O. Number :  <span style="font-weight:normal">{{ $inspection->purchaseorder_number }}</span> </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Received : <span style="font-weight:normal">{{ Carbon\Carbon::parse($inspection->date_delivered)->toFormattedDateString() }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Receipt Number: <span style="font-weight:normal">{{ $inspection->receipt_number }}</span>
              </th>
              <th class="text-left" colspan="{{ $division }}">
                 Supplier: <span style="font-weight:normal">{{ $inspection->supplier }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Submitted By:  <span style="font-weight:normal">{{ isset($inspection->received_by) ? App\User::find($inspection->received_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Submitted: <span style="font-weight:normal">{{ Carbon\Carbon::parse($inspection->created_at)->toFormattedDateString() }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Approved By:  <span style="font-weight:normal">{{ isset($inspection->verified_by) ? App\User::find($inspection->verified_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Approved: <span style="font-weight:normal">{{ isset($inspection->verified_on) ? Carbon\Carbon::parse($inspection->verified_on)->toFormattedDateString() : "" }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">
                Finalized By:  <span style="font-weight:normal">{{ isset($inspection->finalized_by) ? App\User::find($inspection->finalized_by)->fullname : "" }}</span> 
              </th>
              <th class="text-left" colspan="{{ $division }}">
                Date Finalized: <span style="font-weight:normal">{{ isset($inspection->finalized_on) ? Carbon\Carbon::parse($inspection->finalized_on)->toFormattedDateString() : "" }}</span>
              </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="{{ $division }}">Remarks:  <span style="font-weight:normal">{{ isset($inspection->remarks->sortBy('created_at')->first()->description) ? $inspection->remarks->sortByDesc('created_at')->first()->description : "" }}</span> </th>
              <th class="text-left" colspan="{{ $division }}"> </th>
          </tr>
          <tr>
						<th>Stock Number</th>
						<th>Details</th>
            <th>Unit</th>
						<th>Quantity</th>
						<th>Quantity Approved</th>
						<th>Final Quantity</th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

    var table = $('#inspectionTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("inspection/$inspection->id") }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "details" },
          { data: "unit_name" },
					{ data: "quantity_received" },
					{ data: "quantity_adjusted" },
					{ data: "quantity_final" }
			],
    });

    $('div.toolbar').html(`
         <a href="{{ url("inspection/$inspection->id/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Print</span>
        </a>     

        @if($inspection->status == App\Inspection::$status_list[4] && Auth::user()->access == 1)
        <a id="apply" href="{{ url("inspection/$inspection->id/apply") }}" class="btn btn-sm btn-primary ladda-button" data-style="zoom-in">
          <span class="ladda-label"><i class="glyphicon glyphicon-share-alt"></i> Apply to Inventory</span>
        </a>
        @endif

        @if( ( in_array($inspection->status, [ App\Inspection::$status_list[0], App\Inspection::$status_list[1] ]) || $inspection->status == null) && Auth::user()->access == 4 )
        <a type="button" href="{{ url("inspection/$inspection->id/approve") }}" data-id="{{ $inspection->id }}" class="accept btn btn-success btn-sm">
            <i class="fa fa-thumbs-up" aria-hidden="true"> Accept</i>
        </a>
        @elseif(in_array($inspection->status, [ App\Inspection::$status_list[2], App\Inspection::$status_list[3] ]) && Auth::user()->access == 5)
        <a type="button" href="{{ url("inspection/$inspection->id/approve") }}" data-id="{{ $inspection->id }}" class="accept btn btn-success btn-sm">
            <i class="fa fa-thumbs-up" aria-hidden="true"> Accept</i>
        </a>
        @endif
    `)

	} );
</script>
@endsection
