@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Fund Cluster {{ $fundcode }}</h3></legend>
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
					<th class="">Reference</th>
					<th class="no-sort"></th>
				</thead>
			</table>
			<tbody>
				
			</tbody>
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
			ajax: "{{ url("fundcluster/$fund") }}",
			columns: [
	          	{ data: "id" },
				{ data: "purchaseorder_number" },
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
	} );
</script>
@endsection
