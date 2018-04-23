@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supply Ledger Summary</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Inventory</a></li>
			<li class="active">{{ $supply->stocknumber }}</li>
			<li class="active">Supply Ledger</li>
			<li class="active">Summary</li>
		</ul>
	</section>
@endsection

@section('content')
<style>
	.wordwrap{
		wordwrap: break-word;
	}
</style>
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="14">Entity Name:  <span style="font-weight:normal">{{ $supply->entity_name }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Item:  <span style="font-weight:normal">{{ $supply->details }}</span> </th>
		                <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
		                <th class="text-left" colspan="7">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-center" colspan="2"></th>
		                <th class="text-center" colspan="3">Receipt</th>
		                <th class="text-center" colspan="3">Issue</th>
		                <th class="text-center" colspan="3">Balance</th>
		                <th class="text-center" colspan="2"></th>
		            </tr>
					<tr>
						<th class="col-sm-1">Date</th>
						<th class="wordwrap">Reference</th>
						<th class="col-sm-1">Qty</th>
						<th class="col-sm-1">Unit Cost</th>
						<th class="col-sm-1">Total Cost</th>
						<th class="col-sm-1">Qty</th>
						<th class="col-sm-1">Unit Cost</th>
						<th class="col-sm-1">Total Cost</th>
						<th class="col-sm-1">Qty</th>
						<th class="col-sm-1">Unit Cost</th>
						<th class="col-sm-1">Total Cost</th>
						<th class="no-sort"></th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script type="text/javascript">
	$(document).ready(function() {

		var quantity = 0;
		var unitcost = 0;
		var totalcost = 0;

	    var table = $('#inventoryTable').DataTable({
				"pageLength": 50,
				"columnDefs":[
					{ "type": "date", "targets": 0 },
					{ targets: 'no-sort', orderable: false }
				],
				language: {
						searchPlaceholder: "Search..."
				},
				"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
								"<'row'<'col-sm-12'tr>>" +
								"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				"processing": true,
				ajax: '{{ url("inventory/supply/$supply->stocknumber/ledgercard/") }}',
				columns: [
						{ data: function(callback){
							return moment(callback.date).format('MMMM Y')
						} },
						{ data: "reference_list" },

						{ data: "received_quantity"},
						{ data: "parsed_received_unitcost" },
						{ data: "parsed_received_total_cost"},

						{ data: "issued_quantity" },
						{ data: "parsed_issued_unitcost"},
						{ data: "parsed_issued_total_cost" },
						{ data: "parsed_monthlybalancequantity" },
						{ data: "parsed_monthlyunitcost" },
						{ data: "parsed_monthlytotalcost" },
						{ data: function(callback){
							url = '{{ url("inventory/supply/$supply->id/ledgercard") }}' + '/' + callback.date
							return "<a type='button' href='" + url + "' class='btn btn-default btn-sm'>View</a>"
						} },
				],
	    });

	 	$("div.toolbar").html(`
			<a href="{{ url("inventory/supply/$supply->stocknumber/ledgercard/printSummary") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
				<span id="nav-text"> Download</span>
			</a>
		`);
	});
</script>
@endsection
