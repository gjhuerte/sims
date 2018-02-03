@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Fund Cluster</h3></legend>
	  <ol class="breadcrumb">
	    <li>Fund Cluster</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped" id="fundclusterTable">
				<thead>
          			<th class="">ID</th>
          			<th class="">Fund Code</th>
					<th class="">Description</th>
					<th class="no-sort"></th>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

	    var table = $('#fundclusterTable').DataTable({
	    	serverSide: true,
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
				     { targets: 'no-sort', orderable: false },
	    	],
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url('fundcluster') }}",
			columns: [
	          	{ data: "id" },
				{ data: "code" },
				{ data: "description" },
				{ data: function(callback){
					url = '{{ url("fundcluster") }}' + '/' + callback.id
		            html = `
						<a type='button' href='` + url + `' class='btn btn-default btn-sm'>
		                	<span class="glyphicon glyphicon-list"></span> View
		             	</a>
						<a type='button' href='` + url + `/edit' class='btn btn-warning btn-sm'>
		                	<span class="glyphicon glyphicon-pencil"></span> Update
		             	</a>

            			<button type="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Removing Fund Cluster" data-id="`+callback.id+`" class="remove btn btn-sm btn-danger">Remove</button>
		            `
					return html
				} }
			],
	    });

	 	$("div.toolbar").html(`
			<button id="create" class="btn btn-md btn-primary">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span id="nav-text"> Create</span>
			</button>
		`);

		$('#fundclusterTable').on('click','button.remove',function(){
		  	var removeButton = $(this);
			removeButton.button('loading');
			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'delete',
				url: '{{ url("fundcluster") }}' + '/' + $(this).data('id'),
				dataType: 'json',
				success: function(response){
					if(response == 'success')
					swal("Operation Success",'A fund cluster has been removed.',"success")
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

		$('#create').on('click',function(){
			window.location.href = "{{ url('fundcluster/create') }}"
		})

	} );
</script>
@endsection
