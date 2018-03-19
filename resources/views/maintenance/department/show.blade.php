@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Departments</h3></legend>
		<ol class="breadcrumb">
			<li><a href="{{ url('maintenance/office') }}"=>Sector</a></li>
			<li><a href="{{ url("maintenance/office/{$office->head_office}") }}"> Office</a></li>
			<li>Deparments</li>
			<li class="active">Home</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-striped table-hover table-bordered" id='departmentTable'>
				<thead>
					<tr>
						<th colspan="2">Office Code: <span style="font-weight: normal;">{{ $office->code }} </span></th>
						<th colspan="2">Office Head: <span style="font-weight: normal;">{{ $office->office_head }} </span></th>
					</tr>
					<tr>
						<th colspan="2">Office Name: <span style="font-weight: normal;">{{ $office->name }} </span></th>
						<th colspan="2"></th>
					</tr>
					<tr>
						<th colspan="4" class="text-center">Departments</th>
					</tr>
					<tr>
						<th>IDs</th>
						<th>Code</th>
						<th>Name</th>
						<th>Head</th>
						<th>Designation</th>
						<th class="no-sort"></th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function(){
	    var table = $('#departmentTable').DataTable( {
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
	        ajax: "{{ url("maintenance/office/$office->id") }}",
	        columns: [
	            { data: "id" },
	            { data: "code" },
	            { data: "name" },
	            { data: "head" },
	            { data: "head_title" },
	            { data: function(callback){
	            	return `
	            			<a href="{{ url("maintenance/department") }}` + '/' + callback.id + '/edit' + `" class="btn btn-sm btn-default">Edit</a>
	            	`;
	            } }
	        ],
	    } );

	 	$("div.toolbar").html(`
	        <a href="{{ url("maintenance/office/{$office->head_office}") }}" class="btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a>

		`);

		$('#departmentTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'delete',
				url: '{{ url("maintenance/department") }}' + '/' + $(this).data('id'),
				dataType: 'json',
				success: function(response){
					if(response == 'success')
					swal("Operation Success",'A department has been removed from {{ $office->code }}.',"success")
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
