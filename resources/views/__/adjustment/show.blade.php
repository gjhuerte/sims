@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">{{ $adjustment->code }}</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('adjustment') }}">Adjustment</a></li>
			<li class="active"> {{ $adjustment->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="adjustmentTable" cellspacing="0" width="100%"	>
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="3">Adjustment Slip:  <span style="font-weight:normal">{{ $adjustment->code }}</span> </th>
		                <th class="text-left" colspan="3">Created By:  <span style="font-weight:normal">{{ $adjustment->created_by }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="6">Details:  <span style="font-weight:normal">{{ $adjustment->details }}</span> </th>
		            </tr>
		            <tr>
						<th>Stock Number</th>
						<th>Details</th>
						<th>Quantity</th>
						<th>Unit Cost</th>
						<th>Amount</th>
						<th>Notes</th>
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

    var table = $('#adjustmentTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("adjustment/$adjustment->id") }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "details" },
					{ data: "pivot.quantity" },
					{ data: "pivot.unitcost" },
					{ data: function(callback){
						return parseFloat(callback.pivot.quantity * callback.pivot.unitcost).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					} },
			],
    });

    $('div.toolbar').html(`
         <a href="{{ url("adjustment/$adjustment->id/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Print</span>
        </a>
    `)

	} );
</script>
@endsection
