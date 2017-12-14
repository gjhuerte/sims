@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">{{ $request->code }}</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('request') }}">Request</a></li>
			<li class="active"> {{ $request->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			@if(Auth::user()->username == $request->requestor && $request->status == null)
	        <a href="{{ url("request/$request->id/edit") }}" class="btn btn-default btn-sm">
	    		<i class="fa fa-pencil" aria-hidden="true"></i> Edit
	    	</a>
	        <a href="{{ url("request/$request->id/cancel") }}" class="btn btn-danger btn-sm">
	        	<i class="fa fa-hand-stop-o" aria-hidden="true"></i> Cancel
	        </a>
	        <hr />
	        @endif
			<table class="table table-hover table-striped table-bordered table-condensed" id="requestTable" cellspacing="0" width="100%"	>
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="3">Request Slip:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
		                <th class="text-left" colspan="3">Requestor:  <span style="font-weight:normal">{{ $request->office }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="3">Remarks:  <span style="font-weight:normal">{{ $request->remarks }}</span> </th>
		                <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ $request->status }}</span> </th>
		            </tr>
		            <tr>
						<th>Stock Number</th>
						<th>Details</th>
						<th>Quantity Requested</th>
						<th>Quantity Issued</th>
						<th>Notes</th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

    var table = $('#requestTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("request/$request->id") }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "supply.details" },
					{ data: "quantity_requested" },
					{ data: "quantity_issued" },
					{ data: "comments" }
			],
    });

    $('div.toolbar').html(`
         <a href="{{ url("request/$request->id/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Print</span>
        </a>
        @if($request->status == 'approved')
        <a id="release" href="{{ url("request/$request->id/release") }}" class="btn btn-sm btn-danger ladda-button" data-style="zoom-in">
          <span class="ladda-label"><i class="glyphicon glyphicon-share-alt"></i> Release</span>
        </a>
        @endif
        <a id="comment" href="{{ url("request/$request->id/comments") }}" class="btn btn-sm btn-primary ladda-button" data-style="zoom-in">
          <span class="ladda-label"><i class="fa fa-comment" aria-hidden="true"></i> Commentary</span>
        </a>
    `)

	} );
</script>
@endsection
