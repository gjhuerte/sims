@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Inspections
	  </h1>
	  <ol class="breadcrumb">
	    <li>Inspection</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="requestTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">Inspection No.</th>
            <th class="col-sm-1">Inspection Date</th>
            <th class="col-sm-1">Submitted By</th>
            <th class="col-sm-1">Reference</th>
            <th class="col-sm-1">Receipt</th>
            <th class="col-sm-1">Status</th>
            <th class="col-sm-1 no-sort"></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
  jQuery(document).ready(function($) {

    table = $('#requestTable').DataTable({
      pageLength: 25,
      serverSide: true,
      stateSave: true,
      "processing": true,
      language: {
              searchPlaceholder: "Search..."
      },
      columnDefs:[
          { targets: 'no-sort', orderable: false },
      ],
      "order": [
        [0, 'asc']
      ],
      "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      ajax: "{{ url('inspection') }}",
      columns: [
        { data: "code" },
        { data: 'created_at' },
        { data: "inspector_name" },
        { data: "purchaseorder_number" },
        { data: "receipt_number" },
        { data: "status" },
        { data: function(callback){
          return `
            <a href="{{ url('inspection') }}/`+callback.id+`" class="btn btn-md btn-default">View</a>
          `
        }}
      ],
    });
  });
</script> 
@endsection
