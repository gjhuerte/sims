@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Sectors</h3></legend>
		<ol class="breadcrumb">
			<li>Sector</li>
			<li class="active">Home</li>
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
					<th>ID</th>
					<th>Code</th>
					<th>Name</th>
					<th>Head</th>
					<th>Designation</th>
					<th class="no-sort"></th>
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
	    	serverSide: true,
	    	processing: true,
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
	        ajax: "{{ url('maintenance/office') }}",
	        columns: [
	            { data: "id" },
	            { data: "code" },
	            { data: "name" },
	            { data: "office_head" },
	            { data: "head_title" },
	            { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/office") }}` + '/' + callback.id + `" class="btn btn-sm btn-success">Show Offices</a>
	            			<a href="{{ url("maintenance/office") }}` + '/' + callback.id + '/edit' + `" class="btn btn-sm btn-default">Edit</a>
	            	`;
	            } }
	        ],
	    } );

	 	$("div.toolbar").html(`
 			<a href="{{ url('maintenance/office/create') }}" id="newoffice" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Add Sector
 			</a>
 			<a href="{{ url('maintenance/department/create') }}" id="newdepartment" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>  Add Office
 			</a>
		`);


		$('#officeTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
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

	});
</script>
@endsection
