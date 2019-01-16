@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Physical Inventory</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Physical Inventory</a></li>
			<li class="active">Home</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
<div class="box" style="padding:10px">
    <div class="box-body">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Stock Number</th>
						<th>Description</th>
						<th>Unit</th>
						<th>Quantity</th>
						<th>Remarks</th>
					</tr>
				</thead>
			</table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

	    var table = $('#inventoryTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"columnDefs":[
				{ "type": "date", "targets": 0 },
			],
			"order": [
				[0, 'desc']
			],
			"processing": true,
			ajax: '{{ url("inventory/physical") }}',
			columns: [
					{ data: "stocknumber"},
					{ data: "supply.details" },
					{ data: "supply.unit_name"},
					{ data: "received_quantity"},
					{ data: function(){
						return ""
					} },
			],
	    });

	 	$("div.toolbar").html(`
	       <a href="{{ url("inventory/physical/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	        <span id="nav-text"> Download</span>
	      </a>
		`);
	} );
</script>
@endsection
