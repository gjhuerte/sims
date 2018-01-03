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
				@if(count($uacs_codes) > 0)
					<th class="col-sm-1">Fund Cluster</th>
					@foreach($uacs_codes as $uacs_code)
					<th class="col-sm-1">{{ $uacs_code }}</th>
					@endforeach
				@endif
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function(){

		var date = moment().format("MMM YYYY");

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
	        ajax: '{{ url("uacs") }}' + '/' + date,
	        columns: [
				@if(count($uacs_codes) > 0)
		            { data: "fundcluster_code" },
					@foreach($uacs_codes as $uacs_code)
		            { data: "{{ $uacs_code . "." }}total" },
		            @endforeach
				@endif
	        ],
	    } );

	    $('div.toolbar').html(`
 			<a href="{{ url('uacs/print') }}" id="print" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-print"></span>  Print
 			</a>
	    	<label for="month">Month Filter:</label>
	    	<select class="form-control" id="month"></select>
    	`);

    	$.ajax({
    		type: 'get',
    		url: "{{ url('uacs/months') }}",
    		dataType: 'json',
    		success: function(response){
    			option = ""
    			$.each(response.data,function(obj){
	    			date = moment(obj,"MM YYYY").format("MMM YYYY")
    				option += `<option val='` + date + `'>` + date + `</option>'`
    				$('#month').html("")
    				$('#month').append(option)
    			})

    			reloadTable()
    		}
    	})

    	$('#month').on('change',function(){
    		reloadTable()
    	})

    	function reloadTable()
    	{
			date = $('#month').val()
			if(moment(date,"MMMMYYYY").isValid())
			date = moment(date,"MMMMYYYY").format('MMMM YYYY')
			else
			date = moment().format('MMMM YYYY')
    		uacstableurl = '{{ url("uacs") }}' + '/' + date

    		table.ajax.url(uacstableurl).load()
    	}
	});
</script>
@endsection
