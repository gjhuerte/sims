@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">References</h3></legend>
	  <ol class="breadcrumb">
	    <li>References</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped" id="purchaseOrderTable">
				<thead>
          			<th class="">ID</th>
					<th class="">Number</th>
					<th class="date-field">Date</th>
         			<th class="">Supplier</th>
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

	    var table = $('#purchaseOrderTable').DataTable({
	    	serverSide: true,
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
		     	{ targets: 'no-sort', orderable: false },
		     	{ targets: '2', 'type': 'datetime-moment' }
	    	],
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url('purchaseorder') }}",
			columns: [
	          	{ data: "id" },
				{ data: "number" },
				{ data: 'date_received_parsed' },
	          	{ data: "supplier_name" },
				{ data: function(callback){
					url = '{{ url("purchaseorder") }}' + '/' + callback.id
		            html = `
						<a type='button' href='` + url + `' class='btn btn-default btn-sm'>
		                	<span class="glyphicon glyphicon-list"></span> View
		             	</a>
		            `
					return html
				} }
			],
	    });

	    @if(false)
	 	$("div.toolbar").html(`
			<a id="create" href="{{ url('purchaseorder/create') }}" class="btn btn-md btn-primary">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span id="nav-text"> Create</span>
			</a>
		`);
		@endif

	} );
</script>
@endsection
