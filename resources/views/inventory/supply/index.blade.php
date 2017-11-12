@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<style>
			#page-body{
				display: none;
			}

			a > hover{
				text-decoration: none;
			}

			th , tbody{
				text-align: center;
			}
		</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supplies Inventory</h3></legend>
	  {{-- <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Das</a></li>
	    <li class="active">{{ trans('backpack::backup.backup') }}</li>
	  </ol> --}}
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
		<table class="table table-hover table-condensed" id="supplyInventoryTable" width=100%>
			<thead>
				<th class="col-sm-1">Stock No.</th>
				<th class="col-sm-1">Supply Item</th>
				<th class="col-sm-1">Unit</th>
				<th class="col-sm-1">Reorder Point</th>
				<th class="col-sm-1">Remaining Balance</th>
				@if(Auth::user()->accesslevel == 1 || Auth::user()->accesslevel == 2)
				<th class="col-sm-1 no-sort"></th>
				@endif
			</thead>
		</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
    <!-- Ladda Buttons (loading buttons) -->
    <script src="{{ asset('vendor/backpack/ladda/spin.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ladda/ladda.js') }}"></script>

    {{ HTML::script(asset('js/jquery-ui.js')) }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script(asset('js/sweetalert.min.js')) }}
    {{ HTML::script(asset('js/jquery.dataTables.min.js')) }}
    {{ HTML::script(asset('js/dataTables.bootstrap.min.js')) }}

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

	    var table = $('#supplyInventoryTable').DataTable({
			select: {
				style: 'single'
			},
			language: {
					searchPlaceholder: "Search..."
			},
    	columnDefs:[
       	 { targets: 'no-sort', orderable: false },
      ],
			@if(Auth::user()->accesslevel == 1 || Auth::user()->accesslevel == 2)
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			@endif
			"processing": true,
			ajax: "{{ url('maintenance/supply') }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "details" },
					{ data: "unit" },
					{ data: "reorderpoint" },
					{ data: "balance" },
					@if(Auth::user()->accesslevel == 1 || Auth::user()->accesslevel == 2)
		            { data: function(callback){
		            	return `
		            			@if(Auth::user()->accesslevel == 1)
		            			<a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/stockcard' +`" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> Stockcard</a>
                      <a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/stockcard/print' +`" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
              	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
              	        <span id="nav-text"> Print</span>
              	      </a>
		            			@endif
		            			@if(Auth::user()->accesslevel == 2)
		            			<a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/supplyledger' +`" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> Supply Ledger</a>
                      <a href="{{ url("inventory/supply") }}` + '/' + callback.stocknumber  + '/supplyledger/print' +`" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
              	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
              	        <span id="nav-text"> Print</span>
              	      </a>
		            			@endif
		            	`;
		            } }
		            @endif
			],
	    });

    @if(Auth::user()->accesslevel == 2)
	 	$("div.toolbar").html(`
        <a href="{{ url("inventory/supply/supplyledger/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
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

		@if(Auth::user()->accesslevel == 1)
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
			@if(Auth::user()->accesslevel == 1)
			window.location.href = "{{ url('inventory/supply/stockcard/batch/form/accept') }}"
			@elseif(Auth::user()->accesslevel == 2)
			window.location.href = "{{ url('inventory/supply/supplyledger/batch/form/accept') }}"
			@endif
		});

		$('#release').on('click',function(){
			@if(Auth::user()->accesslevel == 1)
			window.location.href = "{{ url('inventory/supply/stockcard/batch/form/release') }}"
			@elseif(Auth::user()->accesslevel == 2)
			window.location.href = "{{ url('inventory/supply/supplyledger/batch/form/release') }}"
			@endif

		});

		$('#page-body').show();
	} );
</script>
@endsection
