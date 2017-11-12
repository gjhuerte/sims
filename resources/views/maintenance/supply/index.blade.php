@extends('backpack::layout')

@section('after_styles')
	<style>
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
@endsection

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
				<th>Stock No.</th>
				<th>Entity Name</th>
				<th>Details</th>
				<th>Unit</th>
				<th>Reorder Point</th>
				@if(Auth::user()->access == 1)
				<th class="no-sort"></th>
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
				{ data: "entityname" },
				{ data: "details" },
				{ data: "unit" },
				{ data: "reorderpoint" }
				@if(Auth::user()->access == 1)
	           , { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/supply") }}` + '/' + callback.stocknumber + '/edit' + `" class="btn btn-default btn-sm btn-block">Edit</a>
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
