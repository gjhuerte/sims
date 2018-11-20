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
		<a target="_blank" id="create" href="{{ url('maintenance/supply/print') }}" class="btn btn-default btn-sm ladda-button" data-style="zoom-in">
			<span class="ladda-label"><i class="fa fa-print"></i> Download Stock Masterlist</span>
		</a>
		<hr />
		<table class="table table-hover table-striped table-bordered table-condensed" id="supplyTable">
			<thead>
				<th class="col-sm-1">Stock No.</th>
				<th class="col-sm-1">Details</th>
				<th class="col-sm-1">Unit</th>
				<th class="col-sm-1">Reorder Point</th>
				@if(Auth::user()->access == 1 || Auth::user()->access == 7)
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
			@if(Auth::user()->access == 1 || Auth::user()->access == 7)
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			@endif
			"processing": true,
			ajax: "{{ url('maintenance/supply') }}",
			columns: [
				{ data: "stocknumber" },
				{ data: "details" },
				{ data: "unit.name" },
				{ data: "reorderpoint" }
				@if(Auth::user()->access == 1 || Auth::user()->access == 7)
	           , { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/supply") }}` + '/' + callback.id + '/edit' + `" class="btn btn-default btn-sm">Edit</a>
	            	`;
	            } }
	            @endif
			],
	    });

		@if(Auth::user()->access == 1 || Auth::user()->access == 7)
	 	$("div.toolbar").html(`
				<a href="{{ url('maintenance/supply/create') }}" class="btn btn-sm btn-primary">
					<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
					<span id="nav-text"> Add new Supply</span>
				</a>
		`);
		@endif

		$('#supplyTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'delete',
				url: '{{ url("maintenance/supply") }}' + '/' + $(this).data('id'),
				dataType: 'json',
				success: function(response){
					if(response == 'success')
					swal("Operation Success",'A supply has been removed.',"success")
					else
						swal("Error Occurred",'An error has occurred while processing your data.',"error")
					table.ajax.reload()
			  		removeButton.button('reset');
				},
				error: function(response){
					swal("Error Occurred",'An error has occurred while processing your data.',"error")
				}

			})
		})

		$('#page-body').show();
	} );
</script>
@endsection
