@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supplies</h3></legend>
		<ol class="breadcrumb">
			<li>Maintenance</li>
			<li class="active">Supplies</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
		<table class="table table-hover table-striped table-bordered table-condensed" id="supplyTable">
			<thead>
				<th class="col-sm-1">Stock No.</th>
				<th class="col-sm-1">Details</th>
				<th class="col-sm-1">Unit</th>
				<th class="col-sm-1">Reorder Point</th>
				@if(Auth::user()->access == 1)
				<th class="no-sort col-sm-1"></th>
				@endif
			</thead>
		</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

	    var table = $('#supplyTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
			@if(Auth::user()->access == 1)
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
				{ data: "reorderpoint" }
				@if(Auth::user()->access == 1)
	           , { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/supply") }}` + '/' + callback.stocknumber + '/edit' + `" class="btn btn-default btn-sm">Edit</a>
	            	`;
	            } }
	            @endif
			],
	    });

		@if(Auth::user()->access == 1)
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
