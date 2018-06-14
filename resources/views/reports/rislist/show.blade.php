@extends('backpack::layout')
@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="">
			<table class="table table-hover table-striped table-bordered table-condensed" id="requestlistTable" cellspacing="0" width="100%"	>
				<thead>
          <tr>
					<th>RIS No.</th>
          <th>Office</th>
          <th>Purpose</th>
          <th>Status</th>
          <th>Remarks</th>
          <th>Date Created</th>
          <th>Created by</th>
          <th>Date Processed</th>
          <th>Processed by</th>
          <th>Date Release</th>
          <th>Released by</th>
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

    var table = $('#requestlistTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("reports/rislist/$id") }}",
      columns: [
      { data: "request_number" },
      { data: "office" },
      { data: "purpose" },
      { data: "status" },
      { data: "remarks" },
      { data: "created_at" },
      { data: "requested_by" },
      { data: "approved_at" },
      { data: "issued_by" },
      { data: "released_at" },
      { data: "released_by" },        
      ],
    });

    $('div.toolbar').html(`

        <a href="{{ url('reports/rislist/print') }}/{{ $id }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Download</span>
        </a>

     `)

	} );
</script>
@endsection
