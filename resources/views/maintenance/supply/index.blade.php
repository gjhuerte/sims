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

			td{
				font-size: 12px;
			}
		</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supplies</h3></legend>
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
		<table class="table table-hover table-striped table-bordered table-condensed" id="supplyTable">
			<thead>
				<th>Stock No.</th>
				<th>Entity Name</th>
				<th>Supply Item</th>
				<th>Unit</th>
				<th>Reorder Point</th>
				@if(Auth::user()->accesslevel == 1)
				<th class="no-sort"></th>
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

	    var table = $('#supplyTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
			@if(Auth::user()->accesslevel == 1)
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			@endif
			"processing": true,
			ajax: "{{ url('maintenance/supply') }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "entityname" },
					{ data: "supplytype" },
					{ data: "unit" },
					{ data: "reorderpoint" }
					@if(Auth::user()->accesslevel == 1)
		           , { data: function(callback){
		            	return `
		            			<a href="{{ url("maintenance/supply") }}` + '/' + callback.stocknumber + '/edit' + `" class="btn btn-default btn-sm btn-block">Edit</a>
		            	`;
		            } }
		            @endif
			],
	    });

		@if(Auth::user()->accesslevel == 1)
	 	$("div.toolbar").html(`
				<a href="{{ url('maintenance/supply/create') }}" class="btn btn-sm btn-primary">
					<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
					<span id="nav-text"> Add new Supply</span>
				</a>
		`);
		@endif

		$('#page-body').show();
	} );
</script>
@endsection
