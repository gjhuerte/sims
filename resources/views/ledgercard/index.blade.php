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
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
		                <th class="text-left" colspan="7">Fund Cluster: <span style="font-weight:normal"></span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Item:  <span style="font-weight:normal">{{ $supply->details }}</span> </th>
		                <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
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
						<th>Date</th>
						<th>Reference</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th>Days To Consume</th>
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
						{ data: function(callback){
							return ""
						} },
						{ data: "receivedquantity"},
						{ data: function(callback){
							try{
								return parseInt(callback.receivedunitprice).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
							} catch(e) { quantity = 0; return null }
						} },
						{ data: function(callback){
							try {
								return (callback.receivedquantity * callback.receivedunitprice).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
							} catch (e) { return null }
						} },
						{ data: "issuedquantity" },
						{ data: function(callback){
							try{
								return parseInt(callback.issuedunitprice)
							} catch(e) { quantity = 0; return null }
						} },
						{ data: function(callback){
							try {
								return (callback.issuedquantity * callback.issuedunitprice).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
							} catch (e) { return null }
						} },
						{ data: function(callback){
							try{
								quantity = callback.monthlybalancequantity
								return quantity;
							} catch(e) { quantity = 0; return null }
						} },
						{ data: function(callback){
							try{
								unitcost = (parseInt(callback.issuedunitprice) + parseInt(callback.receivedunitprice)) / 2
								return unitcost.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
							} catch(e) { unitcost = 0; return null }
						} },
						{ data: function(callback){
							try{
								return (quantity * unitcost).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
							} catch (e) { return null }
						} },
						{ data: function(){
							return ""
						} },
						{ data: function(callback){
							url = '{{ url("inventory/supply/$supply->stocknumber/ledgercard") }}' + '/' + callback.date
							return "<a type='button' href='" + url + "' class='btn btn-default btn-sm'>View</a>"
						} },
				],
	    });

	 	$("div.toolbar").html(`
			<a href="{{ url("inventory/supply/$supply->stocknumber/ledgercard/printSummary") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
				<span id="nav-text"> Print</span>
			</a>
			{{-- <button id="accept" class="btn btn-sm btn-success">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span id="nav-text"> Accept</span>
			</button>
			<button id="release" class="btn btn-sm btn-danger">
				<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
				<span id="nav-text"> Release</span>
			</button> --}}
		`);

		$('#accept').on('click',function(){
			window.location.href = "{{ url('inventory/supply') }}" + '/' + "{{ $supply->stocknumber }}" + '/ledgercard/create'
		});

		$('#release').on('click',function(){
			window.location.href = "{{ url('inventory/supply') }}" + '/' + "{{ $supply->stocknumber }}" + '/ledgercard/release'
		});
	});
</script>
@endsection
