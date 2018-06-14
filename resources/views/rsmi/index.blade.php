@extends('backpack::layout')

@section('after_styles')
<style>
	th {
		white-space: nowrap;
	}
</style>
@endsection

@section('header')
	<section class="content-header">
    <legend><h3 class="text-muted">Reports on Supplies and Materials Issued</h3></legend>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">

    	<legend><h3 class="text-muted">R.S.M.I. List</h3></legend>

		<table class="table table-hover table-striped table-bordered table-condensed table-responsive" id="rsmiTable" cellspacing="0" width="100%">
			<thead>
				<th class="col-sm-1">ID</th>
				<th class="col-sm-1">RSMI Date</th>
				<th class="col-sm-1">Date Created</th>
				<th class="col-sm-1">Created By</th>
				<th class="col-sm-1">Status</th>
				<th class="col-sm-1 no-sort"></th>
			</thead>
		</table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script type="text/javascript">
	$(document).ready(function() {

	    var table = $('#rsmiTable').DataTable({
	    	pageLength: 100,
        	serverSide: true,
			"processing": true,
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			ajax: '{{ url("rsmi") }}',
			columns: [
					{ data: "id" },
					{ data: "parsed_month" },
					{ data: "created_at" },
					{ data: "created_by"},
					{ data: "status_name"},
					{ data: function(callback){
						return `<a class="btn btn-sm btn-default" href="{{ url('rsmi') }}/` + callback.id + `">View</a>`
					}},
			],
	    });

	    @if(Auth::user()->access == 1)
	    $('div.toolbar').html(`

			<form method="post" action="{{ route('rsmi.store') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    	@if(isset($months) && count($months) > 0 )

		    	<select id="month" class="form-control" name="month">
		    		@foreach($months as $month)
		    		<option value="{{ $month }}">{{ $month }}</option>
		    		@endforeach
		    	</select>

		    	@endif
				<button type="submit" href="{{ url("rsmi/store") }}" id="generate" class="btn btn-md btn-default">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
					<span id="nav-text"> Generate Report</span>
				</button>
			</form>
    	`)
    	@endif
	} );
</script>
@endsection
