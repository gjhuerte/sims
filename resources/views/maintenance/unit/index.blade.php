@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Unit</h3></legend>
		<ol class="breadcrumb">
			<li><a href="{{ url('maintenance/unit') }}">Unit</a></li>
			<li class="active">Index</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-striped table-hover table-bordered" id='unitTable'>
				<thead>
					<th class="col-sm-1">ID</th>
					<th class="col-sm-1">Name</th>
					<th class="col-sm-1">Abbreviation</th>
					<th class="col-sm-1">Description</th>
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

	    var table = $('#unitTable').DataTable( {
				serverSide: true,
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
	        ajax: "{{ url('maintenance/unit') }}",
	        columns: [
	            { data: "id" },
	            { data: "name" },
	            { data: "abbreviation" },
	            { data: "description" },
	            { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/unit") }}` + '/' + callback.id + '/edit' + `" class="btn btn-sm btn-default">Edit</a>
	            	`;
	            } }
	        ],
	    } );

	 	$("div.toolbar").html(`
 			<a href="{{ url('maintenance/unit/create') }}" id="new" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Add
 			</a>
		`);

		$('#unitTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'delete',
				url: '{{ url("maintenance/unit") }}' + '/' + $(this).data('id'),
				dataType: 'json',
				success: function(response){
					if(response == 'success')
						swal("Operation Success",'Unit removed.',"success")
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
	})
</script>
@endsection
