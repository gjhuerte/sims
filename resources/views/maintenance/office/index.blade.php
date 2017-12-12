@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Offices</h3></legend>
		<ol class="breadcrumb">
			<li>Office</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-striped table-hover table-bordered" id='officeTable'>
				<thead>
					<th class="col-sm-1">ID</th>
					<th class="col-sm-1">Department Code</th>
					<th class="col-sm-1">Department Name</th>
					<th class="col-sm-1">Head</th>
					<th class="no-sort col-sm-1"></th>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function(){
	    var table = $('#officeTable').DataTable( {
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
		    language: {
		        searchPlaceholder: "Search..."
		    },
	    	"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
						    "<'row'<'col-sm-12'tr>>" +
						    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
	        ajax: "{{ url('maintenance/office') }}",
	        columns: [
	            { data: "id" },
	            { data: "code" },
	            { data: "name" },
	            { data: "head" },
	            { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/office") }}` + '/' + callback.id + '/edit' + `" class="btn btn-sm btn-default">Edit</a>
	            			<button type="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Removing Office" data-id="`+callback.id+`" class="remove btn btn-sm btn-danger">Remove</button>
	            	`;
	            } }
	        ],
	    } );

	 	$("div.toolbar").html(`
 			<a href="{{ url('maintenance/office/create') }}" id="new" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Add
 			</a>
		`);

		$('#officeTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
				type: 'delete',
				url: '{{ url("maintenance/office") }}' + '/' + $(this).data('id'),
				dataType: 'json',
				success: function(response){
					if(response == 'success')
					swal("Operation Success",'An office has been removed.',"success")
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

	});
</script>
@endsection
