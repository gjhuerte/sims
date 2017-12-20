@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supplies Inventory</h3></legend>
		<ol class="breadcrumb">
			<li>Inventory</li>
			<li class="active">Home</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
		<table class="table table-hover table-bordered" id="supplyInventoryTable" width=100%>
			<thead>
				<tr>
					<th colspan="4"></th>
					<th colspan="2">Remaining Balance</th>
				</tr>
				<tr>
					<th class="col-sm-1">Stock No.</th>
					<th class="col-sm-1">Supply Item</th>
					<th class="col-sm-1">Unit</th>
					@if(Auth::user()->access == 1)
					<th class="col-sm-1">Reorder Point</th>
					@else
					<th class="col-sm-1">Unit Price (Moving Average)</th>
					@endif
					<th class="col-sm-1">Ledger Card</th>
					<th class="col-sm-1">Stock Card</th>
					@if(Auth::user()->access == 1 || Auth::user()->access == 2)
					<th class="col-sm-1 no-sort"></th>
					@endif
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

	    var table = $('#supplyInventoryTable').DataTable({
	    	serverSide: true,
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
	       	 { targets: 'no-sort', orderable: false },
	      	],
			@if(Auth::user()->access == 1 || Auth::user()->access == 2)
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			@endif
			"processing": true,
			ajax: "{{ url('inventory/supply') }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "details" },
					{ data: "unit" },
					@if(Auth::user()->access == 1)
					{ data: "reorderpoint" },
					@else
					{ data: function(callback){
						return parseFloat(callback.unitcost).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					} },
					@endif
					{ data: "ledger_balance" },
					{ data: "balance" },
					@if(Auth::user()->access == 1 || Auth::user()->access == 2)
		            { data: function(callback){
		            	return `
		            			@if(Auth::user()->access == 1)
		            			<a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/stockcard' +`" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> Stockcard</a>
                      <a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/stockcard/print' +`" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
              	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
              	        <span id="nav-text"> Print</span>
              	      </a>
		            			@endif
		            			@if(Auth::user()->access == 2)
		            			<a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/ledgercard' +`" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> Supply Ledger</a>
                      <a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/ledgercard/print' +`" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
              	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
              	        <span id="nav-text"> Print</span>
              	      </a>
		            			@endif
		            	`;
		            } }
		            @endif
			],
	    });

    @if(Auth::user()->access == 2)
	 	$("div.toolbar").html(`
        <a href="{{ url("inventory/supply/ledgercard/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	        <span id="nav-text"> Print</span>
	      </a>
				<button id="accept" class="btn btn-sm btn-success">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					<span id="nav-text"> Batch Accept</span>
				</button>
				<button id="release" class="btn btn-sm btn-danger">
					<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
					<span id="nav-text"> Batch Release</span>
				</button>
		`);
		@endif

		@if(Auth::user()->access == 1)
	 	$("div.toolbar").html(`
      <a href="{{ url("inventory/supply/stockcard/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
        <span id="nav-text"> Print</span>
      </a>
			<button id="accept" class="btn btn-sm btn-success">
				<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
				<span id="nav-text"> Batch Accept</span>
			</button>
			<button id="release" class="btn btn-sm btn-danger">
				<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
				<span id="nav-text"> Batch Release</span>
			</button>
		`);
		@endif

		$('#accept').on("click",function(){
			@if(Auth::user()->access == 1)
			window.location.href = "{{ url('inventory/supply/stockcard/batch/form/accept') }}"
			@elseif(Auth::user()->access == 2)
			window.location.href = "{{ url('inventory/supply/ledgercard/batch/form/accept') }}"
			@endif
		});

		$('#release').on('click',function(){
			@if(Auth::user()->access == 1)
			window.location.href = "{{ url('inventory/supply/stockcard/batch/form/release') }}"
			@elseif(Auth::user()->access == 2)
			window.location.href = "{{ url('inventory/supply/ledgercard/batch/form/release') }}"
			@endif

		});

		$('#page-body').show();
	} );
</script>
@endsection
