@extends('backpack::layout')

@section('after_styles')
	<style>
	
		a > hover{
			text-decoration: none;
		}

		th , tbody{
			text-align: center;
		}
	</style>
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Stock Card</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Inventory</a></li>
			<li class="active">{{ $supply->stocknumber }}</li>
			<li class="active">Stock Card</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
<div class="box" style="padding:10px">
    <div class="box-body">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
		                <th class="text-left" colspan="4">Fund Cluster:  
		                	<span style="font-weight:normal"> </span>
		                </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Item:  <span style="font-weight:normal">{{ $supply->details }}</span> </th>
		                <th class="text-left" colspan="4">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
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
			"processing": true,
			ajax: '{{ url("inventory/supply/$supply->id/stockcard/") }}',
			columns: [
					{ data: "parsed_date"},
					{ data: "reference" },
					{ data: "received_quantity"},
					{ data: "issued_quantity" },
					{ data: "organization" },
					{ data: "balance_quantity" },
					{ data: "daystoconsume" },
			],
	    });

	 	$("div.toolbar").html(`
	       <a href="{{ url("inventory/supply/$supply->stocknumber/stockcard/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	        <span id="nav-text"> Print</span>
	      </a>
		`);
	} );
</script>
@endsection
