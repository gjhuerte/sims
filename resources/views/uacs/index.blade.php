@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">UACS</h3></legend>
		<ol class="breadcrumb">
			<li>UACS</li>
			<li>Home</li>
		</ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-striped table-hover table-justified table-bordered" id='uacsTable'>
				<thead>
					<th class="col-sm-1">Fund Cluster</th>
					@foreach($uacs_codes as $uacs_code)
					<th class="col-sm-1">{{ $uacs_code }}</th>
					@endforeach
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function(){
	    var table = $('#uacsTable').DataTable( {
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
	        ajax: "{{ url('uacs') }}",
	        columns: [
	            { data: "fundcluster_code" },
				@foreach($uacs_codes as $uacs_code)
	            { data: "unitcost" },
	            @endforeach
	        ],
	    } );

	 	$("div.toolbar").html(`
 			<a href="{{ url('uacs/print') }}" id="print" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-print"></span>  Print
 			</a>
		`);
	});
</script>
@endsection
